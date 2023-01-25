<?php include("includes/header.php"); ?>
<?php
if (!$session->is_signed_in()) {
    header("Location: login.php");
}

if(empty($_GET['id'])){
    header("Location:users.php");
}
//ophalen van de user om uw formulier met values te vullen
$user = User::find_by_id($_GET['id']);

//updaten van de wijzigingen uitgevoerd door de user op het formulier
if(isset($_POST['update_user'])){
    if($user){
        if($_FILES['user_image']['name']){
            $user->update_userphoto();
        }
        $user->username = $database->escape_string($_POST['username']);
        $user->first_name = $database->escape_string($_POST['first_name']);
        $user->last_name = $database->escape_string($_POST['last_name']);
        $user->password = $database->escape_string($_POST['password']);
        $user->set_file($_FILES['user_image']);
        $user->save_user_and_image();
    }
}
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
                        <li class="breadcrumb-item">Users</li>
                    </ol>
                </nav>
            </div>
            <h1 class="page-header">Users</h1>
            <hr>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Update User</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <form class="form" method="post" enctype="multipart/form-data">
                                        <div class="row">

                                            <div class="form-group col-12 col-lg-6">
                                                <label for="username">Username</label>
                                                <input type="text" id="username" class="form-control"
                                                       placeholder="username" name="username" value="<?php echo
                                                $user->username; ?>">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="first_name">First Name</label>
                                                <input type="text" id="first_name" class="form-control"
                                                       placeholder="firstname" name="first_name" value="<?php echo
                                                $user->first_name; ?>">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" id="last_name" class="form-control"
                                                       placeholder="lastname" name="last_name" value="<?php echo
                                                $user->last_name; ?>">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="password">Password</label>
                                                <input type="password" id="password" class="form-control"
                                                       name="password" value="<?php echo $user->password; ?>">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <img class="img-fluid img-thumbnail" src="<?php echo
                                                $user->picture_path_and_placeholder() ?>" alt="">
                                            </div>
                                            <div class="form-group col-12 col-lg-6">
                                                <label for="file">User image</label>
                                                <input type="file" id="user_image" class="form-control"
                                                       name="user_image">
                                            </div>

                                            <div class="col-12 d-flex justify-content-end">
                                                <input type="submit" name="update_user" value="Update user" class="btn
                                                btn-primary">
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

