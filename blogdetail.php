<?php
require_once ("includes/header.php");

require_once ("includes/navbar.php");
if(empty($_GET['id'])){
    header("Location:index.php");
}
$photo = Photo::find_by_id($_GET['id']);
//comments op photo
if(isset($_POST['submit'])){
    $author = $database->escape_string($_POST['author']);
    $body = $database->escape_string($_POST['body']);
    //nieuw commentaar crëeren
    $new_comment = Comment::create_comment($photo->id, $author, $body);
    if($new_comment && $new_comment->save()){
        header("Location:blogdetail.php?id={$photo->id}");
    }else{
        $message="Problems while saving!";
    }
}else{
    $author = "";
    $body = "";
}
$comments = Comment::find_the_comment($photo->id);
?>
<!-- Page content-->
<div class="container mt-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Post content-->
            <article>
                <!-- Post header-->
                <header class="mb-4">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1"><?php echo $photo->title; ?></h1>
                    <!-- Post meta content-->
                    <div class="text-muted fst-italic mb-2">Posted on January 1, 2022 by Start Bootstrap</div>
                    <!-- Post categories-->
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">Web Design</a>
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">Freebies</a>
                </header>
                <!-- Preview image figure-->
                <figure class="mb-4"><img class="img-fluid rounded" src="<?php echo 'admin/' . $photo->picture_path(); ?>" alt="..." /></figure>
                <!-- Post content-->
                <section class="mb-5">
                    <p class="fs-5 mb-4"><?php echo $photo->description; ?></p>
                </section>
            </article>
            <!-- Comments section-->
           <?php require_once("includes/comments.php") ?>
        </div>
        <!-- Side widgets-->
        <div class="col-lg-4">
            <!-- Search widget-->
            <div class="card mb-4">
                <div class="card-header">Search</div>
                <div class="card-body">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Enter search term..." aria-label="Enter search term..." aria-describedby="button-search" />
                        <button class="btn btn-primary" id="button-search" type="button">Go!</button>
                    </div>
                </div>
            </div>
            <!-- Categories widget-->
            <div class="card mb-4">
                <div class="card-header">Categories</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">Web Design</a></li>
                                <li><a href="#!">HTML</a></li>
                                <li><a href="#!">Freebies</a></li>
                            </ul>
                        </div>
                        <div class="col-sm-6">
                            <ul class="list-unstyled mb-0">
                                <li><a href="#!">JavaScript</a></li>
                                <li><a href="#!">CSS</a></li>
                                <li><a href="#!">Tutorials</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Side widget-->
            <div class="card mb-4">
                <div class="card-header">Side Widget</div>
                <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
            </div>
        </div>
    </div>
</div>
<?php require_once ("includes/footer.php") ?>
