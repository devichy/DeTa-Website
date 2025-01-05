<?php

if (isset($_POST['addBtn'])) {
    include 'config.php';

    $movie_name = $_POST['moviename'];
    $screen = $_POST['screen'];
    $price = $_POST['price'];

    $imageLoc = $_FILES['picture']['tmp_name'];
    $imageName = $_FILES['picture']['name'];
    $image_dest = "image/". $imageName;
    move_uploaded_file($imageLoc, $image_dest);



    $insert_query = "INSERT INTO `movies`(`name`, `screen`, `price`, `photo`) VALUES
     ('$movie_name','$screen','$price','$image_dest')";

    if (!mysqli_query($conn, $insert_query)) {
        die("Not Inserted!!");
    } else {
        echo "<script>alert('Your movie added Successfully!')</script>";
        echo "<script>location.href='ticket.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OPT Verification</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Custom CSS -->
    <style>
        /* Add custom styles here */
        .container {
            max-width: 500px;
            margin: 50px auto;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0px 0px 50px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #ffffff;
            /* White color */
            color: #333;
            /* Dark gray text color */
            text-align: center;

        }


        .btn-add:hover {
            background-color: #555;
            /* Slightly darker gray on hover */
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="card">
            <div class="card-header">
                <img src="image/addmovie.jpg" alt="movie Logo" style="height: 150px ; width: 450px">

            </div>
            <div class="card-body">
                <form action="addmovie.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Movie Name">Movie Name: </label>
                        <input type="text" class="form-control" name="moviename" placeholder="Enter movie name">
                    </div>

                    <div class="form-group">
                        <label for="screen">Select Screen:</label>
                        <select class="form-control" name="screen" id="screen">
                            <option value="#">Select Screen...</option>
                            <option value="Platinum">Platinum</option>
                            <option value="Gold">Gold</option>
                            <option value="Silver">Silver</option>
                            <option value="Bronze">Bronze</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Price">Price: </label>
                        <input type="digit" class="form-control" name="price" placeholder="Enter price">
                    </div>

                    <div class="form-group">
                        <label for="picture">Upload Thumbnail:</label>
                        <input type="file" class="form-control-file" id="picture" name="picture" required>
                    </div>

                    <button type="submit" name="addBtn" class="btn btn-lg btn-block btn-add">Add Movie</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>