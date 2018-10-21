<?php
    class User
    {
        private $_db = null,
                $_data = null,
                $_isLoggedIn = false;

        public function __construct($data = array(), $user = null)
        {
            $this->_db = DB::create($data, false);

            if (!$user)
            {
                if (Session::exists('user'))
                {
                    $user = Session::get('user');

                    if ($this->find($user))
                    {
                        $this->_isLoggedIn = true;
                
                        $this->resecure();
                    }
                    else
                    {
                    }
                }
                elseif(Cookie::exists('authlogin'))
                {
                    $check = $this->_db->get('users_sessions', array('hash', '=', Cookie::get('authlogin')));
                    if ($check->getCount())
                    {
                        $this->_isLoggedIn = true;
                        Session::put("user", $check->getFirst()->user_id);
                        $this->find($check->getFirst()->user_id);
                
                        $this->resecure();
                    }
                }
                
            }
            else
                $this->find($user);

            if($this->_isLoggedIn && !$this->is_session_valid())
            {
                $this->logout();
                // Flash a Message to the user...
                Session::flash('login_message', 'auto_logout');
            }
        }

        public function create(array $fields = array())
        {
            $query = $this->_db->get('users', array('username', '=', $fields['username']));
            if ($query->getCount())
                return false;

            $query = $this->_db->insert('users', $fields);
            if($query->hasErrors())
            {
                //var_dump($query->getErrors());
                //echo $query->getExecutedSQL();
                throw new Exception('Creating an account has failed, due to a critical system error. Please contact a developer.');
            }
            
            return true;
        }

        public function loginCheck(string $username = null, string $password = null, $remember = false)
        {
            $user = $this->find($username);

            if ($user)
            {
                if($this->getData()->password == Hash::make($password, $this->getData()->salt))
                    return true;
            }

            return false;
        }

        public function login(string $username = null, string $password = null, $remember = false)
        {
            if($this->loginCheck($username, $password))
            {
                Session::put('user', $this->getData()->id);

                if($remember)
                {
                    $hash = Hash::unique();
                    $check = $this->_db->get('users_sessions', array('user_id', '=', $this->getData()->id));

                    if (!$check->getCount())
                    {
                        $this->_db->insert('users_sessions', array(
                            'user_id' => $this->getData()->id,
                            'hash' => $hash,
                            'createdDate' => date('Y-m-d H:i:s')
                        ));
                    }
                    else
                    {
                        $hash = $check->getFirst()->hash;
                    }

                    Cookie::put('authlogin', $hash, 604800);
                }

                $this->resecure();

                return true;
            }

            return false;
        }

        public function hasAuthorization($username)
        {
            $user = $this->find($username);

            if ($this->exists())
            {
                $myIP = grabClientIPAddress();
                $authIPs = json_decode($this->getData()->authIPAddresses);
                
                if (in_array($myIP, $authIPs))
                    return true;
            }
            return false;
        }

        public function isVerified($username)
        {
            $user = $this->find($username);

            if ($this->exists())
            {
                if ($this->getData()->authorized)
                    return true;
            }
                    
            return false;
        }

        public function verify($username = null)
        {
            return $this->update(array('authorized' => '1'));
        }

        public function logout()
        {
            Cookie::delete('authlogin');
            Session::delete('user');
            $this->_isLoggedIn = false;
        }

        public function update($fields = array(), $id = null)
        {
            if(!$id && $this->isLoggedIn())
                $id = $this->getData()->id;

            if (!($q = $this->_db->update('users', array('id', '=', $id), $fields)))
                throw new Exception("An error occured updating {$id}'s account information!");
            else
                return $this;

            return false;
        }

        public function find($username = null)
        {
            if($username)
            {
                $field = (is_numeric($username) ? 'id' : (count(explode('@', $username)) != 1 ? 'email' : 'username' ));
                $data = $this->_db->get('users', array($field, '=', $username));

                if ($data->getCount())
                {
                    $this->_data = $data->getFirst();
                    return true;
                }
            }

            return false;
        }

        public function getUserGroup($id = null)
        {
            if(!$id && $this->isLoggedIn())
                $id = $this->getData()->id;

            $userGroupData = $this->_db->get('users_groups', array('user_id', '=', $id));
            if ($userGroupData->getCount())
            {
                $primary = null;
                foreach ($userGroupData->getResults() as $result)
                {
                    if ($result->primary == 1)
                    {
                        $primary = $result;
                        break;
                    }
                }
                if (!$primary)
                    $primary = $userGroupData->getFirst();
                
                if ($primary)
                {
                    $group = $this->_db->get('groups', array('id', '=', $primary->group_id));
                    if ($group->getCount())
                        return $group->getFirst();
                }
            }
            return null;
        }

        public function hasPermission($perm, $id = null)
        {
            if(!$id && $this->isLoggedIn())
                $id = $this->getData()->id;

            $userGroup = $this->getUserGroup($id);

            if ($userGroup)
                if (json_decode($userGroup->perms)[$perm])
                    return true;
                    
            return false;
        }

        public function isLoggedIn()
        {
            return $this->_isLoggedIn;
        }

        public function getData()
        {
            return $this->_data;
        }

        public function exists()
        {
            return (isset($this->_data));
        }

        private function resecure()
        {
            Session::regenerate();
            session::put("ip", grabClientIPAddress());
            session::put("agent", $_SERVER['HTTP_USER_AGENT']);
            session::put("last_login", time());
        }

        private function is_session_ipMatch()
        {
            if(empty(Session::get("ip")) || empty(grabClientIPAddress()))
                return false;
            
            return Session::get("ip") == grabClientIPAddress();
        }

        private function is_session_agentMatch()
        {
            if(empty(Session::get("agent")) || !isset($_SERVER['HTTP_USER_AGENT']))
                return false;

            return Session::get("agent") == $_SERVER['HTTP_USER_AGENT']; // False?
        }

        private function is_session_recentLogin($maxSeconds = 0, $maxMinutes = 0, $maxHours = 0, $maxDays = 0, $maxWeeks = 0)
        {
            if (empty(Session::get("last_login")))
                return false;

            $elapse = 60 * 60 * 24; // One day.
            return (Session::get("last_login") + $elapse) >= time();
        }

        private function is_session_valid($checkIP = true, $checkUserAgent = true, $checkLastLogin = true)
        {
            if ($checkIP && !$this->is_session_ipMatch())
                return false;
            if ($checkUserAgent && !$this->is_session_agentMatch())
                return false;
            if ($checkLastLogin && !$this->is_session_recentLogin())
                return false;

            return true;
        }

    }
?>