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
                    }
                }
                
            }
            else
            {
                $this->find($user);
            }
        }

        public function create(array $fields = array())
        {
            $query = $this->_db->insert('users', $fields);
            if($query->hasErrors())
            {
                //var_dump($query->getErrors());
                //echo $query->getExecutedSQL();
                throw new Exception('Creating an account has failed, due to a critical system error. Please contact a developer.');
            }
            
        }

        public function login(string $username = null, string $password = null, $remember = false)
        {
            $user = $this->find($username);

            if ($user)
            {
                if($this->getData()->password == Hash::make($password, $this->getData()->salt))
                {
                    Session::put('user', $this->getData()->id);

                    if($remember)
                    {
                        $hash = Hash::unique();
                        $check = $this->_db->get('users_sessions', array('user_id', '=', $this->getData()->id));

                        if (!$check->getCount())
                        {
                            echo 'inserting';
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

                    return true;
                }
            }

            return false;
        }

        public function logout()
        {
            Session::delete('user');
            $this->_isLoggedIn = false;
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

        public function isLoggedIn()
        {
            return $this->_isLoggedIn;
        }

        public function getData()
        {
            return $this->_data;
        }

    }
?>