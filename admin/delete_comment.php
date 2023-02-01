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
    header('Location:comments.php');
}
//hier komt de delete code
$comment = Comment::find_by_id($_GET['id']);
if($comment){
    //1. photo uit de database verwijderen.
    $comment->delete();
    header('Location:comments.php');
}else{
    header('Location:comments.php');
}
?>

<h1>Hier deleten we comments</h1>

<?php
    require_once("includes/footer.php");

?>
