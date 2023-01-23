<?php

class Db_object
{
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
        //

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
        return true;
    }
    public function soft_delete() {
        global $database;
        $table = static::$table_name;
        //update deleted_at field with current datetime
        $deleted_at = date('Y-m-d H:i:s');
        $escaped_id = $database->escape_string($this->id);
        $sql = "UPDATE $table SET deleted_at = '$deleted_at' WHERE id = ?";
        //bind the parameter (?) with the id
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
    public static function find_all(){
        global $database;
        return self::find_this_query("SELECT * FROM " . static::$table_name . " ");
    }
    public static function find_by_id($id){
        global $database;
        //escape user input
        $id = $database->escape_string($id);
        // create a prepared statement
        $result = self::find_this_query("SELECT * FROM " . static::$table_name . " WHERE id=?", [$id]);
        return !empty($result) ? array_shift($result) : false;
    }
    public static function instantie($result){
        $calling_class = get_called_class(); //late static binding
        $the_object = new $calling_class;
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

}