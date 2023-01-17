<?php
    $users = User::find_all_users();

  /*  $user = new User();
    $user->username = "test2";
    $user->password = "test2";
    $user->first_name = "test2";
    $user->last_name = "test2";
    $user->save();*/

   /* $user = User::find_user_by_id(3);
    $user->delete();*/
/*$user = User::find_user_by_id(1);
$user->last_name = "IKKE";
$user->save();*/
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">

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