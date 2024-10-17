<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['PatientID'])) {
    // Sanitize PatientID input
    $patientID = htmlspecialchars($_POST['PatientID'], ENT_QUOTES, 'UTF-8');

    // Fetch patient's allergies
    include '4_dbconnect.php'; // Include your database connection
    $allergyQuery = $conn->prepare("SELECT Allergies FROM patient WHERE PatientID = ?");
    $allergyQuery->bind_param("s", $patientID);
    $allergyQuery->execute();
    $allergyResult = $allergyQuery->get_result();
    
    $allergies = [];
    while ($row = $allergyResult->fetch_assoc()) {
        $allergies[] = $row['Allergies'];
    }
    $conn->close();
} else {
    header("Location: 1a_checklogindb.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Select Meal Time</title>
    <style>
        body {
            background-image: url('bg.png'); /* Update with the actual path */
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #333;
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .meal-container {
            width: 400px;
            padding: 20px;
            background-color: #11113a;
            color: white;
            border-radius: 50px;
            text-align: center;
        }
        input[type="checkbox"] {
            margin: 10px 0;
        }
        input[type="submit"] {
            padding: 10px 20px;
            border-radius: 25px;
            background-color: #fff;
            color: #333;
            border: 1px solid #11113a;
            cursor: pointer;
            margin-top: 15px;
        }
        input[type="submit"]:hover {
            background-color: #ced6ff;
        }
    </style>
</head>
<body>
<div class="meal-container">
        <h2>Select Meal Time</h2>
        <form action="menu.php" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="PatientID" value="<?php echo $patientID; ?>">
            <input type="checkbox" name="meal[]" value="Breakfast" id="breakfast-checkbox"> Breakfast<br>
            <input type="checkbox" name="meal[]" value="Lunch" id="lunch-checkbox"> Lunch<br>
            <input type="checkbox" name="meal[]" value="Dinner" id="dinner-checkbox"> Dinner<br><br>
            <input type="submit" name="submit" value="Confirm Meal Time">
        </form>
    </div>

    <script>
        function validateForm() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]');
            const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);
            if (!isChecked) {
                alert("Please select at least one meal time.");
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }

        // Disable checkboxes based on allergies
        const allergies = <?php echo json_encode($allergies); ?>;
        const mealTypes = {
            Breakfast: ['B1', 'B2', 'B3'], // Replace with actual Meal IDs for Breakfast
            Lunch: ['L1', 'L2', 'L3'], // Replace with actual Meal IDs for Lunch
            Dinner: ['D1', 'D2', 'D3'], // Replace with actual Meal IDs for Dinner
        };

        allergies.forEach(allergen => {
            if (mealTypes.Breakfast.includes(allergen)) {
                document.getElementById('breakfast-checkbox').disabled = true;
            }
            if (mealTypes.Lunch.includes(allergen)) {
                document.getElementById('lunch-checkbox').disabled = true;
            }
            if (mealTypes.Dinner.includes(allergen)) {
                document.getElementById('dinner-checkbox').disabled = true;
            }
        });
    </script>
</body>
</html>
