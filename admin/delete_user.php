<?php
    require_once("includes/header.php");
    require_once("includes/sidebar.php");
    require_once("includes/content-top.php");
?>
<?php

// is er een user ingelogd?
if(!$session->is_signed_in()){
    header('Location:login.php');
}
//is er een id aanwezig in de url zodanig dat we straks deze
//kunnen deleten?
if(empty($_GET['id'])){
    header('Location:users.php');
}
//hier komt de delete code
$user = User::find_by_id($_GET['id']);
if($user){
    //1. photo uit de database verwijderen.
    $user->delete();
    //2. de foto van de server verwijderen uit zijn directory.
    $user->delete_user_image();
    header('Location:users.php');
}else{
    header('Location:users.php');
}
?>

<h1>Hier deleten we foto's van users</h1>

<?php
    require_once("includes/footer.php");

?>
