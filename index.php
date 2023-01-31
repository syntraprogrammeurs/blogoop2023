<?php
require_once ("includes/header.php");
require_once ("includes/navbar.php");

$photos = Photo::find_all();
?>
<h1>Hier komt een overzicht van al mijn blogitems</h1>

<div class="row row-cols-1 row-cols-md-3 row-cols-lg-5">
<?php foreach($photos as $photo): ?>
<div class="col">
    <div class="card h-100">
        <div class="card-content">
            <div class="card-body">
                <h4 class="card-title"><?php echo $photo->title ?></h4>
                <p class="card-text">
                    <?php echo $photo->description ?>
                </p>
            </div>
            <img class="img-fluid w-100" src="<?php echo 'admin/' . $photo->picture_path(); ?>" alt="Card image cap">
        </div>
        <div class="card-footer d-flex justify-content-center mt-auto">
            <a class="btn btn-light-primary" href="blogdetail.php?id=<?php echo $photo->id; ?>">  <i class="bi bi-eye-fill text-secondary fs-1"></i></a>

        </div>
    </div>
</div>

<?php endforeach; ?>
</div>
<?php require_once ("includes/footer.php") ?>