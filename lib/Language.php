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

        public function getDialog($langue, $indexName = null, array $replacers = array()) : string
        {
            if (!$indexName)
                return '';

            $str = '';
            if (!isset($GLOBALS['languages']))
                $GLOBALS['languages'] = array();
            if (!isset($GLOBALS['languages'][$langue]))
                $GLOBALS['languages'][$langue] = array();

            // Defaults to the main Language, if necessary.
            if(isset($GLOBALS['languages'][$langue]) && isset($GLOBALS['languages'][$langue][$indexName]))
                $str = $GLOBALS['languages'][$langue][$indexName];
            else if(isset($GLOBALS['languages'][$this->_defaultLangue]) && isset($GLOBALS['languages'][$this->_defaultLangue][$indexName]))
                $str = $GLOBALS['languages'][$this->_defaultLangue][$indexName];

            
            if (strlen($str) > 0)
            {
                $replacerKeys = array_keys($replacers);
                $x = 0;
                foreach($replacers as $replacer)
                {
                    $str = str_replace($replacerKeys[$x], $replacer, $str);
                    $x++;
                }
                
                return $str;
            }
            
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