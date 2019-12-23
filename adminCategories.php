<div class="content-wrapper">
<div class="user-dashboard ml-3">
    <h1>Manage Categories</h1>
    <div class="form-content">
        <div class='form-group'>
            <div class='table-responsive'>
            <table class='table'>
                <thead>
                <tr>
                    <th scope='col'></th>
                    <th scope='col'><b>Category Name</b></th>
                    <th scope='col' style = 'text-align: center;'><b>Date Created</b></th>
                </tr>
                </thead>
                <tbody>
                <?php
            $sqlcat = "SELECT * FROM `EM_EventCategories` WHERE 1 AND isDeleted = 'N'";
            $rslcat = $db_conn->query($sqlcat);
                while ($rowcat = $rslcat->fetch_assoc()) {
                    $catid = $rowcat["ID"];
                    $category = $rowcat["categoryName"];
                    $date = $rowcat["DateCreated"];
                    print("
                        <tr>
                        <td><a href='addCategory.php?id=" . $catid . "'><input type='button' class='btn btn-primary' value='Edit'></a>
                        <a href='admindashboard.php?catdelid=" . $catid . "'><input type='button' class='btn btn-danger' value='Delete' onclick='ConfirmDelete()'></a></td>                        
                        <td><p>" . $category . "</p></td>
                        <td><p style = 'text-align: center;'>" . $date . "</p></td>
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
        <input type="button" name="btnAddNew" class="btn btn-primary" value="Add New" onclick="parent.location = 'addCategory.php'">
    </div>
</div>
</div>