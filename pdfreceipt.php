<?php
session_start();
include("dbconnect.php");
// INCLUDE THE phpToPDF.php FILE
require("phpToPDF.php"); 
$data = "SELECT a.*, a.Name as RegName, a.ID as Id, b.*, b.ID as ClassID, c.*, c.ID as BranchID, c.Name as BranchName, d.* FROM `EM_Registration` as a, `EM_Classes` as b, `EM_Branches` as c, `EM_Payments` as d WHERE 1 AND a.fkClass = b.ID AND a.fkBranch = c.ID AND a.ID =".$_SESSION['id'];
$rsl = $db_conn->query($data);
While($row = $rsl->fetch_assoc())
{
    $name = $row["RegName"];
    $contact = $row["Contact"];
    $email = $row["Email"];
    $class = $row["Year"];
    $branch = $row["BranchName"] ;
    $address = $row["billing_address"];
    $txnNum = $row["txn_id"];
    $paidamount = $row["paid_amount"];
    $status = $row["payment_status"];
    $date = $row["Date"];
}

$sqleve = 'SELECT a.*, b.*, c.*, d.ID, d.Name FROM EM_EventsChosen as a, EM_EventMaster as b, EM_LocationMaster as c, EM_Registration as d WHERE 1 AND a.fkEventID = b.ID AND b.fkLocation = c.ID AND b.fkIncharge = d.ID AND a.fkRegID = '.$_SESSION['id'];
$rsleve = $db_conn->query($sqleve);



// PUT YOUR HTML IN A VARIABLE

$my_html_header=
"
<html lang='en'>

<head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
    <link rel='stylesheet' href='static/css/registration.css'>
</head>
<body>
<nav class='navbar navbar-expand-lg navbar-dark bg-dark'>
<p class='navbar-brand'>Event Management</p>
</nav>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src='https://code.jquery.com/jquery-3.4.1.slim.min.js' integrity='sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n' crossorigin='anonymous'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>
</body>
</html>
";

$my_html=
"
<html lang='en'>

<head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
    <link rel='stylesheet' href='static/css/registration.css'>
</head>

<body>
        <h2 class='display-3 text-center'>Thank You!</h1>
        <div class='table-responsive'>
        <table class='table'>
        <tbody>
        <tr>
        <td>
        <h5><b>Contact Information :</b></h5>
        <p><b>Name :</b>$name</p>
        <p><b>Conatct No. :</b>$contact</p>
        <p><b>Email :</b>$email</p>
        <p><b>Year :</b>$class</p>
        <p><b>Branch :</b>$branch</p>
        <p><b>Billing Address :</b><br>$address</p>        
        </td>
        <td>
        <h5><b>Payment Information :</b></h5>
        <p><b>Transaction Date :</b>$date</p>
        <p><b>Transaction ID :</b><br>$txnNum</p>
        <p><b>Paid Amount :</b>Rs. $paidamount</p>
        <p><b>Payment Status :</b>$status</p>
        </td>
        </tr>
        </tbody>
        </table>
        </div>
        <hr>";
        include("barcode.php");

        $my_html .= "
        <hr>
        <h4>Registered Events :</h4>
        <p class='lead'>You have been registered for the following events:</p>
        <table id='details' class='table'>
            <thead style='display:table-header-group'>
            <tr>
                <th scope='col'><b>Event Name</b></th>
                <th scope='col' style = 'text-align: left;'><b>Incharge</b></th>
                <th scope='col' style = 'text-align: center;'><b>Start Date</b></th>
                <th scope='col' style = 'text-align: center;'><b>Start Time</b></th>
                <th scope='col' style = 'text-align: center;'><b>End Date</b></th>
                <th scope='col' style = 'text-align: center;'><b>End Time</b></th>
                <th scope='col' style='text-align: center;'><b>Location</b></th>
            </tr>
            </thead>
            <tbody>";
            
            While($roweve = $rsleve->fetch_assoc())
            {
                $event = $roweve['eventName'];
                $incharge = $roweve['Name'];
                $start = $roweve['StartDateTime'];
                $startdate = date('d-m-Y',strtotime($start));
                $starttime = date('H:i',strtotime($start));
                $end = $roweve['EndDateTime'];
                $enddate = date('d-m-Y',strtotime($end));
                $endtime = date('H:i',strtotime($end));
                $location = $roweve['LocationName'];
                $my_html .= "<tr>
                    <td><p>$event</p></td>
                    <td style = 'text-align: left;'><p>$incharge</p></td>
                    <td><p style = 'text-align: center;'>$startdate</p></td>
                    <td><p style='text-align: center;'>$starttime</p></td>
                    <td><p style = 'text-align: center;'>$enddate</p></td>
                    <td><p style='text-align: center;'>$endtime</p></td>
                    <td><p style='text-align: center;'>$location</p></td>
                    </tr>";
            }
            $my_html .= "</tbody>
        </table>
        <hr>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src='https://code.jquery.com/jquery-3.4.1.slim.min.js' integrity='sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>

    <script>
    $(document).ready(function () {
    $('#details').DataTable({
        'paging': true // false to disable pagination (or any other option)
    });
    $('.dataTables_length').addClass('bs-select');
    });
    </script>
</body>
</html>";

$my_html_footer=
"
<html lang='en'>

<head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css' integrity='sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh' crossorigin='anonymous'>
    <link rel='stylesheet' href='static/css/registration.css'>
</head>
<body>
<footer class='page-footer font-small bg-dark'>

<!-- Copyright -->
<div class='footer-copyright text-center py-3' style='color: white;'>© 2020 Copyright
</div>
<!-- Copyright -->

</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src='https://code.jquery.com/jquery-3.4.1.slim.min.js' integrity='sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n' crossorigin='anonymous'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js' integrity='sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo' crossorigin='anonymous'></script>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js' integrity='sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6' crossorigin='anonymous'></script>
</body>
</html>
";

// SET YOUR PDF OPTIONS
// FOR ALL AVAILABLE OPTIONS, VISIT HERE:  http://phptopdf.com/documentation/
$pdf_options = array(
  "source_type" => 'html',
  "header" => $my_html_header,
  "footer" => $my_html_footer,
  "source" => $my_html,
  "margin"=>array("right"=>"5","left"=>"10","top"=>"25","bottom"=>"25"),
  "page_size" => 'A4',
  "action" => 'save',
  "save_directory" => 'pdf/',
  "file_name" => $name.'.pdf');

// CALL THE phpToPDF FUNCTION WITH THE OPTIONS SET ABOVE
phptopdf($pdf_options);

// OPTIONAL - PUT A LINK TO DOWNLOAD THE PDF YOU JUST CREATED

