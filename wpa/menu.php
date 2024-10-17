<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mealrx";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$patientAllergies = isset($_POST['Allergies']) ? $_POST['Allergies'] : []; 

if (isset($_POST['PatientID'])) {
    $patientID = $_POST['PatientID'];
    $selectedMeals = isset($_POST['meal']) ? $_POST['meal'] : []; 

    $patientAllergiesQuery = "SELECT allergies FROM patient WHERE patientID = '$patientID'";
    $patientAllergiesResult = $conn->query($patientAllergiesQuery);
    $patientAllergiesRow = $patientAllergiesResult->fetch_assoc();

    if (isset($patientAllergiesRow['allergies']) && !is_null($patientAllergiesRow['allergies'])) {
        $patientAllergies = explode(',', $patientAllergiesRow['allergies'] ?? ''); 
    } else {
        $patientAllergies = []; 
    }
} else {
    header("Location: 1a_checklogindb.php");
    exit();
}

$mealsQuery = "SELECT MealName, Description, Calories, Ingredients, MealID, AllergenWarnings, ImageURL, 'breakfast' AS MealType FROM breakfast
               UNION ALL
               SELECT MealName, Description, Calories, Ingredients, MealID, AllergenWarnings, ImageURL, 'lunch' AS MealType FROM lunch
               UNION ALL
               SELECT MealName, Description, Calories, Ingredients, MealID, AllergenWarnings, ImageURL, 'dinner' AS MealType FROM dinner
               UNION ALL
               SELECT MealName, Description, Calories, Ingredients, MealID, AllergenWarnings, ImageURL, 'drink' AS MealType FROM drink";
$mealsResult = $conn->query($mealsQuery);

$mealsMenu = [];
$drinks = []; 
if ($mealsResult->num_rows > 0) {
    while ($row = $mealsResult->fetch_assoc()) {
        $mealsMenu[$row['MealID']] = $row; 
        if ($row['MealType'] === 'drink') {
            $drinks[$row['MealID']] = $row; 
        }
    }
} else {
    echo "No meal items found.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meal and Drink Selection</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Add your CSS file -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-image: url('bg.png'); 
            background-size: cover;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #333;
        }
        .cart-button {
            background-color: #fff;
            color: #333;
            border: 1px solid #11113a;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            position: fixed;
            bottom: 20px; 
            right: 20px;  
        }

        .cart-button:hover {
            background-color: #ced6ff;
        }
        .menu-container {
            width: auto;
            margin: 100px auto;
            padding: 20px;
            background-color: transparent;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-image: url('header.png'); 
            background-size: contain;
            background-size: 100% 100%;
            background-repeat: no-repeat;
            background-position: center;
            padding: 40px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            color: white;
        }

        .patient-info {
            font-size: 18px;
            color: white;
        }

        .menu-buttons {
            display: flex;
            gap: 30px;
            align-items: center; 
        }

        .menu-buttons input[type="button"] {
            background-color: transparent;
            color: white;
            padding: 10px 30px;
            border: 3px solid #ced6ff;
            border-radius: 20px;
            cursor: pointer;
            font-size: 15px;
        }

        .menu-buttons input[type="button"]:hover {
            background-color: #5566b8;
        }

        .cart-icon {
            font-size: 24px;
            color: white;
            cursor: pointer;
            padding: 10px;
        }

        .cart-icon:hover {
            color: white;
        }
        .item {
            margin-bottom: 20px;
        }
        .item img {
            width: 100px;
            height: 100px;
        }
        .item h4 {
            margin: 5px 0;
        }
        .item p {
            font-size: 14px;
        }
        .disabled {
            color: grey;
            pointer-events: none;
            opacity: 0.5;
        }

        .meal-container.disabled img {
            filter: grayscale(100%);
            opacity: 0.5;
        }

        .meal-container.disabled h4, .meal-container.disabled p {
            color: grey;
        }

        .meal-container {
            display: inline-block;
            flex-direction: column;
            align-items: center;
            width: 300px;
            height: 640px;
            margin: 10px;
            padding: 15px;
            background-color: white;
            border: 3px solid #5566b8;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            border-radius: 10px;
            overflow: hidden;
            position: relative;
        }

        .meal-container img {
            width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .meal-container h4 {
            font-size: 18px;
            margin: 10px 0;
        }

        .meal-container p {
            font-size: 14px;
            color: #666;
            margin: 5px 0;
        }

        .meal-container button {
            width: 100%;
            padding: 10px 15px;
            border: none;
            border-radius: 0 0 10px 10px;
            background-color: #5566b8;
            color: white;
            cursor: pointer;
            position: absolute;
            bottom: 0;
            left: 0;
        }

        .meal-container button:hover {
            background-color: #445099; 
        }

        .meal-container.disabled {
            pointer-events: none;
            opacity: 0.5;
            filter: grayscale(100%);
        }

        .meal-container.disabled img {
            filter: grayscale(100%);
            opacity: 0.5;
        }

        .meal-container.disabled h4, .meal-container.disabled p {
            color: grey;
        }

        #view-cart {
            position: fixed;
            right: 20px;
            bottom: 20px;
            z-index: 1000;
            background-color: #5566b8;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            font-size: 35px;
        }

        #view-cart:hover {
            background-color: #445099;
        }

        #view-cart i {
            margin-right: 0;
        }

    </style>
</head>
<body>

    <a href="cart_page.php">
        <button id="view-cart"><i class="fas fa-shopping-basket"></i></button>
    </a>

    <div class="menu-container">
        <div class="header">
            <div class="patient-info">
                Patient: <?php echo htmlspecialchars($patientID); ?>
            </div>
            
            <div class="menu-buttons">
                <input type="button" value="Meal" onclick="showMeals()">
                <input type="button" value="Drink" onclick="showDrinks()">
                <a href="cart_page.php" class="cart-icon">
                    &#128722;
                </a>
            </div>
        </div>

        <div id="meals" class="menu" style="display:none;">
            <h2>Meals</h2>
            <?php
            foreach ($selectedMeals as $mealTime) {
                if ($mealTime !== reset($selectedMeals)) {
                    echo "<hr style='border: 6px solid #11113a; margin: 20px 0;'>";
                }

                echo "<h1 style='text-align: center; padding: 20px; background-image: url(\"bgm.png\"); background-position: center; background-repeat: no-repeat; background-size: 60% auto; color: white; border-radius: 10px; margin: 20px 0;'>$mealTime</h1>";

                foreach ($mealsMenu as $mealID => $details) {
                    if (($mealTime === 'Breakfast' && $details['MealType'] === 'breakfast') ||
                        ($mealTime === 'Lunch' && $details['MealType'] === 'lunch') ||
                        ($mealTime === 'Dinner' && $details['MealType'] === 'dinner')) {
                

                        $mealAllergens = explode(',', $details['AllergenWarnings']);
                        $containsAllergen = false;
                        foreach ($mealAllergens as $mealAllergen) {
                            if (in_array(trim($mealAllergen), $patientAllergies)) {
                                $containsAllergen = true;
                                break;
                            }
                        }
                
                        $disabledClass = $containsAllergen ? 'disabled' : '';
                        echo "<div class='meal-container $disabledClass'>";
                        echo "<img src='{$details['ImageURL']}' alt='{$details['MealID']}'>";
                        echo "<h4>({$mealID})</h4>";
                        echo "<h4>{$details['MealName']}</h4>";
                        echo "<p>{$details['Description']}</p>";
                        echo "<button onclick=\"addToCart('{$mealID}', '{$details['MealName']}')\">Add to Cart</button>";
                        echo "</div>";
                    }
                }                
            }
        ?>
        </div>

        <div id="drinks" class="menu" style="display:none;">
            <h2>Drinks</h2>

            <div id="drink-container">
                <?php
                foreach ($selectedMeals as $mealTime) {
                    if ($mealTime !== reset($selectedMeals)) {
                        echo "<hr style='border: 6px solid #11113a; margin: 20px 0;'>";
                    }

                    echo "<h1 style='text-align: center; padding: 20px; background-image: url(\"bgm.png\"); background-position: center; background-repeat: no-repeat; background-size: 60% auto; color: white; border-radius: 10px; margin: 20px 0;'>$mealTime</h1>";
                     
                    foreach ($drinks as $mealID => $details) {
                            $mealAllergens = explode(',', $details['AllergenWarnings']);
                            $containsAllergen = false;
                            foreach ($mealAllergens as $mealAllergen) {
                                if (in_array(trim($mealAllergen), $patientAllergies)) {
                                    $containsAllergen = true;
                                    break;
                                }
                            }

                            $disabledClass = $containsAllergen ? 'disabled' : '';
                            echo "<div class='meal-container $disabledClass'>";
                            echo "<img src='{$details['ImageURL']}' alt='{$details['MealName']}'>";
                            echo "<h4>({$mealID})</h4>";
                            echo "<h4>{$details['MealName']}</h4>";
                            echo "<p>{$details['Description']}</p>";
                            echo "<button onclick=\"addToCart('{$mealID}', '{$details['MealName']}')\">Add to Cart</button>";
                            echo "</div>";
                            }
                        }            
                ?>  
            </div>
        </div>

    <script>
        let cart = JSON.parse(sessionStorage.getItem('cart')) || [];

        function showMeals() {
            document.getElementById('meals').style.display = 'block';
            document.getElementById('drinks').style.display = 'none';
            document.getElementById('cart').style.display = 'none';
        }

        function showDrinks() {
            document.getElementById('meals').style.display = 'none';
            document.getElementById('drinks').style.display = 'block';
            document.getElementById('cart').style.display = 'none';
        }

        function addToCart(mealID, mealName, mealTime)
        {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_cart.php", true); 
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    Swal.fire({
                        title: 'Added to Cart',
                        text: mealName + " has been added to your cart.",
                        icon: 'success'
                    });
                }
            };
            xhr.send("mealID=" + mealID + "&mealName=" + mealName);
        }

        function addDrinkToCart(mealID, mealName) 
        {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "add_to_cart.php", true); 
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    Swal.fire({
                        title: 'Added to Cart',
                        text: mealName + " has been added to your cart.",
                        icon: 'success'
                    });
                }
            };
            xhr.send("mealID=" + mealID + "&mealName=" + mealName);
        }
       
        function updateCart() {
            const cartItemsContainer = document.getElementById('cartItems');
            cartItemsContainer.innerHTML = '';

            cart.forEach(item => {
                const li = document.createElement('li');
                if (item.itemType === 'meal') {
                li.textContent = `${item.mealName} (${item.mealID}) for ${item.mealTime}`;
            } else if (item.itemType === 'drink') {
                li.textContent = `${item.mealName} (${item.mealID})`;
            }
                //li.textContent = item;
                cartItemsContainer.appendChild(li);
            });

            document.getElementById('cart').style.display = cart.length > 0 ? 'block' : 'none';
        }

        function viewCart() {
            const cart = JSON.parse(sessionStorage.getItem('cart')) || [];
            
            if (cart.length === 0) {
                Swal.fire('Your cart is empty!');
                return;
            }

            let cartDetails = "Your Cart:\n";
            cart.forEach(item => {
                cartDetails += `- ${item.mealName} (${item.mealID}) for ${item.mealTime}\n`;
            });
            
            Swal.fire({
                title: 'Your Cart',
                text: cartDetails,
                icon: 'info',
                confirmButtonText: 'OK'
            });
        }
    </script>
</body>
</html>