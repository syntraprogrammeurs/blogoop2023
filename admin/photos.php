<?php
    include("includes/header.php");
    if(!$session->is_signed_in()){
        header("Location:login.php");
    }
    include("includes/sidebar.php");
    include("includes/content-top.php");
    $photos = Photo::find_all();

    ?>

<div class="container-fluid">
    <div class="row">

        <div class="col-12">
            <div id="content">
                <nav class="mb-2" aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="#">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item">photos</li>
                    </ol>
                </nav>
            </div>


            <h1 class="page-header">Photos</h1>
            <hr>
            <table class="table table-lg">
                <thead>
                <tr>
                    <th class="white-space-nowrap align-middle">
                        <div class="form-check mb-0 fs-0">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </th>
                    <th>PHOTO</th>
                    <th>ID</th>
                    <th>TITLE</th>
                    <th>DESCRIPTION</th>
                    <th>TYPE</th>
                    <th>SIZE</th>
                    <th>ALTERNATE TEXT</th>
                    <th>DELETED_AT</th>
                    <th>ACTIONS</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($photos as $photo): ?>
                    <tr>
                        <td>
                            <div class="form-check mb-0 fs-0">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td><img class="img-thumbnail" src="<?php echo $photo->picture_path(); ?>" width="62" height="62" alt=""></td>
                        <td>
                            <?php echo $photo->id; ?>
                        </td>

                        <td>
                            <?php echo $photo->title; ?>
                        </td>
                        <td>
                            <?php echo $photo->description; ?>
                        </td>
                        <td>
                            <?php echo $photo->type; ?>
                        </td>
                        <td>
                            <?php echo $photo->size/1000 . " KB"; ?>
                        </td>
                        <td>
                            <?php echo $photo->alternate_text; ?>
                        </td>
                        <td>
                            <?php echo $photo->deleted_at; ?>
                        </td>
                        <td>
                            <a title="update" class="btn btn-danger rounded-0" href="edit_photo.php?id=<?php echo $photo->id;?>">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a title="delete" class="btn btn-danger rounded-0" href="delete_photo.php?id=<?php echo $photo->id; ?>">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                        <th></th>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>


        </div>
    </div>
</div>


<?php
    include("includes/footer.php");
?>






