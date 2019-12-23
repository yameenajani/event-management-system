<div class="content-wrapper">
<div class="user-dashboard ml-3">
    <h1>Manage Locations</h1>
    <div class="form-content">
        <div class='form-group'>
            <div class='table-responsive'>
            <table class='table'>
                <thead>
                <tr>
                    <th scope='col'></th>
                    <th scope='col'><b>Location Name</b></th>
                </tr>
                </thead>
                <tbody>
                <?php
            $sqlcat = "SELECT * FROM `EM_LocationMaster` WHERE 1 AND isDeleted = 'N'";
            $rslcat = $db_conn->query($sqlcat);
                while ($rowcat = $rslcat->fetch_assoc()) {
                    $id = $rowcat["ID"];
                    $location = $rowcat["LocationName"];
                    print("
                        <tr>
                        <td><a href='addLocation.php?id=" . $id . "'><input type='button' class='btn btn-primary' value='Edit'></a>
                        <a href='admindashboard.php?locdelid=" . $id . "'><input type='button' class='btn btn-danger' value='Delete' onclick='ConfirmDelete()'></a></td>                        
                        <td><p>" . $location . "</p></td>
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
        <input type="button" name="btnAddNew" class="btn btn-primary" value="Add New" onclick="parent.location = 'addLocation.php'">
    </div>
</div>
</div>