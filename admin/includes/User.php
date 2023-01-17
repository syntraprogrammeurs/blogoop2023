<?php

class User
{
    /** PROPERTIES **/
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
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
        ];
    }

    /** DEFAULT CONSTRUCTOR **/

    /** METHODES **/
    /**BEGIN CRUD **/
    public function create(){
        global $database;
        //tabel ophalen dmv object properties
        $table = static::$table_name;
        $properties = $this->get_properties();
        //filter the id
        if(array_key_exists('id', $properties)){
            unset($properties['id']);
        }
        //sql injection voorkomen
        $escaped_values = array_map([$database,'escape_string'], $properties);
        //placeholders voor ons statement
        $placeholders = array_fill(0,count($properties),'?');
        //string maken van alle placeholders gescheiden door een komma
        $fields_string = implode(',', array_keys($properties));
        //wat zijn de types
        $types_string ="";
        foreach($properties as $value){
            if(is_int($value)){
                $types_string .= "i";
            }else if(is_float($value)){
                $types_string .= "d";
            }else{
                $types_string .= "s";
            }
        }
        //create the prepared statement

        //INSERT INTO table_name (column1, column2, column3, ...)
        //VALUES (value1, value2, value3, ...);

        $sql = "INSERT INTO $table ($fields_string) VALUES (". implode(',',$placeholders).")";
        //execute van het statement
        $database->query($sql, $escaped_values);
    }
    public function delete(){
        global $database;
        $table = static::$table_name;
        //DELETE FROM table_name WHERE condition;
        //DELETE FROM users WHERE id=4 (aangeklikte id in UI wissen)
        $escaped_id = $database->escape_string($this->id);
        //create prepared statement
        $sql = "DELETE FROM $table WHERE id=?";
        //bind the parameter (?) met het id
        $params = [$escaped_id];
        //execute the statement
        $database->query($sql,$params);
    }
    public function update(){
        global $database;
        $table = static::$table_name;
        //remove id
        $properties = $this->get_properties();
        unset($properties['id']);
        $properties = $this->get_properties();
        $escaped_values = array_map([$database, 'escape_string'], $properties);
        $escaped_values[] = $this->id;
        $placeholders = array_fill(0, count($properties), '?');

        $fields_string = "";
        $i = 0;
        foreach($properties as $key => $value){
            if($i > 0){
                $fields_string .= ", ";
            }
            $fields_string .= "$key = $placeholders[$i]";
            $i++;
        }
        //create type string
        $types_string ="";
        foreach($properties as $value){
            if(is_int($value)){
                $types_string .= "i";
            }else if(is_float($value)){
                $types_string .= "d";
            }else{
                $types_string .= "s";
            }
        }
        //create prepared statement
        //UPDATE table_name
        //SET column1 = value1, column2 = value2, ...
        //WHERE condition;
        $sql = "UPDATE $table SET $fields_string WHERE id = ?";
        //execute
        $database->query($sql,$escaped_values);
    }
    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }

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