<?php

class User extends Db_object
{
    /** PROPERTIES **/
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $user_image;
    public $upload_directory = 'assets/images/photos/users';
    public $image_placeholder = 'https://via.placeholder.com/62';
    public $deleted_at;
    public $type;
    public $size;
    public $tmp_path;
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "Er is geen error, upload gelukt!",
        UPLOAD_ERR_INI_SIZE => "Uw bestand  is groter dan de toegelaten upload filesize in het bestand PHP.INI!",
        UPLOAD_ERR_FORM_SIZE => "Zelf als ini maar gaat de max file size voorbij van het html formulier",
        UPLOAD_ERR_PARTIAL => "Het bestand is gedeeltelijk opgeladen",
        UPLOAD_ERR_NO_TMP_DIR => "Tijdelijke folder niet beschikbaar, raadpleeg hosting",
        UPLOAD_ERR_CANT_WRITE => "Kan niet naar de schijf schrijven",
        UPLOAD_ERR_EXTENSION => "Verkeerd bestandstype, upload gestopt",
        UPLOAD_ERR_NO_FILE => "Gelieve een bestand te selecteren alvorens op te laden"
    );

    // deze variabele kan in deze class en in overervende classes
    protected static $table_name = 'users';

    //the object properties in an array
    public function get_properties()
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'password' => $this->password,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'user_image' => $this->user_image,
            'deleted_at' => $this->deleted_at,
        ];
    }

    /** DEFAULT CONSTRUCTOR **/

    /** METHODES **/
    /**BEGIN CRUD **/


    public static function verify_user($username, $password)
    {
        global $database;
        $username = $database->escape_string($username);
        $password = $database->escape_string($password);

        $sql = "SELECT * FROM " . self::$table_name . " WHERE ";
        $sql .= "username = ? ";
        $sql .= "AND password = ?";
        $sql .= " LIMIT 1";

        $the_result_array = self::find_this_query($sql, [$username, $password]);
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    public function picture_path_and_placeholder(){
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory.DS.$this->user_image;
    }
    public function set_file($file){
        if(empty($file) || !$file || !is_array($file) || $file['name']==''){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }else{
            $date = date('Y_m_d-H-i-s');
            $without_extension = pathinfo(basename($file['name']), PATHINFO_FILENAME);
            $extension = pathinfo(basename($file['name']), PATHINFO_EXTENSION);
            $this->user_image = $without_extension.$date.'.'.$extension;
            $this->type = $file['type'];
            $this->size = $file['size'];
            $this->tmp_path = $file['tmp_name'];
        }
    }
    public function save_user_and_image(){
        $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->user_image;
        if($this->id){ //bestaat er reeds een image?
            $this->update();
            //testen tmp_path, waarom? Wanneer een image groter is dan de toegelaten grootte, dan
            //zullen type, size en tmp_path leeg zijn. We testen één van deze alvorens op te laden.
            if($this->tmp_path){
                if(move_uploaded_file($this->tmp_path, $target_path)){
                    /*  if($this->create()){//aanmaken in de database*/
                    unset($this->tmp_path);
                    return true;
                    /* }*/
                }
            }
        }else{
            if(!empty($this->errors)){
                return false;
            }
            if(empty($this->user_image) || empty($this->tmp_path)){
                $this->errors[] = "File not available";
                return false;
            }

            if(file_exists($target_path)){
                $this->errors[]= "File {$this->user_image} EXISTS!";
                return false;
            }
            if(move_uploaded_file($this->tmp_path,$target_path)){//upload in de images map
                if($this->create()){//aanmaken in de database
                    unset($this->tmp_path);
                    return true;
                }
            }else{
                $this->errors[] = "This folder has no write rights";
                return false;
            }
        }
    }
    public function delete_user_image()
    {
        if (!empty($this->user_image)) {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path_and_placeholder();
            return unlink($target_path) ? true : false;
        }

    }
    public function update_userphoto(){
        if(!empty($this->user_image)){
            $target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path_and_placeholder();
            return unlink($target_path) ? true: false;
        }
    }
}