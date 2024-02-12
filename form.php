
<?php 
$showAlert = false;
$showError = false;

if($_SERVER["REQUEST_METHOD"] == "POST"){
    include 'db_connect.php'; 

    // Retrieve form data
    $user_name = $_POST["user_name"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];
    $student_name = $_POST["Student_Name"];
    $age = $_POST["Age"];
    $gender = $_POST["gender"];
    $Phno_no= $_POST["Phno_no"];
    $email_id = $_POST["Mail_id"];
    $address = $_POST["address"];
    $hobbies = isset($_POST["hobbies"]) ? implode(", ", $_POST["hobbies"]) : '';

    // Check if user already exists
    $existsql = "SELECT * FROM `student_info` WHERE user_name = '$user_name'";
    $result = mysqli_query($conn, $existsql);
    $numExistRows = mysqli_num_rows($result);

    if($numExistRows > 0) {
        $showError = "User already exists.";
    } else {
        if($password == $cpassword) {

            // Insert user data into the database
            $sql = "INSERT INTO `student_info` (`sequence_no`, `user_name`, `password`, `cpassword`, `student_name`, `age`, `gender`, `Phno_no`, `email_id`, `address`, `hobbies`) VALUES (NULL, '$user_name', '$password', '$cpassword', '$student_name', '$age', '$gender', '$Phno_no', '$email_id', '$address', '$hobbies')";
            $result = mysqli_query($conn, $sql);
            
            if ($result){
                $showAlert = true;
            } else {
                $showError = "Failed to register. Please try again.";
            }
        } else {
            $showError = "Passwords do not match.";
        }
    }
}


echo $sql = "UPDATE student_info SET student_name ='Heni', cpassword = '156158',password='156158' WHERE user_name='priya'";
mysqli_query($conn, $sql);

echo $sql = "DELETE FROM student_info WHERE user_name ='priya'";
mysqli_query($conn, $sql);

?>



<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Registration</title>
</head>
<body>

    <?php
    if($showAlert){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Registration successful !!!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
    </div> ';
    }
    if($showError){
    echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> '. $showError.'
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true"></span>
        </button>
    </div> ';
    }
    ?>

    <div class="container">
        <br><br>
        <h1 class="text-center">Student Registration</h1>
        <form action="form.php" method="post" class="mx-auto col-md-6">
            <div class="form-group">
                <label for="user_name"><b>user_name</b></label>
                <input type="text" class="form-control" id="username" name="user_name" aria-describedby="emailHelp">

            </div>
            <div class="form-group">
                <label for="password"><b>Password</b></label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="form-group">
                <label for="cpassword"><b>Confirm Password</b></label>
                <input type="password" class="form-control" id="cpassword" name="cpassword">
                <small id="emailHelp" class="form-text text-muted">Type the same password as above</small>
            </div>
            <div class="form-group">
                <label for="username"><b>Student_Name</b></label>
                <input type="text" class="form-control" id="studentname" name="Student_Name" aria-describedby="emailHelp">
            </div>
            <div class="form-group">
                <label for="Age"><b>Age</b></label>
                <input type="text" class="form-control" id="age" name="Age">
            </div>
            <br>
            <label><b>Gender:</b></label>
        <input type="radio" id="male" name="gender" value="male" required>
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female" required>
        <label for="female">Female</label><br><br>

            <div class="form-group">
                <label for="phno_no"><b>Phone_No.</b></label>
                <input type="tel" id="phno_no" name="Phno_no" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
            </div>
            <br>
            <div class="form-group">
                <label for="mail"><b>Email_id</b></label>
                <input type="email" class="form-control" id="emailid" name="Mail_id">
            </div>
            <br>
            <div class="form-group">
                <label for="add."><b>Address</b></label>
                <textarea class="form-control" id="address" name="address" style="height: 100px;" required></textarea>
            </div>
            <br>
            <label><b>Hobbies:</b></label>
            <br>
            
        <input type="checkbox" id="hobby1" name="hobbies[]" value="reading">
        <label for="hobby1">Reading</label><br>
        <input type="checkbox" id="hobby2" name="hobbies[]" value="sports">
        <label for="hobby2">Sports</label><br>
        <input type="checkbox" id="hobby3" name="hobbies[]" value="music">
        <label for="hobby3">Music</label><br>
            
            <br>
            <button type="submit" class="btn btn-primary "><b>Register</b></button>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
