<?php
    require_once("config.php");

class Database
{
    /** PROPERTIES **/
    public $connection;

    /** DEFAULT CONSTRUCTOR
    Wanneer deze class wordt gebruikt, dan wordt EERST alle code hiervan uitgevoerd.
     **/
    function __construct(){
        $this->open_db_connection();
    }
    /** METHODS (FUNCTIONS) **/
    /** met deze functie openen we de database **/
    public function open_db_connection(){
        $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    }
    public function query($sql,$params = []){
       /* $result = $this->connection->query($sql);
        $this->confirm_query($result);
        return $result;*/
        // create a prepared statement
        $stmt = $this->connection->prepare($sql);
        //bind the parameters
        if(!empty($params)){
            $types = "";
            $values = [];
            foreach($params as $param){
                if(is_int($param)){
                    $types .= "i";
                }elseif(is_float($param)){
                    $types .= "d";
                }else{
                    $types .= "s";
                }
                $values[]= $param;
            }
            array_unshift($values, $types);
            call_user_func_array([$stmt,"bind_param"],$this->ref_values($values));
        }
        //execute statement
        $stmt->execute();
        //process result
        $result = $stmt->get_result();
        //close statement
        $stmt->close();
        return $result;
    }
    private function ref_values($array) {
        $refs = [];
        foreach ($array as $key => $value) {
            if ($key === 0) {
                $refs[$key] = $value;
            } else {
                $refs[$key] = &$array[$key];
            }
        }
        return $refs;
    }

    public function confirm_query($result){
        if(!$result){
            die("Query kan niet worden uitgevoerd " . $this->connection->error);
        }
    }
    public function escape_string($string){
          if($string !== null) {
              $escaped_string = $this->connection->real_escape_string($string);
              return $escaped_string;
          }
    }
}
$database = new Database();
?>

