<?php

session_start();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bKash Payment</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add custom styles here */
        body {
            background-color: #f5f5f5;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            color: #fff;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            background-color: #FF0083;
            /* Pink color */
            border-radius: 0 0 10px 10px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #FF0083;
            /* Pink color */
        }

        .btn-pay,
        .btn-cancel {
            background-color: #E60073;
            /* Pink color */
            border: none;
            color: #fff;
            /* White text color */
            font-size: 14px;
            /* Adjust font size */
            padding: 8px 20px;
            /* Adjust padding */
        }

        .btn-pay:hover,
        .btn-cancel:hover {
            background-color: #d90068;
            /* Darker pink color */
        }

        .bkash-logo {
            max-width: 100%;
        }

        .form-group label {
            color: #fff;
            /* White color */
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <img src="image/bkash_payment_logo.png" alt="bKash Logo" class="bkash-logo" style="height: 100px; width: 450px">
                <!-- <h3 class="mb-0">Payment Gateway</h3> -->
            </div>
            <div class="card-body">
                <form action="sendotp.php" method="POST">
                    <div class="form-group">
                        <label for="amount">Amount</label>
                        <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter amount" pattern="\d+(\.\d{1,2})?" title="Please enter a valid amount" value = "<?php echo $_SESSION['price']?>" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Mobile Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" placeholder="e.g 01XXXXXXXXX" pattern="(\+?88)?01[0-9]{9}" title="Please enter a valid 11-digit phone number" required>
                    </div>
                    <div class="form-group">
                        <label for="pin">PIN</label>
                        <input type="password" class="form-control" id="pin" name="pin" placeholder="e.g 1234" pattern="\d{4}" title="Please enter a valid 4-digit PIN" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-lg btn-block btn-cancel" onclick="cancelPayment()">CANCEL</button>
                        </div>
                        

                        <div class="col">
                            <button type="submit" class="btn btn-lg btn-block btn-pay">PROCEED </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to check if all input fields are filled
        function checkFormValidity() {
            var amount = document.getElementById('amount').value;
            var phone = document.getElementById('phone').value;
            var pin = document.getElementById('pin').value;

            // Enable the "PROCEED" button only if all fields are filled
            if (amount !== '' && phone !== '' && pin !== '') {
                document.getElementById('proceedButton').disabled = false;
            } else {
                document.getElementById('proceedButton').disabled = true;
            }
        }

        // Add event listeners to input fields to check validity
        document.getElementById('amount').addEventListener('input', checkFormValidity);
        document.getElementById('phone').addEventListener('input', checkFormValidity);
        document.getElementById('pin').addEventListener('input', checkFormValidity);

        function cancelPayment() {
            // Redirect to the previous page
            window.history.back();
        }
    </script>
</body>

</html>