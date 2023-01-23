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
    header('Location:photos.php');
}
//hier komt de delete code
$photo = Photo::find_by_id($_GET['id']);
if($photo){
    //1. photo uit de database verwijderen.
    //2. de foto van de server verwijderen uit zijn directory.
    $photo->delete_photo();
    header('Location:photos.php');
}else{
    header('Location:photos.php');
}

?>


<h1>Hier deleten we foto's</h1>

<?php
    require_once("includes/footer.php");

?>
