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
//hier komt de update code

if(empty($_GET['id'])){
    header('Location:photos.php');
}else{
    $photo = Photo::find_by_id($_GET['id']);
    if(isset($_POST['update'])){
        //hier wordt de update verwerkt van de variabelen afkomstig uit ons formulier hieronder
    }else{

    }
}

?>
<h1 class="page-header">Photos</h1>
<hr>
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Edit Photo</h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form action="edit_photo.php?id=<?php echo $photo->id; ?>" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8 col-12">
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" id="title" class="form-control" placeholder="Title" name="title">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="alternate_text">Alternate Text</label>
                                        <input type="text" id="alternate_text" class="form-control" placeholder="Alt" name="alternate_text">
                                    </div>

                                </div>
                                <div class="col-md-4">
                                    <img src="" alt="" class="img-fluid img-thumbnail">
                                    <div class="mt-2">
                                        <p><span>Uploaded on:</span></p>
                                        <p><span>Filename:</span></p>
                                        <p><span>Filetype:</span></p>
                                        <p><span>Filesize:</span></p>
                                    </div>
                                </div>
                                <div class="col-12 d-flex justify-content-between">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="fileinput" name="file">
                                    </div>
                                    <div>
                                        <input type="submit" name="update" value="Update" class="btn btn-primary me-1 mb-1">
                                        <a href="photos.php" class="btn btn-light-secondary me-1 mb-1">Back</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php
require_once("includes/footer.php");

?>
