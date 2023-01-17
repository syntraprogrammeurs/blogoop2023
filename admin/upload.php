<?php
require_once("includes/header.php");
require_once("includes/sidebar.php");
require_once("includes/content-top.php");
if(!$session->is_signed_in()){
    header("Location:Login.php");
}
$message = "";
$photo = new Photo();
if(isset($_POST['submit'])){
    $photo->title = $_POST['title'];
    $photo->description = $_POST['description'];
    $photo->set_file($_FILES['file']);
}
if($photo->save()){
    $message = "Foto succesvol opgeladen!";
}else{
    $message = join("<br>", $photo->errors);
}
?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div id="content">
                    <nav class="mb-2" aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="#">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item">Upload</li>
                        </ol>
                    </nav>
                </div>
                <h1 class="page-header">Upload</h1>
                <hr>

                <form action="upload.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="title">title</label>
                        <input type="text" name="title" class="form-control">
                    </div>
                    <div class="form-group">
                        <textarea id="editor" type="text" class="form-control" name="description"></textarea>
                    </div>
                    <div class="form-group">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <input type="submit" name="submit" value="Upload" class="btn btn-primary">
                </form>


            </div>
        </div>
    </div>
    <!-- End Page Content -->

<?php
require_once("includes/footer.php")
?>