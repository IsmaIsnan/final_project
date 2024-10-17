<?php
session_start();
include '4_dbconnect.php'; // Include your database connection

if (!isset($_SESSION['PatientID'])) {
    die("Error: Patient not logged in. Please log in to add items to your cart.");
}

if (isset($_POST['mealID']) && isset($_POST['mealName'])) {
    $mealID = $_POST['mealID'];
    $mealName = $_POST['mealName'];
    $patientID = $_SESSION['PatientID'];

    // Insert into the cart table
    $insertQuery = "INSERT INTO cart (PatientID, MealID) VALUES ('$patientID', '$mealID')";
    if ($conn->query($insertQuery) === TRUE) {
        // Add to the session cart
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
        $_SESSION['cart'][] = [
            'id' => $mealID,
            'name' => $mealName
        ];
        echo json_encode(['success' => true, 'message' => 'Item added to cart.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error adding item to cart.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}

$conn->close();
?>
