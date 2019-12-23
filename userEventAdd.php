<?php
@session_start();
include("dbconnect.php");
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="static/css/registration.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Events Registration</title>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</head>

<body>
<form id="AddEvent" class="dataForm" method="POST" name="addEventUser" style="margin-top: 50px;">
<div class="register-form frm">
    <div class="form frm">
        <div class="note">
            <p>EVENTS</p>
        </div>

        <div id="events" class="form-content">
            <div class='form-group'>
            <small><i>Please select the events you want to participate in.</i></small>
            <?php
            $sqlcat = "SELECT * FROM `EM_EventCategories` WHERE 1";
            $rslcat = $db_conn->query($sqlcat);
            While ($rowcat = $rslcat->fetch_assoc()) {
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
                $sqleve = "SELECT a.*, a.ID as EventID, b.*, b.isDeleted as DelIncharge, c.*, c.isDeleted as DelLocation FROM `EM_EventMaster` as a, `EM_Registration` as b, `EM_LocationMaster` as c WHERE 1 AND a.fkIncharge = b.ID AND a.fkLocation = c.ID AND a.isDeleted = 'N' AND a.isDeleted = 'N' AND a.fkCategory = ".$id;
                $rsleve = $db_conn->query($sqleve);        
                While($roweve = $rsleve->fetch_assoc())
                {
                    $eveid = $roweve["EventID"];
                    $event = $roweve["eventName"];
                    $price = number_format($roweve["Price"], 2, '.','');
                    if($roweve["DelIncharge"] == 'N')
                    {
                        $incharge = $roweve["Name"];
                    }
                    else
                    {
                        $incharge = " ";
                    }
                    $start = $roweve["StartDateTime"];
                    $startdate = date("d-m-Y",strtotime($start));
                    $starttime = date("H:i",strtotime($start));
                    $end = $roweve["EndDateTime"];
                    $enddate = date("d-m-Y",strtotime($end));
                    $endtime = date("H:i",strtotime($end));
                    if($roweve["DelLocation"] == 'N')
                    {
                        $location = $roweve["LocationName"];
                    }
                    else
                    {
                        $location = " ";
                    }
                    $points = $roweve["Points"];
                    {
                    print("
                        <tr id='".$eveid."'>
                        <td><input class='chkbx' type='checkbox' name='chkEvent[]' value='" .$eveid. "' id='".$eveid. "' onclick='updateTotal(this)'></td>
                        <td><p>" .$event. "</p></td>
                        <td><input id='price-".$eveid."' type='text'value='" .$price."' readonly style='width: 70px; border: none; text-align: right;'></td>
                        <td style = 'text-align: left;'><p>" .$incharge. "</p></td>
                        <td><p style = 'text-align: center;'>" .$startdate. "</p></td>
                        <td><p style='text-align: center;'>" .$starttime. "</p></td>
                        <td><p style = 'text-align: center;'>" .$enddate. "</p></td>
                        <td><p style='text-align: center;'>" .$endtime. "</p></td>
                        <td><p style='text-align: center;'>" .$location. "</p></td>
                        <td><p style = 'text-align: right;'>" .$points." </p></td>
                        </tr>
                    ");
                }
            }
                print("
                </tbody>
                </table>
                </div>
            ");
            }
            $sqlno = "SELECT * FROM `EM_EventsChosen` WHERE 1 AND fkRegId = ".$_REQUEST['id'];
            $rslno = $db_conn->query($sqlno);
            While($rowno = $rslno->fetch_assoc())
            {
                $eventID = $rowno['fkEventID'];
                ?>
                <script>
                    document.getElementById(<?php print($eventID); ?>).style.display = "none";
                </script>
                <?php
            }
            ?>
            </div>
        </div>
    </div>
</div>
<?php include("payment.php"); ?>
<input type='submit' value='Pay & Submit' name='btnSubmit' id='btnSubmit' class='btnSubmit btn-success offset-3'>
<input type='button' value='Cancel' name='btnCancel' class='btnSubmit btn-primary offset-1' onclick='cancel()'>
</form>


<script type="text/javascript">
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

        var total;
        function updateTotal(element) {
            total = 0.00;
            var id, price, count = 0;
            var inputElems = document.getElementsByTagName("input");
            for (var i = 0; i < inputElems.length; i++) {
                if (inputElems[i].type === "checkbox") {
                    if (inputElems[i].checked === true) {
                        count++;
                        id = inputElems[i].id;
                        price = document.getElementById("price-" + id).value;
                        total = (+total) + (+price);
                    }
                }
            }
            document.getElementById("totalAmt").innerHTML = "PAYABLE AMOUNT : " + total.toFixed(2);
        }

        jQuery(document).ready(function($) {
            var $form = $('#AddEvent');
            $form.submit(function(e) {
                if($('#events input:checked').length > 0)
                {
                var $formdata = $('#AddEvent').serialize();
                $.ajax({
                    type: "POST",
                    url: 'addEventData.php',
                    data: $formdata,
                    cache: false,
                    success: window.open('paymentForm.php?total='+total.toFixed(2)*100)
                });
            } else {
                alert('Please select atleast one event');
                e.preventDefault();
            } 
            });
        });
    </script>
    <script>
        function cancel() {
            parent.location = "dashboard.php?bookings";
        }
    </script>
</body>
</html>