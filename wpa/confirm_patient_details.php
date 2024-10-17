<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ('4_dbconnect.php');

if (isset($_GET['PatientID'])) {
    $patientID = $_GET['PatientID'];
    // Prepare statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM patient WHERE PatientID=?");
    $stmt->bind_param("s", $patientID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $patient = $result->fetch_assoc();
    } else {
        header("Location: 1a_checklogindb.php");
        exit();
    }
} else {
    header("Location: 1a_checklogindb.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Patient Details</title>
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
        .confirmation-container {
            width: 400px;
            padding: 30px;
            background-color: #11113a;
            border-radius: 50px;
            text-align: center;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .patient-details {
            width: 60%;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 50px;
            border: 5px solid #5566b8;
            text-align: center;
            color: black;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .patient-details p {
            margin: 10px 0;
        }
        input[type="submit"] {
            margin-top: 30px;
            padding: 10px 20px;
            border-radius: 25px;
            background-color: #fff;
            color: #333;
            border: 1px solid #11113a;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #ced6ff;
        }
    </style>
</head>
<body>
<div class="confirmation-container">
        <h2>Confirm Your Details</h2>
        <div class="patient-details">
            <p><strong>Name:</strong> <?php echo htmlspecialchars($patient['Name'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($patient['Age'], ENT_QUOTES, 'UTF-8'); ?></p>
            <p><strong>Room Number:</strong> <?php echo htmlspecialchars($patient['RoomNumber'], ENT_QUOTES, 'UTF-8'); ?></p>
        </div>

        <form action="2_choose_order.php" method="POST">
            <input type="hidden" name="PatientID" value="<?php echo htmlspecialchars($patient['PatientID'], ENT_QUOTES, 'UTF-8'); ?>">
            <input type="submit" value="Confirm">
        </form>
    </div>
</body>
</html>
