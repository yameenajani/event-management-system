<?php
@session_start();
// Include configuration file  
include("dbconnect.php");

define('STRIPE_API_KEY', 'sk_test_44NNINOVFofUiCP8A9SCginx00MTXhrXIq');
define('STRIPE_PUBLISHABLE_KEY', 'pk_test_hULczefdKnXOcqZqEyjcukf2007fUTdyyS');
$itemPrice = explode('?total=', $_SERVER['REQUEST_URI'])[1];
$currency = "inr";

$payment_id = $statusMsg = '';
$ordStatus = 'error';

// Check whether stripe token is not empty 
if (!empty($_POST['stripeToken'])) {

    // Retrieve stripe token, card and user info from the submitted form data 
    $token  = $_POST['stripeToken'];
    $name = $_POST['cc-name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $card_number = $_POST['cc-number'];
    $card_exp_month = $_POST['card_exp_month'];
    $card_exp_year = $_POST['card_exp_year'];
    $card_cvc = $_POST['card_cvc'];

    // Include Stripe PHP library 
    require_once 'stripe/stripe-php/init.php';

    // Set API key 
    \Stripe\Stripe::setApiKey(STRIPE_API_KEY);

    // Add customer to stripe 
    $customer = \Stripe\Customer::create(array(
        'email' => $email,
        'source'  => $token
    ));

    // Unique order ID 
    $orderID = strtoupper(str_replace('.', '', uniqid('', true)));

    // Charge a credit or a debit card 
    $charge = \Stripe\Charge::create(array(
        'customer' => $customer->id,
        'amount'   => $itemPrice,
        'currency' => $currency,
        'description' => "Event",
        'metadata' => array(
            'order_id' => $orderID
        )
    ));

    // Retrieve charge details 
    $chargeJson = $charge->jsonSerialize();

    // Check whether the charge is successful 
    if ($chargeJson['amount_refunded'] == 0 && empty($chargeJson['failure_code']) && $chargeJson['paid'] == 1 && $chargeJson['captured'] == 1) {
        // Order details  
        $transactionID = $chargeJson['balance_transaction'];
        $paidAmount = $chargeJson['amount'] / 100;
        $paidCurrency = $chargeJson['currency'];
        $payment_status = $chargeJson['status'];

        // Insert tansaction data into the database 
            $sql = "INSERT INTO `EM_Payments`(`fkRegID`, `txn_id`, `paid_amount`, `payment_status`, `billing_address`) VALUES (";
            $sql .= "'" . $_SESSION['id'] . "','" . $transactionID . "','" . $paidAmount . "','" . $payment_status . "','" . $address . "')";    
            $update = $db_conn->query($sql);
            $payment_id = $_SESSION['id'];
    
        // If the order is successful 
        if ($payment_status == 'succeeded') {
            $ordStatus = 'success';
            $statusMsg = 'Your Payment has been Successful!';
        } else {
            $statusMsg = "Your Payment has Failed!";
        }
    } else {
        //print '<pre>';print_r($chargeJson); 
        $statusMsg = "Transaction has been failed!";
    }
} else {
    $statusMsg = "Error on form submission.";
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="static/css/registration.css">

    <title>Thank You!</title>
</head>

<body class="jumbotron">
    <div class="text-center">
        <h1 class="display-3">Thank You!</h1>
        <div class="container">
        <div class="status">
        <?php if (!empty($payment_id)) { ?>
            <h1 class="<?php echo $ordStatus; ?>"><?php echo $statusMsg; ?></h1>

            <h4>Payment Information</h4>
            <p><b>Reference Number:</b> <?php echo $payment_id; ?></p>
            <p><b>Transaction ID:</b> <?php echo $transactionID; ?></p>
            <p><b>Paid Amount:</b> <?php echo $paidAmount; ?></p>
            <p><b>Billing Address:</b> <?php echo $address; ?></p>
            <p><b>Payment Status:</b> <?php echo $payment_status; ?>
                <br>
                <p onload="setTimeout();" onpageshow="if (event.persisted) setTimeout();" onunload="">Please wait. You are being redirected......</p>
                <p class="lead"><strong>Please check your email</strong> for confirmation mail.</p>
            </p>
        <?php } else { ?>
            <h1 class="error">Your Payment has Failed</h1>
            <input type="button" class="btn btn-primary" onclick="window.history.go(-1); return false;" value="Back to Payment Page">
        <?php } ?>
    </div>
</div>
        <hr>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script>
    window.history.forward();
    setTimeout(function() {
        window.history.forward();
        window.location.href = 'index1.php';
    }, 10000);
    </script>
</body>
</html>
<?php
include("pdfreceipt.php");
include("mailreceipt.php");
?>