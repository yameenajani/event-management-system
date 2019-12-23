<?php
@session_start();
include("dbconnect.php");
if (isset($_REQUEST["btnLogin"])) {
    $sql = "SELECT * FROM `EM_AdminAccess` WHERE 1 AND `Email` = '" . $_REQUEST["txtEmail"] . "' AND `Password` = '" . $_REQUEST["txtPassword"] . "' AND isDeleted = 'N'";
    $rsl = $db_conn->query($sql);
    $row = mysqli_num_rows($rsl);
    if ($row == 1) {
        while($rw = $rsl->fetch_assoc())
        {
        $_SESSION['id'] = $rw['ID'];
        $_SESSION['name'] = $rw['Name'];
        }
        $_SESSION['userLogin'] = "Loggedin";
        header('Location: admindashboard.php?dashboard');
    } else {
        $usersql = "SELECT * FROM `EM_Registration` WHERE 1 AND `Email` = '" . $_REQUEST["txtEmail"] . "' AND `password` = '" . $_REQUEST["txtPassword"] . "' and isDeleted = 'N'";
        $userrsl = $db_conn->query($usersql);
        $userrow = mysqli_num_rows($userrsl);
        if ($userrow == 1) {
            while($userrw = $userrsl->fetch_assoc())
            {
            $_SESSION['id'] = $userrw['ID'];
            $_SESSION['name'] = $userrw['Name'];
            }
            $_SESSION['userLogin'] = "Loggedin";
            header('Location:dashboard.php?dashboard');
        } else {
?>
            <script>
                alert("Username or Password is incorrect");
            </script>
<?php
        }
    }
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/login.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <title>Login</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h5 class="card-title text-center">Sign In</h5>
                        <form class="form-signin" method="POST">
                            <div class="form-label-group">
                                <input type="email" id="inputEmail" name="txtEmail" class="form-control" placeholder="Email address" required autofocus>
                                <label for="inputEmail">Email address</label>
                            </div>

                            <div class="form-label-group">
                                <input type="password" id="inputPassword" name="txtPassword" class="form-control" placeholder="Password" required>
                                <label for="inputPassword">Password</label>
                            </div>

                            <div class="form-label-group">
                                <a href="forgotpassword.php" style="text-decoration: none">Forgot password?</a>
                            </div>
                            <input id="btnLogin" name="btnLogin" class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" value="Sign In">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>