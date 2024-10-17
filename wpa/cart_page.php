<?php
session_start();
include '4_dbconnect.php'; // Adjust the filename as needed

if (!isset($_SESSION['PatientID'])) {
    die("Error: Patient not logged in.");
}

$patientID = $_SESSION['PatientID'];

// Place Order
if (isset($_POST['place_order'])) {
    $cartItems = $_SESSION['cart']; // Assuming your cart is stored in session

    foreach ($cartItems as $item) {
        $mealID = $item['id']; // Adjust based on how you store items
        $status = 'Pending'; // Default status when ordering

        // Insert each item into tblorder
        $query = "INSERT INTO tblorder (MealID, Date, Status, PatientID) VALUES ('$mealID', NOW(), '$status', '$patientID')";
        $conn->query($query);
    }

    // Clear the cart after placing the order
    unset($_SESSION['cart']);
    header('Location: order.php'); // Redirect to the order page after placing the order
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="style.css"> <!-- Include your main stylesheet -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome -->
    <style>
        body {
            background-image: url('bg.png'); 
            background-size: cover;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .cart-container {
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        .btn-back, .btn-place-order {
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
        .btn-back:hover, .btn-place-order:hover {
            background-color: #ced6ff;
        }
        .center-button {
            text-align: center;
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
            text-align: center; /* Center text in table cells */
            width: 33.33%; /* Make all columns the same width */
        }
        th {
            background-color: #5566b8;
            color:white;
        }
        .btn-remove {
            background-color: red; /* Red box color for remove button */
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-remove:hover {
            background-color: darkred; /* Darker red on hover */
        }
        .btn-remove i {
            margin: 0; /* Remove margin for icon */
        }
    </style>
</head>
<body>

<div class="cart-container">
    <a href="menu.php" class="btn-back">
        <i class="fas fa-arrow-left"></i> Back to Menu
    </a>
    <h2>Your Cart</h2>
    
    <?php
    // Fetch meals and drinks based on the PatientID
    $patientID = $_SESSION['PatientID'];

    // Fetch meals from the cart based on the PatientID
    $cartQuery = $conn->prepare("SELECT MealID FROM cart WHERE PatientID = ?");
    $cartQuery->bind_param("s", $patientID);
    $cartQuery->execute();
    $result = $cartQuery->get_result();

    $mealIDs = [];
    $drinkIDs = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $mealID = $row['MealID'];
            // Determine if the MealID corresponds to a meal or drink
            if (substr($mealID, 0, 2) == 'dk') { // Assuming drink IDs start with 'dk'
                $drinkIDs[] = $mealID; // It's a drink
            } else {
                $mealIDs[] = $mealID; // It's a meal
            }
        }
    }

    // Group meals by type
    $groupedMeals = [
        'breakfast' => [],
        'lunch' => [],
        'dinner' => [],
        'drink' => []
    ];

    // Fetch meal names based on type
    foreach ($mealIDs as $mealID) {
        $mealType = substr($mealID, 0, 1); // First character to identify the meal type
        $mealTypeTable = match ($mealType) {
            'B' => 'breakfast',
            'L' => 'lunch',
            'D' => 'dinner',
            default => null,
        };
        if ($mealTypeTable) {
            $mealQuery = $conn->prepare("SELECT MealID, MealName FROM $mealTypeTable WHERE MealID = ?");
            $mealQuery->bind_param("s", $mealID);
            $mealQuery->execute();
            $mealResult = $mealQuery->get_result();
            if ($mealResult->num_rows > 0) {
                while ($row = $mealResult->fetch_assoc()) {
                    $groupedMeals[strtolower($mealTypeTable)][] = $row; // Store the entire row
                }
            }            
        }
    }

    // Group drinks
    foreach ($drinkIDs as $drinkID) {
        $drinkQuery = $conn->prepare("SELECT MealID, MealName FROM drink WHERE MealID = ?");
        $drinkQuery->bind_param("s", $drinkID);
        $drinkQuery->execute();
        $drinkResult = $drinkQuery->get_result();
        if ($drinkResult->num_rows > 0) {
            while ($row = $drinkResult->fetch_assoc()) {
                $groupedMeals['drink'][] = $row; // Store the entire row for drinks
            }
        }
    }

    // Display meals in a table format
    foreach ($groupedMeals as $type => $items) {
        if (!empty($items)) {
            echo "<h3>" . ucfirst($type) . "</h3>";
            echo "<table>";
            echo "<thead><tr><th>Meal ID</th><th>Meal Name</th></tr></thead>";
            echo "<tbody>";
            foreach ($items as $item) {
                $mealName = $item['MealName'];
                $mealID = $item['MealID']; // Ensure you have MealID available in the item

                // Displaying the meal ID, name, and trash icon for removing
                echo "<tr>
                        <td>$mealID</td>
                        <td>$mealName</td>
                        <td><button class='btn-remove' onclick='removeFromCart(\"$mealID\")'><i class='fas fa-trash'></i></button></td>
                      </tr>";
            }
            echo "</tbody></table>";
        }
    }
    ?>
    <div class="center-button"> 
        <button class="btn-place-order" onclick="confirmOrder()">Place Order</button>
    </div>
</div>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function removeFromCart(mealID) {
        // AJAX request to remove the item from the cart
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "remove_from_cart.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onload = function () {
            const response = JSON.parse(xhr.responseText);
            if (response.success) {
                location.reload(); // Reload to update the cart
            } else {
                alert(response.message);
            }
        };
        xhr.send("mealID=" + encodeURIComponent(mealID));
    }

    function confirmOrder() {
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to place this order?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, place it!'
        }).then((result) => {
            if (result.isConfirmed) {
                // Create a form to submit the order
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = 'cart_page.php';
                form.innerHTML = '<input type="hidden" name="place_order" value="1">';
                document.body.appendChild(form);
                form.submit();
            }
        });
    }
</script>
</body>
</html>
