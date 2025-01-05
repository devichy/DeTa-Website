<?php
session_start();
include 'config.php';

if (isset($_GET['movie']) && isset($_GET['price'])) {
  $_SESSION['moviename'] = $_GET['movie'];
  $_SESSION['price'] = $_GET['price'];
}

if (isset($_POST['bookTickets'])) {
  $_SESSION['fullName'] = $_POST['fullName'];
  $_SESSION['email'] = $_POST['email'];
  $_SESSION['phoneNumber'] = $_POST['phoneNumber'];
  $_SESSION['theaterSelect'] = $_POST['theaterSelect'];
  $_SESSION['dateSelect'] = $_POST['dateSelect'];
  $_SESSION['timeSelect'] = $_POST['timeSelect'];
  $_SESSION['seatSelect'] = $_POST['seatSelect'];
  $seat = implode(",", $_SESSION['seatSelect']);

  $dupe_seat = mysqli_query($conn, "SELECT * FROM `ticket_info` WHERE `Movie_Title` = '{$_SESSION['moviename']}' AND Theatre = '{$_SESSION['theaterSelect']}' AND time_slot = '{$_SESSION['timeSelect']}' AND Date = '{$_SESSION['dateSelect']}' AND Seats = '$seat'");


  if (mysqli_num_rows($dupe_seat) > 0) { //Duplicate Seat check from db
    echo "<script>alert('This seat is already booked. Please select another seat..!!')</script>";
    echo "<script>location.href='buyticket.php</script>";
  } else {
    // Add JavaScript to open the modal after setting session variables
    echo '<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>';
    echo '<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>';
    echo '<script>$(document).ready(function() { showBookingModal(); });</script>';
  }
}

?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Movie Ticket Booking</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css" integrity="sha384-b6lVK+yci+bfDmaY1u0zE8YYJt0TZxLEAFyYSLHId4xoVvsrQu3INevFKo+Xir8e" crossorigin="anonymous">
  <!-- Fontawesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css"> <!--If it will remove there will have a changes  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&family=Rubik+Scribble&display=swap" rel="stylesheet">

  <style>
    .navbar-brand {
      display: block;
      width: 100%;
      font-size: 2.5rem;
      font-family: 'Roboto', cursive;
      text-align: center;

    }

    form#bookingForm {
      border: 2px solid rgba(0, 0, 0, 0.5);
      border-radius: 10px;
      padding: 20px;
      background-color: rgba(255, 255, 255, 0.8);
      animation: inputZoom 0.3s ease-in-out;

    }


    body {
      background-image: url('deta_B.jpg');
      background-size: cover;
      background-repeat: no-repeat;
      height: auto;
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;

    }

    .card-body img {
      max-width: 100%;
      max-height: 100%;
    }


    label {
      font-weight: bold;
      color: #ffffff;
      font-size: 1.2rem;
    }

    /* Add more styles as needed */

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-50px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }


    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(50px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes inputZoom {
      from {
        transform: scale(0.5);
      }

      to {
        transform: scale(1);
      }
    }


    li {
      list-style-type: none;
      list-style-position: outside;
      padding: 10px;
      margin-left: 100px;
    }

    input[type="checkbox"] {
      position: absolute;
      left: -9999%;
      width: 50px;
      height: 50px;
    }


    input[type="checkbox"]+label {
      display: inline-block;
      padding: 10px;
      cursor: pointer;
      border: 1px solid transparent;
      color: black;
      background-color: white;
      margin: 5px;
      border-radius: 10px;
      width: 50px;
      height: 50px;

    }

    input[type="checkbox"]:checked+label {
      border: 1px solid #333;
      background-color: green;
      color: white;
      transform: scale(1.5);
    }

    /* Hover effect for seat labels */
    input[type="checkbox"]+label:hover {
      background-color: green;
    }

    .row.justify-content-center {
      margin-right: 25px;
      /* Adjust this value as needed */
    }
  </style>

</head>

<body>
  <header>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <a class="navbar-brand" href="home.php">
        <i class="fa-solid fa-house me-5"></i> Movie Ticket Booking
      </a>
      <!-- Include navigation links here -->
      <!-- You can have links to Movies, Booking, etc. -->
    </nav>
  </header>




  <main>
    <section class="container mt-4 text-center">
      <h2 class="mb-4 heading"><?php echo "<h1 style='color: #67a7ff;'>Movie Title: " . ($_SESSION['moviename']) . "</h1>"; ?></h2>


      <form action="buyticket.php" method="post" id="bookingForm" class="form-group">
        <div class="form-group">
          <label for="fullName" class="text-muted">Full Name:</label>
          <input type="text" class="form-control" id="fullName" name="fullName" placeholder="Enter your full name" pattern="[A-Za-z\s]+" title="Please enter a valid full name (letters and spaces only)" required>
        </div>
        <div class="form-group">
          <label for="email" class="text-muted">Email:</label>
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}" title="Please enter a valid email address" required>
        </div>
        <div class="form-group">
          <label for="phoneNumber" class="text-muted">Phone Number:</label>
          <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Enter your phone number" pattern="[0-9]{11}" title="Please enter a valid 10-digit phone number" required>
        </div>

        <div class="form-group">
          <label for="theaterSelect" class="text-muted">Select Theater:</label>
          <select class="form-control" name="theaterSelect" id="theaterSelect" required>
            <option value="#">Select theater...</option>
            <option value="STAR Cineplex (Multiplex Cinema)">STAR Cineplex (Multiplex Cinema)</option>
            <option value="Balaka Cinema Hall"> Balaka Cinema Hall</option>
            <option value="Blockbuster Cinemas">Blockbuster Cinemas</option>
            <option value="Modhumita Cinema Hall">Modhumita Cinema Hall</option>
            <option value="Grand Sylhet Cineplex">Grand Sylhet Cineplex</option>
            <option value="Shyamoli Cinema Hall">Shyamoli Cinema Hall</option>
            <option value="Nandita Cinema Hall">Nandita Cinema Hall</option>
          </select>
        </div>


        <div class="form-group">
          <label for="dateSelect" class="text-muted">Select Date:</label>
          <input type="date" class="form-control" name="dateSelect" id="dateSelect" min="<?php echo date('Y-m-d'); ?>" required>
        </div>

        <div class="form-group">
          <label for="timeSelect" class="text-muted">Select Time Slot:</label>
          <select class="form-control" name="timeSelect" id="timeSelect" required>
            <option value="#">Select time slot...</option>
            <option value="8:00 AM">8:00 AM</option>
            <option value="11:30 AM">11:30 AM</option>
            <option value="2:30 PM">2:30 PM</option>
            <option value="7:00 PM">7:00 PM</option>
            <option value="10:00 PM">10:00 PM</option>


          </select>
        </div>

        <label for="seatSelect" class="text-muted">Select Seat(s):</label>
        <div class="form-group seats-checkbox">
          <!-- Row A -->
          <div class="row justify-content-center">
            <?php for ($i = 1; $i <= 10; $i++) : ?>
              <div class="col-1 mb-2">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="seatSelect[]" id="check_<?php echo $i; ?>" value="A<?php echo $i; ?>">
                  <label class="form-check-label" for="check_<?php echo $i; ?>">A<?php echo $i; ?></label>
                </div>
              </div>
            <?php endfor; ?>
          </div>

          <!-- Row B -->
          <div class="row justify-content-center">
            <?php for ($i = 1; $i <= 10; $i++) : ?>
              <div class="col-1 mb-2">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="seatSelect[]" id="check_B<?php echo $i; ?>" value="B<?php echo $i; ?>">
                  <label class="form-check-label" for="check_B<?php echo $i; ?>">B<?php echo $i; ?></label>
                </div>
              </div>
            <?php endfor; ?>
          </div>



          <!-- Row C -->
          <div class="row justify-content-center">
            <?php for ($i = 1; $i <= 10; $i++) : ?>
              <div class="col-1 mb-2">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="seatSelect[]" id="check_C<?php echo $i; ?>" value="C<?php echo $i; ?>">
                  <label class="form-check-label" for="check_C<?php echo $i; ?>">C<?php echo $i; ?></label>
                </div>
              </div>
            <?php endfor; ?>
          </div>

          <!-- Row D -->
          <div class="row justify-content-center">
            <?php for ($i = 1; $i <= 10; $i++) : ?>
              <div class="col-1 mb-2">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="seatSelect[]" id="check_D<?php echo $i; ?>" value="D<?php echo $i; ?>">
                  <label class="form-check-label" for="check_D<?php echo $i; ?>">D<?php echo $i; ?></label>
                </div>
              </div>
            <?php endfor; ?>
          </div>

          <!-- Row E -->
          <div class="row justify-content-center">
            <?php for ($i = 1; $i <= 10; $i++) : ?>
              <div class="col-1 mb-2">
                <div class="form-check">
                  <input type="checkbox" class="form-check-input" name="seatSelect[]" id="check_E<?php echo $i; ?>" value="E<?php echo $i; ?>">
                  <label class="form-check-label" for="check_E<?php echo $i; ?>">E<?php echo $i; ?></label>
                </div>
              </div>
            <?php endfor; ?>
          </div>


          <div class="form-group">
            <label for="price" class="text-muted">Total Price:</label>
            <input type="digit" class="form-control" name="price" id="price" value="৳ <?php echo $_SESSION['price']; ?>">

          </div>

          <!-- Modal for pop-up window -->
          <div class="modal fade" id="bookingModal">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="bookingModalLabel">Booking Confirmation</h5>
                  <button type="button" class="btn-close" id="closeModalButton1"></button>
                </div>
                <div class="modal-body">
                  <p>Please select your payment method !!</p>
                  <div class="row">
                    <div class="col-6 mb-3">
                      <div class="card border-primary">
                        <div class="card-body text-center">
                          <label class="form-check-label d-block" for="bkash" style="font-size: 14px; margin-left: 20px;">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="bkash" value="bkash">
                            <img src="image/bkash.png" alt="BKash" class="img-fluid payment-image" style="max-width: 60px; max-height: 60px;">
                            <span style="color: black;">bKash</span>
                          </label>
                        </div>
                      </div>
                    </div>
                    <div class="col-6 mb-3">
                      <div class="card border-primary">
                        <div class="card-body text-center">
                          <label class="form-check-label d-block" for="card" style="font-size: 14px; margin-left: 60px;">
                            <input class="form-check-input" type="radio" name="paymentMethod" id="card" value="card">
                            <img src="image/card.png" alt="Debit/Credit Card" class="img-fluid payment-image" style="max-width: 60px; max-height: 60px;">
                            <span style="color: black; text-align: right;">Debit/Credit Card</span>
                          </label>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" id="closeModalButton">Cancel</button>
                  <button type="button" class="btn btn-primary" id="confirmPaymentButton">Confirm Payment</button>
                </div>
              </div>
            </div>
          </div>
          <input type="hidden" name="selectedSeats" id="selectedSeats" value="">
          <button type="submit" class="btn btn-primary" id="bookTicketsButton" name="bookTickets">Book Tickets</button>
      </form>
    </section>
  </main>


  <script>
    // Initialize total price to 0
    document.addEventListener('DOMContentLoaded', function() {
      var totalPriceField = document.getElementById('price');
      totalPriceField.value = '৳ 0';
    });
    // Function to update total price and handle seat selection limit
    function updateTotalPrice() {
      var checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
      var totalPriceField = document.getElementById('price');
      var totalPrice = checkboxes.length * <?php echo $_SESSION['price']; ?>;

      // Limit selection to three seats
      if (checkboxes.length > 3) {
        alert('You can select only three seats.');
        this.checked = false; // Uncheck the checkbox
        return;
      }

      totalPriceField.value = '৳ ' + totalPrice;
    }

    // Add event listeners to checkboxes
    var seatCheckboxes = document.querySelectorAll('input[type="checkbox"]');
    seatCheckboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', updateTotalPrice);
    });

    // Show booking modal function remains unchanged
    function showBookingModal() {
      $("#bookingModal").modal("show");
    }

    // Other event listeners remain unchanged
    document.getElementById('closeModalButton').addEventListener('click', function(event) {
      $('#bookingModal').modal('hide');
    });

    document.getElementById('closeModalButton1').addEventListener('click', function(event) {
      $('#bookingModal').modal('hide');
    });

    document.getElementById('confirmPaymentButton').addEventListener('click', function(event) {
      var paymentMethod = document.querySelector('input[name="paymentMethod"]:checked').value;
      if (paymentMethod === 'bkash') {
        window.location.href = 'bkash.php';
      } else if (paymentMethod === 'card') {
        window.location.href = 'card.php';
      }
    });
  </script>




</body>

</html>