<?php
@session_start();
define('STRIPE_API_KEY', 'sk_test_44NNINOVFofUiCP8A9SCginx00MTXhrXIq');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_hULczefdKnXOcqZqEyjcukf2007fUTdyyS');

include("dbconnect.php");
$valid = 0;
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

    <title>EManager | Registration</title>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">EManager</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <a href="login.php" class="btn btn-success" style="color: white;">Log In</a>
            </form>
        </div>
    </nav>
    <form id="RegForm" class="dataForm" method="POST" name="myForm">
        <br>
        <h4 style="text-align: center; text-decoration: underline;">PARTICIPANT REGISTRATION</h4>
        <?php
        include("personalDetails.php");
        include("events.php");
        include("payment.php");
        print("<input type='submit' value='Pay & Submit' name='btnSubmit' id='btnSubmit' class='btnSubmit btn-success offset-5'>");
        ?>
        <br>
    </form>
    <!-- Footer -->
    <footer class="page-footer font-small bg-dark">

        <!-- Copyright -->
        <div class="footer-copyright text-center py-3" style="color: white;">© 2020 Copyright
        </div>
        <!-- Copyright -->

    </footer>
    <!-- Footer -->
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

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

        $(function() {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();

            var maxDate = year + '-' + month + '-' + day;
            $('#dateDOB').attr('max', maxDate);
        });

        jQuery(document).ready(function($) {
            var $form = $('#RegForm');
            $form.submit(function(e) {
                if($('#txtPassword').val() == $('#txtConfirm').val())
                {
                if($('#events input:checked').length > 0)
                {
                var $formdata = $('#RegForm').serialize();
                $.ajax({
                    type: "POST",
                    url: 'postdata.php',
                    data: $formdata,
                    cache: false,
                    success: window.open('paymentForm.php?total='+total.toFixed(2)*100)
                });
            } else {
                alert('Please select atleast one event');
                e.preventDefault();
            }
            } else {
                alert('Passwords do not match');
                e.preventDefault();   
            }
            });
        });
    </script>
</body>

</html>