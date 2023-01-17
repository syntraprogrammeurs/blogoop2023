<?php
    include("includes/header.php");
    if(!$session->is_signed_in()){
        header("Location:login.php");
    }
    include("includes/sidebar.php");
    include("includes/content-top.php");
    $users = User::find_all();
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
                        <li class="breadcrumb-item">Users</li>
                    </ol>
                </nav>
            </div>
            <h1 class="page-header">Users</h1>
            <hr>
            <table class="table table-lg">
                <thead>
                <tr>
                    <th class="white-space-nowrap align-middle">
                        <div class="form-check mb-0 fs-0">
                            <input type="checkbox" class="form-check-input">
                        </div>
                    </th>
                    <th>ID</th>
                    <th>USERNAME</th>
                    <th>FIRSTNAME</th>
                    <th>LASTNAME</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td>
                            <div class="form-check mb-0 fs-0">
                                <input type="checkbox" class="form-check-input">
                            </div>
                        </td>
                        <td>
                            <?php echo $user->id; ?>
                        </td>
                        <td>
                            <div class="avatar avatar-md">
                                <img class="rounded-circle" src="https://robohash.org/mail@ashallendesign.co.uk" alt="">
                            </div>
                            <?php echo $user->username; ?>
                        </td>
                        <td>
                            <?php echo $user->first_name; ?>
                        </td>
                        <td>
                            <?php echo $user->last_name; ?>
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






