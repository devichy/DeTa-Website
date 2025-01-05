<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Card Payment</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add custom styles here */
        body {
            background-color: #fff;
            color: #000;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
        }

        .card {
            background-color: #fff;
            /* White color */
            color: #000;
            /* Black color */
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            color: #fff;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .card-body {
            background-color: #fff;
            border-radius: 0 0 10px 10px;
        }

        .form-control:focus {
            box-shadow: none;
            border-color: #007bff;
            /* Blue color */
        }

        .btn-pay,
        .btn-cancel {
            background-color: #007bff;
            /* Blue color */
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
            background-color: #0056b3;
            /* Darker blue color */
        }

        .card-logo {
            max-width: 100%;
        }

        .form-group label {
            color: #000;
            /* Black color */
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <img src="image/card_payment_logo.png" alt="Card Logo" class="card-logo" style="height: 100px ; width: 450px">
            </div>
            <div class="card-body">
                <form action="sendotp.php" method="POST">
                    <div class="form-group">
                        <label for="cardNumber">Card Number</label>
                        <input type="text" class="form-control" id="cardNumber" name="cardNumber" placeholder="0000 0000 0000 0000" pattern="\d{4}\s?\d{4}\s?\d{4}\s?\d{4}" title="Please enter a valid card number" required>
                    </div>
                    <div class="form-group">
                        <label for="expiryDate">Expiry Date</label>
                        <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="MM/YY" pattern="(0[1-9]|1[0-2])\/([0-9]{2})" title="Please enter a valid expiry date in MM/YY format" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV</label>
                        <input type="password" class="form-control" id="cvv" name="cvv" placeholder="CVV" pattern="\d{3}" title="Please enter a valid 3-digit CVV" required>
                    </div>
                    <div class="row">
                        <div class="col">
                            <button type="button" class="btn btn-lg btn-block btn-cancel" onclick="cancelPayment()">CANCEL</button>
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-lg btn-block btn-pay">PAY NOW</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Function to check if all input fields are filled
        function checkFormValidity() {
            var cardNumber = document.getElementById('cardNumber').value;
            var expiryDate = document.getElementById('expiryDate').value;
            var cvv = document.getElementById('cvv').value;

            // Enable the "PAY NOW" button only if all fields are filled
            if (cardNumber !== '' && expiryDate !== '' && cvv !== '') {
                document.getElementById('payNowButton').disabled = false;
            } else {
                document.getElementById('payNowButton').disabled = true;
            }
        }

        // Add event listeners to input fields to check validity
        document.getElementById('cardNumber').addEventListener('input', checkFormValidity);
        document.getElementById('expiryDate').addEventListener('input', checkFormValidity);
        document.getElementById('cvv').addEventListener('input', checkFormValidity);

        function cancelPayment() {
            // Redirect to the previous page
            window.history.back();
        }
    </script>
</body>

</html>