<?php
    // Test
    

    class InputValidation
    {
        private $_passed = false,
                $_errors = array(),
                $_db = null;
        
        public function __construct(array $data = array())
        {
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
                        array_push($this->_errors, "{$item} is required");
                    }
                    else if(!empty($input))
                    {
                        switch($rule)
                        {
                            case 'min':
                                if (strlen($input) < $rule_value)
                                    array_push($this->_errors, "{$item} must be a minimum of {$rule_value} characters!");
                            break;
                            case 'max':
                                if (strlen($input) > $rule_value)
                                    array_push($this->_errors, "{$item} must be a maximum of {$rule_value} characters!");
                            break;
                            case 'matches':
                                if ($input != $element[$rule_value])
                                    array_push($this->_errors, "{$rule_value} must match {$item}!");
                            break;
                            case 'unique':
                                for($i = 0; $i < count($rule_value['where']); $i++)
                                {
                                    if ($rule_value['where'][$i] == '?')
                                        $rule_value['where'][$i] = $input;
                                }

                                if($check = $this->_db->get($rule_value['table'], $rule_value['where']))
                                    if($check->getCount())
                                        array_push($this->_errors, "{$item} already exists!");
                            break;
                        }
                    }
                }
            }

            if(empty($this->_errors))
                $this->_passed = true;
            
            return $this;
        }

        public function hasPassed()
        {
            return $this->_passed;
        }

        public function getErrors()
        {
            return $this->_errors;
        }
    }
?>