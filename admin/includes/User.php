<?php

class User extends Db_object
{
    /** PROPERTIES **/
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $deleted_at;
    // deze variabele kan in deze class en in overervende classes
    protected static $table_name = 'users';

    //the object properties in an array
    public function get_properties(){
        return [
          'id' => $this->id,
          'username' => $this->username,
          'password' => $this->password,
          'first_name' => $this->first_name,
          'last_name' => $this->last_name,
           'deleted_at' => $this->deleted_at,
        ];
    }

    /** DEFAULT CONSTRUCTOR **/

    /** METHODES **/
    /**BEGIN CRUD **/







    public static function verify_user($username, $password){
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " .self::$table_name. " WHERE ";
        $sql .= "username = ? ";
        $sql .= "AND password = ?";
        $sql .= " LIMIT 1";

        $the_result_array = self::find_this_query($sql,[$username, $password]);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
}