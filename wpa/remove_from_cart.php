<?php
session_start();
include '4_dbconnect.php'; // Include your database connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the mealID is set
    if (isset($_POST['mealID'])) {
        $mealID = $_POST['mealID'];
        $patientID = $_SESSION['PatientID'];

        // Prepare the SQL statement to remove the meal from the cart
        $removeQuery = $conn->prepare("DELETE FROM cart WHERE MealID = ? AND PatientID = ?");
        $removeQuery->bind_param("ss", $mealID, $patientID);

        if ($removeQuery->execute()) {
            echo json_encode(["success" => true, "message" => "Item removed from cart."]);
        } else {
            echo json_encode(["success" => false, "message" => "Failed to remove item."]);
        }

        $removeQuery->close();
    } else {
        echo json_encode(["success" => false, "message" => "mealID not provided."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Invalid request method."]);
}
?>
