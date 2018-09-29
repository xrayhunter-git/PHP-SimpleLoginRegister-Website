<?php
    class InputValidation
    {
        private $_passed = false,
                $_errors = array(),
                $_db = null;
        
        public function __construct()
        {
            $this->_db = DB::create();
        }
    }
?>