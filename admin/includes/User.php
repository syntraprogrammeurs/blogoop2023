<?php

class User
{
    /** PROPERTIES **/
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;

    /** DEFAULT CONSTRUCTOR **/

    /** METHODES **/
    public static function find_this_query($sql, $values=[]){
        global $database;
        $result = $database->query($sql, $values);
        $the_object_array = [];
        while($row = mysqli_fetch_assoc($result)){
            $the_object_array[] = self::instantie($row);
        }
        return $the_object_array;
    }

    public static function find_all_users(){
        global $database;
        return self::find_this_query("SELECT * FROM users");
    }
    public static function find_user_by_id($user_id){
        global $database;
        //escape user input
        $user_id = $database->escape_string($user_id);
        // create a prepared statement
        $result = self::find_this_query("SELECT * FROM users WHERE id=?", [$user_id]);
        return !empty($result) ? array_shift($result) : false;
    }
    public static function instantie($result){
        $the_object = new self;
        foreach($result as $the_attribute => $value){
            if($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }
        }
        return $the_object;
    }
    public function has_the_attribute($the_attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }

    public static function verify_user($username, $password){
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM users WHERE ";
        $sql .= "username = ? ";
        $sql .= "AND password = ?";
        $sql .= " LIMIT 1";

        $the_result_array = self::find_this_query($sql,[$username, $password]);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
}