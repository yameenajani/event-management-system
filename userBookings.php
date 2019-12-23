<?php
@session_start();
include("dbconnect.php");
$sqleve = 'SELECT a.*, b.*, c.*, d.ID, d.Name FROM EM_EventsChosen as a, EM_EventMaster as b, EM_LocationMaster as c, EM_Registration as d WHERE 1 AND a.fkEventID = b.ID AND b.fkLocation = c.ID AND b.fkIncharge = d.ID AND a.fkRegID = ' . $_SESSION['id'];
$rsleve = $db_conn->query($sqleve);


$my_html .= "</tbody>
</table>
<hr>";

?>
<div class="content-wrapper">
<div class="user-dashboard ml-3">
    <h3>Registered Events :</h3>
    <p class='lead'>You have been registered for the following events:</p>
    <div class='table-responsive'>
        <table id='details' class='table'>
            <thead style='display:table-header-group'>
                <tr>
                    <th scope='col'><b>Event Name</b></th>
                    <th scope='col' style='text-align: left;'><b>Incharge</b></th>
                    <th scope='col' style='text-align: center;'><b>Start Date</b></th>
                    <th scope='col' style='text-align: center;'><b>Start Time</b></th>
                    <th scope='col' style='text-align: center;'><b>End Date</b></th>
                    <th scope='col' style='text-align: center;'><b>End Time</b></th>
                    <th scope='col' style='text-align: center;'><b>Location</b></th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($roweve = $rsleve->fetch_assoc()) {
                    $event = $roweve['eventName'];
                    $incharge = $roweve['Name'];
                    $start = $roweve['StartDateTime'];
                    $startdate = date('d-m-Y', strtotime($start));
                    $starttime = date('H:i', strtotime($start));
                    $end = $roweve['EndDateTime'];
                    $enddate = date('d-m-Y', strtotime($end));
                    $endtime = date('H:i', strtotime($end));
                    $location = $roweve['LocationName'];
                    print("<tr>
                    <td><p>" . $event . "</p></td>
                    <td style = 'text-align: left;'><p>" . $incharge . "</p></td>
                    <td><p style = 'text-align: center;'>" . $startdate . "</p></td>
                    <td><p style='text-align: center;'>" . $starttime . "</p></td>
                    <td><p style = 'text-align: center;'>" . $enddate . "</p></td>
                    <td><p style='text-align: center;'>" . $endtime . "</p></td>
                    <td><p style='text-align: center;'>" . $location . "</p></td>
                    </tr>");
                }
                ?>
            </tbody>
        </table>
    </div>
    <p class='lead'>Want to participate in more events? <?php print("<a href='userEventAdd.php?id=" . $_SESSION['id'] . "'><input type='button' class='btn btn-primary' value='Click Here'></a>");?></p>

</div>
</div>