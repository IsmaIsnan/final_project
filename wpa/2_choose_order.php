<?php
// 2_choose_order.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ('4_dbconnect.php');

// Ensure the PatientID is passed from the previous form
if (isset($_POST['PatientID'])) {
    $patientID = $_POST['PatientID'];
} else {
    header("Location: 1a_checklogindb.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Choose Order</title>
    <style>
        body {
            background-image: url('bg.png'); /* Update with the actual path */
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .order-container {
            width: 300px;
            padding: 20px;
            background-color: #11113a;
            border-radius: 25px;
            text-align: center;
            color: white;
        }
        button {
            width: 100%;
            padding: 15px;
            margin: 10px 0;
            background-color: #5566b8;
            color: white;
            border: none;
            border-radius: 15px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #ced6ff;
        }
    </style>
</head>
<body>
<div class="order-container">
    <h2>Choose Order</h2>

    <form action="choose_mealtime.php" method="POST">
        <input type="hidden" name="PatientID" value="<?php echo htmlspecialchars($patientID, ENT_QUOTES, 'UTF-8'); ?>">
        <button type="submit">New Order</button>
    </form>

    <form action="past_order.php" method="POST">
        <input type="hidden" name="PatientID" value="<?php echo htmlspecialchars($patientID, ENT_QUOTES, 'UTF-8'); ?>">
        <button type="submit">Past Order</button>
    </form>
</div>
</body>
</html>
