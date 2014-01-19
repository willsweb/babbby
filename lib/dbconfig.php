<?php

class dbconfig {

    protected $host;
    protected $username;
    protected $password;
    protected $database;

    function dbconfig() {
        $this -> host     = 'localhost';
        $this -> username = 'ajaxdev';
        $this -> password = 'ajaxdev';
        $this -> database = 'ajaxdev';
    }

}
