<?php
    // Test
    

    class InputValidation
    {
        private $_errors = array(),
                $_db = null;
        
        public function __construct(array $data = null)
        {
            if ($data)
                $this->_db = DB::create($data, false);
        }

        public static function exists(string $type = 'post')
        {
            switch(strtolower($type))
            {
                case 'post':
                    return !empty($_POST);
                break;
                case 'get':
                    return !empty($_GET);
                break;
            }

            return false;
        }

        public static function submitted(string $element)
        {
            if(isset($_POST[$element]))
                return true;
            else if(isset($_GET[$element]))
                return true;

            return false;
        }

        public static function get(string $value)
        {
            if(isset($_POST[$value]))
                return escape($_POST[$value]);
            else if(isset($_GET[$value]))
                return escape($_GET[$value]);

            return '';
        }

        public function check(array $element, array $items = array())
        {
            foreach($items as $item => $rules)
            {
                if (!isset($element[$item]))
                    continue;
                    
                foreach($rules as $rule => $rule_value)
                {

                    $input = trim($element[$item]);
                    $item = escape($item);

                    if($rule == 'required' && empty($input))
                    {
                        $this->addError("{$item} is required");
                    }
                    else if(!empty($input))
                    {
                        switch($rule)
                        {
                            case 'min':
                                if (strlen($input) < $rule_value)
                                    $this->addError("{$item} must be a minimum of {$rule_value} characters!");
                            break;
                            case 'max':
                                if (strlen($input) > $rule_value)
                                    $this->addError("{$item} must be a maximum of {$rule_value} characters!");
                            break;
                            case 'regex':
                                if (preg_match($rule_value, $input) == 0)
                                    $this->addError("{$item} must have more complex letters!");
                            break;
                            case 'matches':
                                if ($input != $element[$rule_value])
                                    $this->addError("{$rule_value} must match {$item}!");
                            break;
                            case 'unique':
                                for($i = 0; $i < count($rule_value['where']); $i++)
                                {
                                    if ($rule_value['where'][$i] == '?')
                                        $rule_value['where'][$i] = $input;
                                }
                                if ($this->_db)
                                {
                                    if($check = $this->_db->get($rule_value['table'], $rule_value['where']))
                                        if($check->getCount())
                                            $this->addError("{$item} already exists!");
                                }
                                else
                                {
                                    $this->addError("Failed to connect to Database, contact a System Administrator!");
                                }
                            break;
                        }
                    }
                }
            }
            
            return $this;
        }

        public function hasPassed()
        {
            return empty($this->_errors);
        }

        public function addError($msg)
        {
            array_push($this->_errors, $msg);
        }

        public function getErrors()
        {
            return $this->_errors;
        }
    }
?>