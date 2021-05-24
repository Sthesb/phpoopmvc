<?php

    class Controller 
    {
        // load view
        protected function view($view, $data= []){
            // checks if class exits
            if(@file_exists('../app/views/'. $view .'.php'))
            {
                include '../app/views/'. $view .'.php';
            }else{
                include '../app/views/404.php';
            }
        }

        // load model
        protected function model($model)
        {
            if(@file_exists('../app/models/'. $model .'.php'))
            {
                include '../app/models/'. $model .'.php';
                return $model = new $model(); // returns the model
            }
                return false;
        }

    }