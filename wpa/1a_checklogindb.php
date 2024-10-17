<?php
session_start();
include ('4_dbconnect.php'); // Include your database connection file

$errorMessage = "";

if (isset($_POST['Submit'])) {
    $_userid = $_POST['txtUserName'];
    $_pswd = $_POST['txtPassword'];
    
    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT PatientID FROM patient WHERE PatientID=? AND password=?");
    $stmt->bind_param("ss", $_userid, $_pswd);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
        $_SESSION['PatientID'] = $patient['PatientID']; // Set PatientID in session
        $_SESSION['cart'] = []; // Clear previous cart items for the new patient

        // Clear previous cart entries in the database if necessary
        $clearCartStmt = $conn->prepare("DELETE FROM cart WHERE PatientID=?");
        $clearCartStmt->bind_param("s", $_SESSION['PatientID']);
        $clearCartStmt->execute();

        // Redirect to the confirmation page
        header("Location: confirm_patient_details.php?PatientID=" . $_SESSION['PatientID']);
        exit();
    } else {
        $errorMessage = "Unauthorized Login. Please check your Patient ID and password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <style>
        body {
            background-image: url('MealRx.png'); 
            background-size: cover;
            font-family: Arial, sans-serif;
            color: white;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: flex-start;
            align-items: flex-end;
        }

        .login-container {
            width: 350px; 
            padding: 40px;
            background-color: transparent; 
            border: none; 
            text-align: center;
            margin: 40px;
        }

        .input-container {
            position: relative;
            margin: 10px 0;
        }

        .input-container i {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #11113a;
            font-size: 20px;
        }

        input[type="text"], input[type="password"] {
            width: 200%;
            padding: 15px 15px 15px 40px; 
            border: 3px solid #11113a;
            background-color: #5566b8;
            border-radius: 20px;
            box-sizing: border-box;
            font-size: 35px;
            color: white;
        }

        input[type="text"]::placeholder, input[type="password"]::placeholder {
            color: white; 
            opacity: 1; 
        }

        input[type="submit"] {
            width: 100%;
            padding: 15px;
            background-color: #fff;
            color: #333;
            border: 1px solid #11113a;
            cursor: pointer;
            font-size: 16px;
            border-radius: 20px;
        }

        input[type="submit"]:hover {
            background-color: #5566b8;
        }

        .error-message {
            color: red; /* Color for error messages */
            margin-top: 10px; /* Space above the error message */
        }
    </style>
    <script>
        function showError(message) {
            alert(message);
        }
    </script>
</head>
<body>
<div class="login-container">
        <form action="" method="POST">
            <div class="input-container">
                <i class="fas fa-user"></i> 
                <input type="text" name="txtUserName" placeholder="Enter Patient ID" required>
            </div>
            <div class="input-container">
                <i class="fas fa-lock"></i> 
                <input type="password" name="txtPassword" placeholder="Enter Password" required>
            </div>
            <input type="submit" name="Submit" value="Login">
        </form>
        <?php
        if ($errorMessage) {
            echo "<script>showError('$errorMessage');</script>";
        }
        ?>
    </div>
    
</body>
</html>
