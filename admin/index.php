<?php
    include("includes/header.php");
    if(!$session->is_signed_in()){
        header("Location:login.php");
    }
    include("includes/sidebar.php");
    include("includes/content-top.php");
    include("includes/content.php");
    include("includes/footer.php");
?>






