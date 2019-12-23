<div class="content-wrapper">
<div class="user-dashboard ml-3">
    <h1>Manage Registrations</h1>
    <div class="form-content">
        <div class='form-group'>
            <div class='table-responsive'>
                <table class='table'>
                    <thead>
                        <tr>
                            <th scope='col'></th>
                            <th scope='col'><b>Name</b></th>
                            <th scope='col'><b>Contact</b></th>
                            <th scope='col'><b>Email</b></th>
                            <th scope='col'><b>DOB</b></th>
                            <th scope='col'><b>Class</b></th>
                            <th scope='col'><b>Branch</b></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sqlcat = "SELECT a.*, a.Name as RegName, a.ID as Id, b.*, c.*, c.Name as BranchName FROM `EM_Registration` as a, `EM_Classes` as b, `EM_Branches` as c WHERE 1 AND a.fkClass = b.ID AND a.fkBranch = c.ID AND a.isDeleted = 'N'";
                        $rslcat = $db_conn->query($sqlcat);
                        while ($rowcat = $rslcat->fetch_assoc()) {
                            $id = $rowcat["Id"];
                            $name = $rowcat["RegName"];
                            $contact = $rowcat["Contact"];
                            $email = $rowcat["Email"];
                            $dob = $rowcat["DOB"];
                            $class = $rowcat["Year"];
                            $branch = $rowcat["BranchName"];
                            print("
                        <tr>
                        <td><a href='updateRegistration.php?id=" . $id . "'><input type='button' class='btn btn-primary' value='Edit'></a>
                        <a href='admindashboard.php?regdelid=" . $id . "'><input type='button' class='btn btn-danger' value='Decline' onclick='ConfirmDelete()'></a></td>                        
                        <td><p>" . $name . "</p></td>
                        <td><p>" . $contact . "</p></td>
                        <td><p>" . $email . "</p></td>
                        <td><p>" . $dob . "</p></td>
                        <td><p>" . $class . "</p></td>
                        <td><p>" . $branch . "</p></td>
                        </tr>
                    ");
                        }
                        print("
                </tbody>
                </table>
                </div>
            ");
                        ?>
            </div>
        </div>
    </div>
</div>