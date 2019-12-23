<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


    <script>
        function cancel() {
            parent.location = "admindashboard.php?registrations";
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
if(isset($_REQUEST["btnUpdate"]))
{
    if($_REQUEST["btnUpdate"]=="Update")
    {
        $sql = "UPDATE `EM_Registration` SET `Name`='".$_POST['txtName']."',`Contact`='".$_POST['txtContact']."',`Email`='".$_POST['txtEmail']."',`DOB`='".$_POST['txtDOB']."',`fkClass`='".$_POST['selClass']."',`fkBranch`='".$_POST['selBranch']."' WHERE 1 and ID = ".$_REQUEST["id"];
        $rsl = $db_conn->query($sql);
        ?>
        <script>
            parent.location = "admindashboard.php?registrations";
        </script>
        <?php
    }
}
if(isset($_REQUEST["id"]))
{
    $data = "SELECT a.*, a.Name as RegName, a.ID as Id, b.*, b.ID as ClassID, c.*, c.ID as BranchID, c.Name as BranchName FROM `EM_Registration` as a, `EM_Classes` as b, `EM_Branches` as c WHERE 1 AND a.fkClass = b.ID AND a.fkBranch = c.ID AND a.isDeleted = 'N' AND b.isDeleted = 'N' AND c.isDeleted = 'N' AND a.ID =".$_REQUEST["id"];
    $rsl = $db_conn->query($data);
    While($row = $rsl->fetch_assoc())
    {
        $ID  = $row["Id"];
        $name = $row["RegName"];
        $contact = $row["Contact"];
        $email = $row["Email"];
        $dob = $row["DOB"];
        $ClassID = $row["ClassID"];
        $BranchID = $row["BranchID"];
        $class = $row["Year"];
        $branch = $row["BranchName"] ;
    }
}else{
    $name = $_REQUEST["txtName"];
    $contact = $_REQUEST["txtContact"];
    $email = $_REQUEST["txtEmail"];
    $dob = $_REQUEST["txtDOB"];
    $ClassID = $_REQUEST['selClass'];
    $BranchID = $_REQUEST["selBranch"];
}
?>
<body>
    <form class="dataForm" method="POST" name="myForm">
    <br>
    <br>
    <br>
        <div class="form-group row">
        <label for="Name" class="col-sm-2 offset-1 col-form-label">Name</label>
        <div class="col-sm-6">
        <input type="text" class="form-control" name="txtName" placeholder="Name" value="<?php print $name; ?>" required>
        </div>
        </div>
        <div class="form-group row">
        <label for="Contact" class="col-sm-2 offset-1 col-form-label">Contact No.</label>
        <div class="col-sm-6">
        <input type="text" onkeypress="isNumberKey(event);" class="form-control" name="txtContact" placeholder="Contact No." value="<?php print $contact; ?>" required>
        </div>
        </div>
        <div class="form-group row">
        <label for="Email" class="col-sm-2 offset-1 col-form-label">Email</label>
        <div class="col-sm-6">
        <input type="email" class="form-control" name="txtEmail" placeholder="Email" value="<?php print $email; ?>" required>
        </div>
        </div>
        <div class="form-group row">
        <label for="DOB" class="col-sm-2 offset-1 col-form-label">DOB</label>
        <div class="col-sm-6">
        <input type="date" class="form-control" name="txtDOB" value="<?php print $dob; ?>" required>
        </div>
        </div>
        <div class="form-group row">
        <label for="Class" class="col-sm-2 offset-1 col-form-label">Class</label>
        <div class="col-sm-6">
        <select name="selClass">
        <?php
        $sql1 = "Select * from EM_Classes Where 1 AND isDeleted = 'N' Order by ID ASC";
        $rsl1 = $db_conn->query($sql1);
        While($row1 = $rsl1->fetch_assoc())
        {
            $ClassId = $row1["ID"];
            $ClassName = $row1["Year"];
            if($ClassId == $ClassID)
            {
                $selected = "Selected";
            }else{
                $selected = "";
            }
            print('<option value="'.$ClassId.'" '.$selected.'>'.$ClassName.'</option>');
        }
        ?>
        </select>        
        </div>
        </div>
        <div class="form-group row">
        <label for="Branch" class="col-sm-2 offset-1 col-form-label">Branch</label>
        <div class="col-sm-6">
        <select name="selBranch">
        <?php
            $sql2 = "Select * from EM_Branches Where 1 AND isDeleted = 'N' Order by Name ASC";
            $rsl2 = $db_conn->query($sql2);
            While($row = $rsl2->fetch_assoc())
            {
                $BranchId = $row["ID"];
                $BranchName = $row["Name"];
                if($BranchId == $BranchID)
                {
                    $selected = "Selected";
                }else{
                    $selected = "";
                }
                print('<option value="'.$BranchId.'" '.$selected.'>'.$BranchName.'</option>');
            }
        ?>
        </select>
        </div>
        </div>
        <br>
        <div class="form-group row">
        <div class="offset-sm-4 col-sm-6">
        <?php 
        if(isset($_REQUEST["id"]))
        {
            print("<input type='submit' value='Update' name='btnUpdate' class='btn btn-primary'>");
            print("<input type='button' value='Cancel' name='btnCancel' class='btn btn-primary offset-1' onclick='cancel()'>");
        }
        ?>        
        </div>
        </div>
    </form>
</body>
</html>