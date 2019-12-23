<?php
@session_start();
include("dbconnect.php");
if(isset($_REQUEST["btnUpdate"]))
{
    if($_REQUEST["btnUpdate"]=="Update")
    {
        $sql = "UPDATE `EM_Registration` SET `Name`='".$_POST['txtName']."',`Contact`='".$_POST['txtContact']."',`DOB`='".$_POST['txtDOB']."',`fkClass`='".$_POST['selClass']."',`fkBranch`='".$_POST['selBranch']."' WHERE 1 and ID = ".$_SESSION["id"];
        $rsl = $db_conn->query($sql);
        ?>
        <script>
            parent.location = "dashboard.php?profile";
        </script>
        <?php
    }
}
if(isset($_SESSION["id"]))
{
    $data = "SELECT a.*, a.Name as RegName, a.ID as Id, b.*, b.ID as ClassID, c.*, c.ID as BranchID, c.Name as BranchName FROM `EM_Registration` as a, `EM_Classes` as b, `EM_Branches` as c WHERE 1 AND a.fkClass = b.ID AND a.fkBranch = c.ID AND a.ID =".$_SESSION["id"];
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
}
?>
<div class="content-wrapper">
<div class="user-dashboard ml-3">
<h3>Personal Details :</h3>
    <form class="dataForm" method="POST" name="myForm">
    <br>
        <div class="form-group row">
        <label for="Email" class="col-sm-2 offset-1 col-form-label">Email (username)</label>
        <div class="col-sm-6">
        <input type="email" class="form-control" name="txtEmail" placeholder="Email (username)" value="<?php print $email; ?>" required readonly>
        </div>
        </div>
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
        if(isset($_SESSION["id"]))
        {
            print("<input type='submit' value='Update' name='btnUpdate' class='btn btn-primary'>");
        }
        ?>        
        </div>
        </div>
    </form>
</div>
</div>