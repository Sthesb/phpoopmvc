<?php

    class App {
        protected $currentController = "home";
        protected $currentMethod = "index";
        protected $params = [];



        public function __construct() 
        {
            $url = $this->splitURL();

            // checks if class exits
            if(file_exists('../app/controllers/'. strtolower($url[0]) .'.php'))
            {
                $this->currentController = strtolower($url[0]);
                unset($url[0]);
            }

            // require the controller file
            require '../app/controllers/'. $this->currentController .'.php';
            // instantiate the current controller
            $this->currentController = new $this->currentController;


            // looks for the method in the selected controller
            if(isset($url[1]))
            {
                // check if the method exists in the currently selected controller file
                if(method_exists($this->currentController, strtolower($url[1])))
                {
                    $this->currentMethod = strtolower($url[1]); // assign new method
                    unset($url[1]);
                }
            }

            //  run the class and method
            
            $this->params = $url ? array_values($url) : [];
            // Call a callback with array of  params

            call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
        }

        // gets url 
        private function splitURL()
        {
            $url = isset($_GET['url']) ? $_GET['url'] : "home";
            return explode('/', filter_var(trim($url, '/')), FILTER_SANITIZE_URL ); // return the url
        }
    }

