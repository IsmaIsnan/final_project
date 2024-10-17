<?php
session_start();
include '4_dbconnect.php'; // Ensure you have your database connection included here

$patientID = $_SESSION['PatientID'];

// Initialize cart result variable
$cartResult = null;

// Handle order submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_order'])) {
    // Get meal details from the cart
    $cartQuery = $conn->prepare("
        SELECT c.MealID, c.MealName, 
               CASE 
                   WHEN c.MealID LIKE 'B%' THEN 'Breakfast'
                   WHEN c.MealID LIKE 'L%' THEN 'Lunch'
                   WHEN c.MealID LIKE 'D%' THEN 'Dinner'
                   ELSE 'Other'
               END AS MealCategory,
               c.Quantity
        FROM cart c 
        WHERE c.PatientID = ?
    ");
    $cartQuery->bind_param("s", $patientID);
    $cartQuery->execute();
    $cartResult = $cartQuery->get_result(); // This will now set $cartResult

    // Check if the cart query was successful and has results
    if ($cartResult && $cartResult->num_rows > 0) {
        // Prepare to insert orders
        while ($row = $cartResult->fetch_assoc()) {
            $mealID = $row['MealID'];
            $mealName = $row['MealName'];
            $mealCategory = $row['MealCategory'];
            $quantity = $row['Quantity'];
            
            // Generate a unique OrderID for each meal
            $orderID = uniqid("order_"); // Generate a unique OrderID

            // Insert each meal into the tblorder with the generated OrderID
            $insertOrderQuery = $conn->prepare("INSERT INTO tblorder (OrderID, MealID, MealName, PatientID, OrderStatus, Quantity) VALUES (?, ?, ?, ?, ?, ?)");
            $orderStatus = "Pending"; // Initial status
            $insertOrderQuery->bind_param("sssssi", $orderID, $mealID, $mealName, $patientID, $orderStatus, $quantity);
            $insertOrderQuery->execute();
        }

        // Optionally clear the cart after successful order placement
        $clearCartQuery = $conn->prepare("DELETE FROM cart WHERE PatientID = ?");
        $clearCartQuery->bind_param("s", $patientID);
        $clearCartQuery->execute();

        // Redirect or display a success message
        header("Location: order_confirmation.php");
        exit();
    } else {
        // Handle case where the cart is empty
        echo "<p>Your cart is empty. Please add meals to your cart before placing an order.</p>";
    }
}

// After handling form submission, fetch the cart items again for display
$cartQuery = $conn->prepare("
    SELECT c.MealID, c.MealName, 
           CASE 
               WHEN c.MealID LIKE 'B%' THEN 'Breakfast'
               WHEN c.MealID LIKE 'L%' THEN 'Lunch'
               WHEN c.MealID LIKE 'D%' THEN 'Dinner'
               ELSE 'Other'
           END AS MealCategory
    FROM cart c 
    WHERE c.PatientID = ?
");
$cartQuery->bind_param("s", $patientID);
$cartQuery->execute();
$cartResult = $cartQuery->get_result(); // This will set $cartResult for display

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-image: url('bg.png'); 
            background-size: cover;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .order-container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .btn-exit {
            background-color: #fff;
            color: #333;
            border: 1px solid #11113a;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-exit:hover {
            background-color: #ced6ff;
        }
        .btn-cancel {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-cancel:hover {
            background-color: darkred;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border: 1px solid #11113a;
        }
        th, td {
            border: 1px solid #11113a;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #5566b8;
            color: white;
        }
        img {
            width: 50px; /* Adjust size as needed */
            height: 50px; /* Adjust size as needed */
            object-fit: cover; /* Keeps aspect ratio */
        }
        .center-button {
            text-align: center;
        }
        .order-date {
            text-align: center; /* Center the order date */
            font-weight: bold; /* Make it bold for emphasis */
            margin-bottom: 20px; /* Space between date and table */
        }
        .category-title {
            font-size: 20px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-image: url('bg.png'); 
            background-size: cover;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .order-container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .btn-exit {
            background-color: #fff;
            color: #333;
            border: 1px solid #11113a;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-decoration: none;
            display: inline-block;
            margin-bottom: 20px;
        }
        .btn-exit:hover {
            background-color: #ced6ff;
        }
        .btn-cancel {
            background-color: red;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-cancel:hover {
            background-color: darkred;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border: 1px solid #11113a;
        }
        th, td {
            border: 1px solid #11113a;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #5566b8;
            color: white;
        }
        img {
            width: 50px; /* Adjust size as needed */
            height: 50px; /* Adjust size as needed */
            object-fit: cover; /* Keeps aspect ratio */
        }
        .center-button {
            text-align: center;
        }
        .order-date {
            text-align: center; /* Center the order date */
            font-weight: bold; /* Make it bold for emphasis */
            margin-bottom: 20px; /* Space between date and table */
        }
        .category-title {
            font-size: 20px;
            font-weight: bold;
            margin-top: 30px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="order-container">
    <h2>Your Orders</h2>
    
    <!-- Centered order date with current system date -->
    <p class="order-date">Order Date: <?php echo date('Y-m-d'); ?></p>

    <?php
    // Assuming you already have a connection to the database named $conn

    // Get the latest OrderID from tblOrder
    $orderIDQuery = "SELECT MAX(OrderID) AS LatestOrderID FROM tblOrder";
    $orderIDResult = $conn->query($orderIDQuery);
    $latestOrderID = $orderIDResult->fetch_assoc()['LatestOrderID'];

    // Initialize the next OrderID
    $nextOrderID = is_null($latestOrderID) ? 1 : $latestOrderID + 1;

    // Check if there are any items in the cart
    if ($cartResult && $cartResult->num_rows > 0) {
        // Initialize an array to store meals by category
        $mealsByCategory = [];

        // Organize meals by category
        while ($row = $cartResult->fetch_assoc()) {
            $mealCategory = $row['MealCategory'];
            $mealsByCategory[$mealCategory][] = $row;
        }

        // Initialize order ID counter for each meal category
        $orderIDCounter = 0;

        // Display meals grouped by category
        foreach ($mealsByCategory as $mealCategory => $meals) {
            // Increment the order ID for the current category
            $orderIDCounter++;
            $currentOrderID = $nextOrderID + $orderIDCounter - 1; // Ensure continuous OrderID

            echo "<div class='category-title'>$mealCategory</div>";
            echo "<table>";
            echo "<thead><tr><th>Order ID</th><th>Meal ID</th><th>Meal Name</th><th>Status</th></tr></thead>"; // Added Order ID column
            echo "<tbody>";

            // Display the same Order ID for all meals in this category
            foreach ($meals as $index => $meal) {
                $mealID = $meal['MealID'];
                $mealName = $meal['MealName'];
                $status = 'Pending'; // You can set the status based on your requirements

                echo "<tr>";
                if ($index === 0) { // Show OrderID only for the first meal in the category
                    echo "<td rowspan='" . count($meals) . "'>$currentOrderID</td>"; // Show OrderID for the entire meal category
                }
                echo "<td>$mealID</td>
                      <td>$mealName</td>
                      <td>$status</td>
                      <td>
                          <form method='POST' style='display: inline;'>
                              <input type='hidden' name='mealID' value='$mealID'>
                              <button type='submit' name='cancel_order' class='btn-cancel'>Cancel</button>
                          </form>
                      </td>";
                echo "</tr>";
            }

            echo "</tbody></table>"; // Close table for the current category
        }
    } else {
        echo "<p>Your cart is empty.</p>";
    }
    ?>

    <div class="center-button">
        <p><a href="1a_checklogindb.php" class="btn-exit">Exit</a></p>
    </div>
</div>

</body>
</html>
