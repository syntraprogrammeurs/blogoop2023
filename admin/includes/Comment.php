<?php

class Comment extends Db_object
{
    protected static $table_name='comments';
    public $id;
    public $photo_id;
    public $author;
    public $body;

    public function get_properties(){
        return [
          'id' => $this->id,
          'photo_id' => $this->photo_id,
          'author' => $this->author,
          'body' => $this->body,
        ];
    }
    public static function create_comment($photo_id, $author="defaultauthor", $body=""){
        if(!empty($photo_id) && !empty($author) && !empty($body)){
            $comment = new Comment();
            $comment->photo_id = (int)$photo_id;//typecasting
            $comment->author = $author;
            $comment->body = $body;
            return $comment;
        }else{
            return false;
        }
    }
    public static function find_the_comment($photo_id){
        global $database;
        $sql = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE photo_id = " . $database->escape_string($photo_id);
        $sql .= " ORDER BY id DESC";
        return self::find_this_query($sql);
    }
    public static function find_the_comment_and_title($photo_id, $author){
        global $database;
        $sql = "SELECT * FROM " . self::$table_name;
        $sql .= " WHERE photo_id = " . $database->escape_string($photo_id) . " AND author = " . $database->escape_string($author);
        $sql .= " ORDER BY id DESC";
        return self::find_this_query($sql);
    }
}