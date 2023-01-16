<?php

class Session
{
    private $signed_in;
    public $user_id;

    /* automatisch sessie starten*/
    function __construct(){
        session_start();
        $this->check_the_login();
    }
    /*check is er een session met een userid*/
    private function check_the_login(){
        if(isset($_SESSION['user_id'])){
            $this->user_id = $_SESSION['user_id'];
            $this->signed_in = true;
        }else{
            unset($this->user_id);
            $this->signed_in=false;
        }
    }
    public function login($user){
        if($user){
            $this->user_id = $_SESSION['user_id'] = $user->id;
            $this->signed_in = true;
        }
    }
    public function is_signed_in(){
        return $this->signed_in;
    }
    public function logout(){
        unset($_SESSION['user_id']);
        unset($this->user_id);
        $this->signed_in = false;
    }
}
$session = new Session();