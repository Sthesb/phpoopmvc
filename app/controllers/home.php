<?php
    class Home extends Controller{

        function index(){
            
            $db = new Database();
            $query = "select * from users ";
            // $data = [':id' => 2];
            $users['results'] = $db->read($query);
            $data ['title'] = "Home Page";
            
            $this->view("home", $data);
        }

    }