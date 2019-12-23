<div class="content-wrapper">
<div class="user-dashboard ml-3">
    <h1>Manage Events</h1>
    <div class="form-content">
        <div class='form-group'>
            <?php
            $sqlcat = "SELECT * FROM `EM_EventCategories` WHERE 1";
            $rslcat = $db_conn->query($sqlcat);
            while ($rowcat = $rslcat->fetch_assoc()) {
                $id = $rowcat["ID"];
                $category = $rowcat["categoryName"];
                print("
                    <h5 style='text-decoration: underline; color: red;'>" . $category . "</h5>
                    <div class='table-responsive'>
                    <table class='table'>
                        <thead>
                        <tr>
                            <th scope='col'></th>
                            <th scope='col'><b>Event Name</b></th>
                            <th scope='col' style = 'text-align: left;'><b>&emsp;&emsp;Price</b></th>
                            <th scope='col' style = 'text-align: left;'><b>Incharge</b></th>
                            <th scope='col' style = 'text-align: center;'><b>Start Date</b></th>
                            <th scope='col' style = 'text-align: center;'><b>Start Time</b></th>
                            <th scope='col' style = 'text-align: center;'><b>End Date</b></th>
                            <th scope='col' style = 'text-align: center;'><b>End Time</b></th>
                            <th scope='col' style='text-align: center;'><b>Location</b></th>
                            <th scope='col' style = 'text-align: right;'><b>Points</b></th>
                        </tr>
                        </thead>
                        <tbody>
                    ");
                $sqleve = "SELECT a.*, a.ID as EventID, b.*, b.isDeleted as DelIncharge, c.*, c.isDeleted as DelLocation FROM `EM_EventMaster` as a, `EM_Registration` as b, `EM_LocationMaster` as c WHERE 1 AND a.fkIncharge = b.ID AND a.fkLocation = c.ID AND a.isDeleted = 'N' AND a.fkCategory = " . $id;
                $rsleve = $db_conn->query($sqleve);
                while ($roweve = $rsleve->fetch_assoc()) {
                    $eveid = $roweve["EventID"];
                    $event = $roweve["eventName"];
                    $price = number_format($roweve["Price"], 2, '.', '');
                    if ($roweve["DelIncharge"] == 'N') {
                        $incharge = $roweve["Name"];
                    } else {
                        $incharge = " ";
                    }
                    $start = $roweve["StartDateTime"];
                    $startdate = date("d-m-Y", strtotime($start));
                    $starttime = date("H:i", strtotime($start));
                    $end = $roweve["EndDateTime"];
                    $enddate = date("d-m-Y", strtotime($end));
                    $endtime = date("H:i", strtotime($end));
                    if ($roweve["DelLocation"] == 'N') {
                        $location = $roweve["LocationName"];
                    } else {
                        $location = " ";
                    }
                    $points = $roweve["Points"];
                    print("
                        <tr>
                        <td><a href='addEvent.php?id=" . $eveid . "'><input type='button' class='btn btn-primary' value='Edit'></a>
                        <a href='admindashboard.php?evedelid=" . $eveid . "'><input type='button' class='btn btn-danger' value='Delete' onclick='ConfirmDelete()'></a></td>                        
                        <td><p>" . $event . "</p></td>
                        <td><input id='price-" . $eveid . "' type='text'value='" . $price . "' readonly style='width: 70px; border: none; text-align: right;'></td>
                        <td style = 'text-align: left;'><p>" . $incharge . "</p></td>
                        <td><p style = 'text-align: center;'>" . $startdate . "</p></td>
                        <td><p style='text-align: center;'>" . $starttime . "</p></td>
                        <td><p style = 'text-align: center;'>" . $enddate . "</p></td>
                        <td><p style='text-align: center;'>" . $endtime . "</p></td>
                        <td><p style='text-align: center;'>" . $location . "</p></td>
                        <td><p style = 'text-align: right;'>" . $points . " </p></td>
                        </tr>
                    ");
                }
                print("
                </tbody>
                </table>
                </div>
            ");
            }
            ?>
        </div>
        <input type="button" name="btnAddNew" class="btn btn-primary" value="Add New" onclick="parent.location = 'addEvent.php'">
    </div>
</div>
</div>