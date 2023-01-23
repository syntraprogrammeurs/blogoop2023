<?php include("includes/header.php");?>
<?php
if (!$session->is_signed_in()) {
    header("Location: login.php");
}
if(empty($_GET['id'])){
    header("Location:photos.php");
}else{
    $photo = Photo::find_by_id($_GET['id']);
    if(isset($_POST['update'])){
        if($photo){
            if($_FILES['file']['name']){
                $photo->update_photo();
            }
            $photo->title = $_POST['title'];
            $photo->description = $_POST['description'];
            $photo->alternate_text = $_POST['alternate_text'];
            $photo->set_file($_FILES['file']);
            $photo->save();

        }
    }}

//$photos = Photo::find_all();

?>;
<?php include("includes/sidebar.php"); ?>
<?php include("includes/content-top.php"); ?>
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
                        <li class="breadcrumb-item">Photos</li>
                    </ol>
                </nav>
            </div>
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
                                    <form class="form" action="edit_photo.php?id=<?php echo $photo->id; ?>"
                                          method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-8 col-12">
                                                <div class="form-group">
                                                    <label for="title">Title</label>
                                                    <input type="text" id="title" class="form-control" placeholder="Title" name="title" value="<?php echo $photo->title; ?>">
                                                </div>

                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description" class="form-control"><?php echo $photo->description; ?></textarea>
                                                </div>

                                                <div class="form-group">
                                                    <label for="alternate_text">Alt</label>
                                                    <input type="text" id="alternate_text" class="form-control"
                                                           placeholder="alternate text" name="alternate_text"
                                                           value="<?php echo $photo->alternate_text; ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea name="description"
                                                              class="form-control"><?php echo $photo->description; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-12">
                                                <img src="<?php echo $photo->picture_path(); ?>" alt="" class="img-fluid img-thumbnail">
                                                <div class="mt-2">
                                                    <p><span></span>Uploaded on: April 01,2021</p>
                                                    <p><span></span>Filename: <?php echo $photo->filename; ?></p>
                                                    <p><span></span>Filetype: <?php echo $photo->type; ?></p>
                                                    <p><span></span>Filesize: <?php echo ($photo->size)/1000; ?> KB</p>
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-between">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" id="fileInput"
                                                           name="file">
                                                </div>
                                                <div>
                                                    <input type="submit" name="update" value="Update" class="btn btn-primary me-1 mb-1">
                                                    <a class="btn btn-light-secondary me-1 mb-1" href="photos.php">Back</a>
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
        </div>
    </div>
</div>
<!-- End Page Content -->
<?php include("includes/footer.php"); ?>

