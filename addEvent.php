<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Events</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script>
        function cancel() {
            parent.location = "admindashboard.php?events";
        }
    </script>
</head>
<?php
@session_start();
include("dbconnect.php");
if(empty($_SESSION['userLogin']) || $_SESSION['userLogin'] == ''){
    ?>
    <script>alert("Unauthorized Access! Please Login.");</script>
    <?php
    header("Location: login.php");
}
if (isset($_REQUEST["btnUpdate"])) {
    if ($_REQUEST["btnUpdate"] == "Update") {
        $sql = "UPDATE `EM_EventMaster` SET `eventName`='" . $_POST['txtEventName'] . "',`fkCategory`='" . $_POST['selCategory'] . "',`Price`='" . $_POST['txtPrice'] . "',`fkIncharge`='" . $_POST['selIncharge'] . "',`StartDateTime`='" . $_POST['txtStart'] . "',`EndDateTime`='" . $_POST['txtEnd'] . "',`fkLocation`='" . $_POST['selLocation'] . "',`Points`='" . $_POST['txtPoints'] . "',`DateCreated`='" . $_POST['txtDate'] . "' WHERE 1 and ID = " . $_REQUEST["id"];
        $rsl = $db_conn->query($sql);
        ?>
        <script>
            parent.location = "admindashboard.php?events";
        </script>
    <?php
        }
    }

    if (isset($_REQUEST["btnSubmit"])) {
        $sql = "INSERT INTO `EM_EventMaster`(`eventName`, `fkCategory`, `Price`, `fkIncharge`, `StartDateTime`, `EndDateTime`, `fkLocation`, `Points`, `DateCreated`) VALUES (";
        $sql .= "'" . $_POST['txtEventName'] . "','" . $_POST['selCategory'] . "','" . $_POST['txtPrice'] . "','" . $_POST['selIncharge'] . "','" . $_POST['txtStart'] . "','" . $_POST['txtEnd'] . "','" . $_POST['selLocation'] . "','" . $_POST['txtPoints'] . "','" . $_POST['txtDate'] . "')";
        $rsl = $db_conn->query($sql);
        if ($_REQUEST["btnSubmit"] == "Save & Close") {
            ?>
        <script>
            parent.location = "admindashboard.php?events";
        </script>
<?php
    }
}

if (isset($_REQUEST["id"])) {
    $data = "SELECT a.ID, a.eventName, a.fkCategory, a.Price, a.fkIncharge, a.StartDateTime, a.EndDateTime, a.fkLocation, a.Points, a.DateCreated, b.ID as CategoryID, b.categoryName, c.ID as InchargeID, c.Name, d.ID as LocationID, d.LocationName FROM `EM_EventMaster` as a, `EM_EventCategories` as b, `EM_Registration` as c, `EM_LocationMaster` as d WHERE 1 and a.fkCategory = b.ID and a.fkIncharge = c.ID and a.fkLocation = d.ID and a.isDeleted = 'N' and a.ID =" . $_REQUEST["id"];
    $rsl = $db_conn->query($data);
    while ($row = $rsl->fetch_assoc()) {
        $ID  = $row["ID"];
        $CategoryID = $row["CategoryID"];
        $category = $row["categoryName"];
        $EventName = $row["eventName"];
        $price = $row["Price"];
        $InchargeID = $row["InchargeID"];
        $incharge = $row["Name"];
        $start = $row["StartDateTime"];
        $end = $row["EndDateTime"];
        $LocationID = $row["LocationID"];
        $location = $row["LocationName"];
        $points = $row["Points"];
        $dateCreated = $row["DateCreated"];
    }
} else {
    $CategoryID = $_REQUEST['selCategory'];
    $EventName = $_REQUEST["txtEventName"];
    $price = $_REQUEST["txtPrice"];
    $InchargeID = $_REQUEST["selIncharge"];
    $start = $_REQUEST["txtStart"];
    $end = $_REQUEST["txtEnd"];
    $LocationID = $_REQUEST["selLocation"];
    $points = $_REQUEST["txtPoints"];
    $dateCreated = $_REQUEST["txtDate"];
}
?>

<body>
    <form class="dataForm" method="POST" name="myForm">
        <br>
        <br>
        <br>
        <div class="form-group row">
            <label for="Category" class="col-sm-2 offset-1 col-form-label">Event Category</label>
            <div class="col-sm-6">
                <select name="selCategory" required>
                    <?php
                    $sql1 = "Select * from EM_EventCategories Where 1 AND isDeleted = 'N' Order by categoryName ASC";
                    $rsl1 = $db_conn->query($sql1);
                    while ($row1 = $rsl1->fetch_assoc()) {
                        $CatId = $row1["ID"];
                        $CatName = $row1["categoryName"];
                        if ($CatId == $CategoryID) {
                            $selected = "Selected";
                        } else {
                            $selected = "";
                        }
                        print('<option value="' . $CatId . '" ' . $selected . '>' . $CatName . '</option>');
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="Event Name" class="col-sm-2 offset-1 col-form-label">Event Name</label>
            <div class="col-sm-6">
                <input type="text" class="form-control" name="txtEventName" placeholder="Event Name" value="<?php print $EventName; ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="Price" class="col-sm-2 offset-1 col-form-label">Price</label>
            <div class="col-sm-6">
                <input type="text" onkeypress="isNumberKey(event);" class="form-control" name="txtPrice" placeholder="Price" value="<?php print $price; ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="City" class="col-sm-2 offset-1 col-form-label">Incharge</label>
            <div class="col-sm-6">
                <select name="selIncharge" required>
                    <?php
                    $sql2 = "Select * from EM_Registration Where 1 AND isDeleted = 'N' Order by Name ASC";
                    $rsl2 = $db_conn->query($sql2);
                    while ($row = $rsl2->fetch_assoc()) {
                        $IncId = $row["ID"];
                        $IncName = $row["Name"];
                        if ($IncId == $InchargeID) {
                            $selected = "Selected";
                        } else {
                            $selected = "";
                        }
                        print('<option value="' . $IncId . '" ' . $selected . '>' . $IncName . '</option>');
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="Start" class="col-sm-2 offset-1 col-form-label">Start Date & Time</label>
            <div class="col-sm-6">
                <input type="datetime-local" class="form-control" name="txtStart" placeholder="Email" value="<?php print $start; ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="End" class="col-sm-2 offset-1 col-form-label">End Date & Time</label>
            <div class="col-sm-6">
                <input type="datetime-local" class="form-control" name="txtEnd" placeholder="Email" value="<?php print $end; ?>" required>
            </div>
        </div>
        <div class="form-group row">
            <label for="City" class="col-sm-2 offset-1 col-form-label">Location</label>
            <div class="col-sm-6">
                <select name="selLocation" required>
                    <?php
                    $sql3 = "Select * from EM_LocationMaster Where 1 AND isDeleted = 'N' Order by LocationName ASC";
                    $rsl3 = $db_conn->query($sql3);
                    while ($row = $rsl3->fetch_assoc()) {
                        $LocId = $row["ID"];
                        $LocName = $row["LocationName"];
                        if ($LocId == $LocationID) {
                            $selected = "Selected";
                        } else {
                            $selected = "";
                        }
                        print('<option value="' . $LocId . '" ' . $selected . '>' . $LocName . '</option>');
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="Points" class="col-sm-2 offset-1 col-form-label">Points</label>
            <div class="col-sm-6">
                <input type="text" onkeypress="isNumberKey(event);" class="form-control" name="txtPoints" placeholder="Points" value="<?php print $points; ?>" required>
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