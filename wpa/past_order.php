<?php
// past_order.php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include ('4_dbconnect.php');

if (isset($_POST['PatientID'])) {
    $patientID = $_POST['PatientID'];

    // Fetch past orders from the database, including meal ID and meal name, ordered by Date
    $stmt = $conn->prepare("SELECT tblorder.OrderID, tblorder.MealID, tblorder.Date, tblorder.Status, meal.MealName
                            FROM tblorder
                            JOIN meal ON tblorder.MealID = meal.MealID
                            WHERE tblorder.PatientID = ?
                            ORDER BY tblorder.Date, tblorder.OrderID");
    $stmt->bind_param("s", $patientID);
    $stmt->execute();
    $result = $stmt->get_result();

    $noOrderMessage = '';
    if ($result->num_rows == 0) {
        $noOrderMessage = "<p>No past orders found for PatientID: " . htmlspecialchars($patientID, ENT_QUOTES, 'UTF-8') . "</p>";
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
    <title>Past Orders</title>
    <style>
        body {
            background-image: url('bg.png');
            background-size: cover;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            width: 600px;
            padding: 30px;
            background-color: #11113a;
            border-radius: 50px;
            text-align: center;
            color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        .order-group {
            width: 100%;
            background-color: #ffffff;
            color: black;
            border-radius: 50px;
            border: 5px solid #5566b8;
            padding: 20px;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }
        table, th, td {
            border: 1px solid #11113a;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #5566b8;
            color: white;
        }
        .buttons-container {
            display: flex;
            justify-content: space-around;
        }
        button {
            padding: 10px 25px;
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
<div class="container">
    <h2>Past Orders for Patient ID: <?php echo htmlspecialchars($patientID, ENT_QUOTES, 'UTF-8'); ?></h2>

    <?php
    // Display the message inside the container if no past orders were found
    if (!empty($noOrderMessage)) {
        echo $noOrderMessage;
    }

    if ($result->num_rows > 0) {
        $currentDate = null;
        while ($row = $result->fetch_assoc()) {
            // Check if it's a new Date to group orders by
            if ($currentDate !== $row['Date']) {
                if ($currentDate !== null) {
                    echo '</table></div>'; // Close the previous group
                }
                $currentDate = $row['Date'];
                echo "<div class='order-group'><h3>Order Date: {$currentDate}</h3>";
                echo '<table><tr><th>Meal ID</th><th>Meal Name</th><th>Order ID</th><th>Status</th></tr>';
            }

            // Display each order's details, including MealID and MealName
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['MealID'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>" . htmlspecialchars($row['MealName'], ENT_QUOTES, 'UTF-8') . "</td>";
            echo "<td>{$row['OrderID']}</td>";
            echo "<td>{$row['Status']}</td>";
            echo "</tr>";
        }
        echo '</table></div>'; // Close the last group
    }
    ?>

    <!-- Buttons for Back and Exit -->
    <div class="buttons-container">
        <!-- Back button redirects to the order selection page -->
        <form action="2_choose_order.php" method="POST">
            <input type="hidden" name="PatientID" value="<?php echo htmlspecialchars($patientID, ENT_QUOTES, 'UTF-8'); ?>">
            <button type="submit">Back</button>
        </form>

        <!-- Exit button redirects to the landing page -->
        <form action="1a_checklogindb.php" method="POST">
            <button type="submit">Exit</button>
        </form>
    </div>

</div>
</body>
</html>
