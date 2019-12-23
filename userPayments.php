<?php
@session_start();
include("dbconnect.php");
$sqlpayment = 'SELECT * FROM EM_Payments WHERE 1 AND fkRegID = ' . $_SESSION['id'];
$rslpayment = $db_conn->query($sqlpayment);
?>
<div class="content-wrapper">
    <div class="user-dashboard ml-3">
        <h3>Payment History :</h3>
        <div class='table-responsive'>
            <table id='details' class='table'>
                <thead style='display:table-header-group'>
                    <tr>
                        <th scope='col'><b>Transaction Date</b></th>
                        <th scope='col'><b>Transaction ID</b></th>
                        <th scope='col'><b>Transaction Amount</b></th>
                        <th scope='col'><b>Payment Status</b></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                while ($roweve = $rslpayment->fetch_assoc()) 
                {
                    $date = $roweve['Date'];
                    $txnNum = $roweve['txn_id'];
                    $paidamount = $roweve['paid_amount'];
                    $address = $roweve['billing_address'];
                    $status = $roweve['payment_status'];
                    print("
                    <tr>
                    <td><p>" . $date . "</p></td>
                    <td><p>" . $txnNum . "</p></td>
                    <td><p>" . $paidamount . "</p></td>
                    <td><p>" . $status . "</p></td>
                    </tr>
                    ");
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</div>