<?php
@session_start();
// Stripe API configuration  
define('STRIPE_API_KEY', 'sk_test_44NNINOVFofUiCP8A9SCginx00MTXhrXIq');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_hULczefdKnXOcqZqEyjcukf2007fUTdyyS');
$total = explode('?total=', $_SERVER['REQUEST_URI']);
$url = 'stripePayment.php?total='. $total[1];
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="static/css/registration.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


    <title>Payment</title>
    <style>
        body {
            margin-top: 15px!important;
            margin-left: 35px!important;
        }
    </style>
</head>

<body>
    <form style="width: 800px" class="dataForm" action=<?php print($url) ?> method="POST" id="paymentFrm">
        <div class="register-form">
            <div class="note">
                <h3>Charge <?php echo 'Rs.' . $total[1]/100; ?> with Stripe</h3>
            </div>
            <div class="form-content">
                <!-- Display errors returned by createToken -->
                <div class="payment-status"></div>

                <!-- Payment form -->
                <div class="form-group">
                    <label>NAME</label>
                    <input type="text" class="form-control" onkeypress="return !isNumberKey(event)" name="cc-name" id="cc-name" placeholder="Enter Name" value="<?php print $_SESSION['name'] ?>" required="" autofocus="" readonly>
                </div>
                <div class="form-group">
                    <label>ADDRESS</label>
                    <textarea type="text" class="form-control" name="address" id="address" placeholder="Enter Address" required="" autofocus=""></textarea>
                </div>
                <div class="form-group">
                    <label>EMAIL</label>
                    <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" value="<?php print $_SESSION['email'] ?>" required="" readonly>
                </div>
                <div class="form-group">
                    <label>CARD NUMBER</label>
                    <input type="text" onkeypress="return isNumberKey(event)" class="form-control" name="cc-number" id="cc-number" maxlength="16" minlength="16" placeholder="1234123412341234" autocomplete="off" required="">
                </div>
                <div class="row">
                    <div class="left">
                        <div class="form-group">
                            <label>EXPIRY DATE</label>
                            <div class="col-sm-6">
                                <input type="text" maxlength="2" class="form-control" name="card_exp_month" id="card_exp_month" placeholder="MM" required="">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" maxlength="4" name="card_exp_year" id="card_exp_year" placeholder="YYYY" required="">
                            </div>
                        </div>
                    </div>
                    <div class="right">
                        <div class="form-group">
                            <label>CVC CODE</label>
                            <input type="text" maxlength="3" class="form-control" name="card_cvc" id="card_cvc" placeholder="CVC" autocomplete="off" required="">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success" id="payBtn">Submit Payment</button>
            </div>
        </div>
    </form>

    <!-- Stripe JavaScript library -->
    <script src="https://js.stripe.com/v2/"></script>
    <!-- jQuery is used only for this example; it isn't required to use Stripe -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
        function isNumberKey(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;

            return true;
        }

        // Set your publishable key
        Stripe.setPublishableKey('<?php echo STRIPE_PUBLISHABLE_KEY; ?>');

        // Callback to handle the response from stripe
        function stripeResponseHandler(status, response) {
            if (response.error) {
                // Enable the submit button
                $('#payBtn').removeAttr("disabled");
                // Display the errors on the form
                $(".payment-status").html('<p>' + response.error.message + '</p>');
            } else {
                var form$ = $("#paymentFrm");
                // Get token id
                var token = response.id;
                // Insert the token into the form
                form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
                // Submit form to the server
                form$.get(0).submit();
            }
        }

        $(document).ready(function() {
            // On form submit
            $("#paymentFrm").submit(function() {
                // Disable the submit button to prevent repeated clicks
                $('#payBtn').attr("disabled", "disabled");

                // Create single-use token to charge the user
                Stripe.createToken({
                    number: $('#cc-number').val(),
                    exp_month: $('#card_exp_month').val(),
                    exp_year: $('#card_exp_year').val(),
                    cvc: $('#card_cvc').val()
                }, stripeResponseHandler);

                // Submit from callback
                return false;
            });
        });
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

</body>

</html>