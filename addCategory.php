<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categories</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script>
        function cancel() {
            parent.location = "admindashboard.php?categories";
        }
    </script>
</head>
<?php
@session_start();
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    ?>
    <script>alert("Unauthorized Access! Please Login.");</script>
    <?php
    header("Location: login.php");
}
include("dbconnect.php");
if (isset($_REQUEST["btnUpdate"])) {
    if ($_REQUEST["btnUpdate"] == "Update") {
        $sql = "UPDATE `EM_EventCategories` SET `categoryName`='" . $_POST['txtCategoryName'] . "',`DateCreated`='" . $_POST['txtDate'] . "' WHERE 1 and ID = " . $_REQUEST["id"];
        $rsl = $db_conn->query($sql);
        ?>
        <script>
            parent.location = "admindashboard.php?categories";
        </script>
    <?php
        }
    }

    if (isset($_REQUEST["btnSubmit"])) {
        $sql = "INSERT INTO `EM_EventCategories`(`categoryName`, `DateCreated`) VALUES (";
        $sql .= "'" . $_POST['txtCategoryName'] . "','" . $_POST['txtDate'] . "')";
        $rsl = $db_conn->query($sql);
        if ($_REQUEST["btnSubmit"] == "Save & Close") {
            ?>
        <script>
            parent.location = "admindashboard.php?categories";
        </script>
<?php
    }
}

if (isset($_REQUEST["id"])) {
    $data = "SELECT * FROM `EM_EventCategories` WHERE 1 AND isDeleted = 'N' AND ID =" . $_REQUEST["id"];
    $rsl = $db_conn->query($data);
    while ($row = $rsl->fetch_assoc()) {
        $ID  = $row["ID"];
        $category = $row["categoryName"];
        $dateCreated = $row["DateCreated"];
    }
} else {
    $category = $_REQUEST['txtCategoryName'];
    $dateCreated = $_REQUEST["txtDate"];
}
?>

<body>
    <form class="dataForm" method="POST" name="myForm">
        <br>
        <br>
        <br>
        <div class="form-group row">
            <label for="Category Name" class="col-sm-2 offset-1 col-form-label">Category Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="txtCategoryName" placeholder="Category Name" value="<?php print $category; ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="DateCreated" class="col-sm-2 offset-1 col-form-label">Date Created</label>
            <div class="col-sm-6">
                <input type="date" class="form-control" name="txtDate" placeholder="Date Created" value="<?php print $dateCreated; ?>" required>
            </div>
        </div>
        <br>
        <div class="form-group row">
            <div class="offset-sm-4 col-sm-6">
                <?php
                if (isset($_REQUEST["id"])) {
                    print("<input type='submit' value='Update' name='btnUpdate' class='btn btn-primary'>");
                    print("<input type='button' value='Cancel' name='btnCancel' class='btn btn-primary offset-1' onclick='cancel()'>");
                } else {
                    print("<input type='submit' value='Save & Close' name='btnSubmit' class='btn btn-primary'>");
                    print("<input type='submit' value='Save & Continue' name='btnSubmit' class='btn btn-primary offset-1'>");
                    print("<input type='button' value='Cancel' name='btnCancel' class='btn btn-primary offset-1' onclick='cancel()'>");
                }
                ?>
            </div>
        </div>
    </form>
</body>

</html>