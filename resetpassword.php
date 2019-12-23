<?php
@session_start();
include("dbconnect.php");
switch ($qry[1]) {
    case 'admin':
        if (isset($_REQUEST["btnSubmit"])) {
            if ($_POST['txtPassword'] == $_POST['txtConfirmPassword']) {
                $sql = "UPDATE `EM_AdminAccess` SET `Password`='" . $_POST['txtPassword'] . "' WHERE 1 and ID = " . $_SESSION['id'];
                $rsl = $db_conn->query($sql);
?>
                <script>
                    parent.location = "admindashboard.php?dashboard";
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("Passwords do not match");
                </script>
            <?php
            }
        }
        break;
    case 'user':
        if (isset($_REQUEST["btnSubmit"])) {
            if ($_POST['txtPassword'] == $_POST['txtConfirmPassword']) {
                $sql = "UPDATE `EM_Registration` SET `password`='" . $_POST['txtPassword'] . "' WHERE 1 and ID = " . $_SESSION['id'];
                $rsl = $db_conn->query($sql);
            ?>
                <script>
                    parent.location = "dashboard.php?dashboard";
                </script>
            <?php
            } else {
            ?>
                <script>
                    alert("Passwords do not match");
                </script>
<?php
            }
        }
}
?>

<div class="content-wrapper">
<div class="user-dashboard ml-3">
<h3>Change Password :</h3>
    <form id="resetPass" class="dataForm" method="POST" name="myForm">
        <br>
        <div class="form-group row">
            <label for="Password" class="col-sm-2 offset-1 col-form-label">New Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="txtPassword" placeholder="Password" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="ConfirmPassword" class="col-sm-2 offset-1 col-form-label">Confirm Password</label>
            <div class="col-sm-6">
                <input type="password" class="form-control" name="txtConfirmPassword" placeholder="Confirm Password" required>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <div class="offset-sm-4 col-sm-6">
                <input type='submit' value='Save' name='btnSubmit' class='btn btn-primary'>
            </div>
        </div>
    </form>
</div>
</div>