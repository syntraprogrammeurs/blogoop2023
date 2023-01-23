<?php

class Photo extends Db_object
{
    protected static $table_name = "photos";
    public $id;
    public $title;
    public $description;
    public $filename;
    public $type;
    public $size;
    public $alternate_text;
    public $deleted_at;
    public $tmp_path;
    public $upload_directory = "assets/images/photos";
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload max_filesize from php.ini",
        UPLOAD_ERR_FORM_SIZE => "The upload file exceeds MAX_FILE_SIZE in php.ini voor een html form",
        UPLOAD_ERR_NO_FILE => "No file uploaded",
        UPLOAD_ERR_PARTIAL => "The file was partially uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write to disk",
        UPLOAD_ERR_EXTENSION => "A php extension stopped your upload",
    );

    //object properties
    public function get_properties(){
        return [
            'id' => $this->id,
            'title'=> $this->title,
            'description' => $this->description,
            'filename' => $this->filename,
            'type' => $this->type,
            'size' => $this->size,
            'alternate_text'=> $this->alternate_text,
            'deleted_at' => $this->deleted_at,
        ];
    }

    /* methods */
    //opvang van errors
    public function set_file($file){
        if(empty($file) || !$file || !is_array($file) || $file['name']==''){
            $this->errors[] = "no file uploaded";
            return false;
        }else{
            $date = date('Y_m_d-H-i-s');
            $without_extension = pathinfo(basename($file['name']), PATHINFO_FILENAME);
            $extension = pathinfo(basename($file['name']), PATHINFO_EXTENSION);
            $this->filename = $without_extension.$date.'.'.$extension;
            $this->type = $file['type'];
            $this->size = $file['size'];
            $this->tmp_path = $file['tmp_name'];
        }
    }
    public function save(){
        $target_path = SITE_ROOT.DS.'admin'.DS.$this->upload_directory.DS.$this->filename;
        if($this->id){ //bestaat er reeds een image?
            $this->update();
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
            if(empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "File not available";
                return false;
            }

            if(file_exists($target_path)){
                $this->errors[]= "File {$this->filename} EXISTS!";
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
    public function picture_path(){
        if($this->filename && file_exists($this->upload_directory.DS.$this->filename)){
            return $this->upload_directory.DS.$this->filename;
        }else{
            return 'https://via.placeholder.com/62';
        };
    }
    //deleten van een foto
    public function delete_photo(){
        if($this->delete()){
           $target_path = SITE_ROOT.DS.'admin'.DS. $this->picture_path();
           return unlink($target_path) ? true : false;
        }else{
            return false;
        }
    }
    public function update_photo(){
        if(!empty($this->filename)){
           $target_path = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
           return unlink($target_path) ? true: false;
        }
    }
}