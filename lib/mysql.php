<?php

include 'dbconfig.php';

class mysql extends dbconfig {

    public $connectionstring;
    public $dataset;

    private $query;

    protected $hostName;
    protected $userName;
    protected $passCode;
    protected $database;

    /**
     * 
     */
    function mysql() {

        $this->connectionstring = NULL;
        $this->query            = NULL;
        $this->dataset          = NULL;

        $db = new dbconfig();
        $this->hostName = $db->host;
        $this->userName = $db->username;
        $this->passCode = $db->password;
        $this->database = $db->database;
        $db = NULL;
    }

    /**
     * 
     * @return type
     */
    function connect() {

        $this->connectionstring = mysql_connect($this->serverName,$this->userName,$this->passCode);
        mysql_select_db($this->database,$this->connectionstring);

        return $this->connectionstring;
    }

    /**
     * 
     */
    function dbDisconnect() {

        $this->connectionstring = NULL;
        $this->query            = NULL;
        $this->dataset          = NULL;
        $this->database         = NULL;
        $this->hostName         = NULL;
        $this->userName         = NULL;
        $this->passCode         = NULL;
    }

    /**
     * 
     * @param type $tableName
     * @return type
     */
    function selectAll($tableName) {

        $this->query = 'SELECT * FROM '.$this->database.'.'.$tableName;
        $this->dataset = mysql_query($this->query,$this->connectionstring);

        return $this->dataset;
    }

    /**
     * 
     * @param type $tableName
     * @param type $rowName
     * @param type $operator
     * @param type $value
     * @param type $valueType
     * @return type
     */
    function selectWhere($tableName,$rowName,$operator,$value,$valueType) {

        $this->query = 'SELECT * FROM ' . $tableName . ' WHERE ' . $rowName . ' ' . $operator . ' ';

        if ($valueType == 'int') {
            $this->query .= $value;
        } else if ($valueType == 'char') {
            $this->query .= "'" . $value . "'";
        }

        $this->dataset = mysql_query($this->query, $this->connectionstring);
        $this->query = NULL;

        return $this->dataset;
    }

    function insert_record($table, $values) {

        $i = 0;
        
        $this->query = 'INSERT INTO ' . $tableName . ' VALUES (';
        
        while ($values[$i]['val'] != NULL && $values[$i]['type'] != NULL) {
            if($values[$i]['type'] == 'char') {
                $this->query .= "'" . $values[$i]['val'] . "'";
            } else if($values[$i]['type'] == 'int') {
                $this->query .= $values[$i]['val'];
            }
            if($values[$i]["val"] != NULL) {
                $this->query .= ',';
            }
            $i++;
        }

        $this->query .= ')';

        mysql_query($this->query, $this->connectionstring);

        return $this->query;
    }

    function get_records_sql($query) {

        $this->dataset = mysql_query($query, $this->connectionstring);

        return $this->dataset;
    }

}
