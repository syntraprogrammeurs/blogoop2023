<?php
include("includes/header.php");
if(!$session->is_signed_in()){
    header("Location:login.php");
}
include("includes/sidebar.php");
include("includes/content-top.php");
$comments = Comment::find_the_comment($_GET['id']);
$photo = Photo::find_by_id($_GET['id']);
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
                        <li class="breadcrumb-item">Comments</li>
                    </ol>
                </nav>
            </div>
            <h1 class="page-header">Comments on <?php echo $photo->id . ":" .$photo->title?></h1>
            <hr>
            <table id="table_id" class="table table-lg">
                <thead>
                <tr>
                    <th class="white-space-nowrap align-middle">
                        <div class="form-check mb-0 fs-0">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </th>
                    <th>ID</th>
                    <th>AUTHOR</th>
                    <th>BODY</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($comments as $comment): ?>

                        <tr>
                            <td>
                                <div class="form-check mb-0 fs-0">
                                    <input type="checkbox" class="form-check-input">
                                </div>
                            </td>
                            <td>
                                <?php echo $comment->id; ?>
                            </td>
                            <td>
                                <?php echo $comment->author; ?>
                            </td>
                            <td>
                                <?php echo $comment->body; ?>
                            </td>
                            <td>
                                <a class="btn btn-danger" href="edit_comment.php?id=<?php echo $comment->id; ?>">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <a class="btn btn-danger" href="delete_comment.php?id=<?php echo $comment->id; ?>">
                                    <i class="bi bi-trash3-fill"></i>
                                </a>
                            </td>

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






