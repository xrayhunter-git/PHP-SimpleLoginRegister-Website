<?php
    class Language
    {
        private static $_instance = null;
        private $_defaultLangue = '';

        private function __construct($defaultLangue = 'en')
        {
            $this->_defaultLangue = $defaultLangue;
            Extensionator::addExtension("languages");
        }

        public static function create($defaultLangue = 'en') : Language
        {
            if(is_null(self::$_instance))
                self::$_instance = new Language($defaultLangue);
            
            return self::$_instance;
        }

        public function addLanguage(Language $langue)
        {
            return $this;
        }

        public function getBrowserLanguage() : string
        {
            return (isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2) : $this->_defaultLangue);
        }

        public function getDialog($langue, $indexName) : string
        {
            if (!isset($GLOBALS['languages']))
                $GLOBALS['languages'] = array();
            if (!isset($GLOBALS['languages'][$langue]))
                $GLOBALS['languages'][$langue] = array();

            // Defaults to the main Language, if necessary.
            if(isset($GLOBALS['languages'][$langue]) && isset($GLOBALS['languages'][$langue][$indexName]))
                return $GLOBALS['languages'][$langue][$indexName];
            else if(isset($GLOBALS['languages'][$this->_defaultLangue]) && isset($GLOBALS['languages'][$this->_defaultLangue][$indexName]))
                return $GLOBALS['languages'][$this->_defaultLangue][$indexName];

            return "{".$langue."_".$indexName."}";
        }

        protected function addDialog($langue, $indexName, $text) : Language
        {
            if(is_null(self::$_instance))
                self::$_instance = new Language();

            if (!isset($GLOBALS['languages']))
                $GLOBALS['languages'] = array();
            if (!isset($GLOBALS['languages'][$langue]))
                $GLOBALS['languages'][$langue] = array();
            
            $GLOBALS['languages'][$langue][$indexName] = $text;

            return $this;
        }

        protected function addDialogByJSON($langue, $path) : Language
        {
            if(file_exists($path))
            {
                $json = json_decode($path);
                if (is_array($json))
                {
                    $keys = array_keys($json);
                    $x = 0;
                    foreach($json as $dialog)
                    {
                        $this->addDialog($langue, $keys[$x], $dialog);
                    }
                }
            }
            return $this;
        }
    }
?>