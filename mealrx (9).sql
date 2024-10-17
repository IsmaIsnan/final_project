-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 17, 2024 at 04:31 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mealrx`
--

-- --------------------------------------------------------

--
-- Table structure for table `breakfast`
--

CREATE TABLE `breakfast` (
  `Mealname` varchar(80) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Calories` varchar(10) NOT NULL,
  `Ingredients` varchar(200) NOT NULL,
  `AllergenWarnings` varchar(30) NOT NULL,
  `MealID` varchar(6) NOT NULL,
  `ImageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `breakfast`
--

INSERT INTO `breakfast` (`Mealname`, `Description`, `Calories`, `Ingredients`, `AllergenWarnings`, `MealID`, `ImageURL`) VALUES
('CEREAL WITH FRESH MILK', 'Honeystar / Cornflakes / frootlops ', '199 kcal', 'Corn flour, Sugar, Palm oil, Wheat flour, Honey, Malt extract, Salt, Vitamins and minerals (like iron, calcium, vitamin C, vitamin D, etc.)', 'Dairy & Gluten', 'B001', 'B001.jpg'),
('TOASTED BREAD WITH MUSHROOM SOUP', 'A comforting combination of crispy toasted bread served with creamy mushroom soup, perfect for a warm and nourishing meal.', '350 kcal', 'White or whole wheat bread, butter. Fresh mushrooms (like button or cremini), vegetable or chicken broth, heavy cream, garlic, onions, flour (for  thickening), butter, salt, and pepper.', 'Gluten & Dairy', 'B002', 'B002.jpg'),
('PORRIDGE WITH CARROT, POTATO AND SHREDDED CHICKEN', 'A comforting bowl of porridge made with rice, blended with tender pieces of chicken, soft carrots, and potatoes, providing warmth and nourishment.', '250 kcal', 'Rice, Shredded Chicken Breast, Carrots, Potatoes, Chicken broth, Salt and pepper', 'NA', 'B003', 'B003.jpg'),
('RICE NOODLES SOUP WITH CHICKEN', 'A light and flavorful dish featuring tender rice noodles served in a savory chicken broth, topped wi', '350 kcal', 'Rice noodles, Shredded Chicken Breast, Chicken broth, Green onions, Cilantro, Fried shallots, Salt a', 'NA', 'B004', 'B004.jpg'),
('FRIED RICE', 'A savory dish of stir-fried rice cooked with a mix of vegetables, eggs, and soy sauce, offering a fl', '400 kcal', 'Cooked Rice, Eggs, Mixed Vegetables, Soy sauce, Garlic, Green onions, Cooking oil, Salt and pepper', 'Eggs & Soy', 'B005', 'B005.jpg'),
('CHICKEN WRAP ', 'A light and nutritious wrap filled with  tender grilled chicken, fresh lettuce, tomatoes, and a tangy dressing, all wrapped in a soft tortilla.', '320 kcal', 'Grilled Chicken Breast, Tortilla Wrap, Lettuce, Tomatoes, Cucumber, Mayonnaise or yogurt-based dressing, Salt and pepper', 'Eggs, Dairy & Gluten', 'B006', 'B006.jpg'),
('NASI LEMAK ', 'A Malaysian classic, Nasi Lemak is a fragrant rice dish cooked in coconut milk, served with a spicy sambal, crispy anchovies, hard-boiled egg, roasted peanuts, and cucumber slices. ', '450 kcal', 'Coconut Milk Rice, Sambal, Fried Anchovies, Roasted peanuts, Hard-boiled egg, Cucumber, Salt', 'Eggs & Peanuts', 'B007', 'B007.jpg'),
('ROTI JALA ', 'Roti Jala is a traditional Malaysian net-like crepe served with a side of curry.', '150 kcal', 'Flour, Eggs, Coconut Milk, Water, Salt and Oil (for cooking).', 'Eggs & Gluten', 'B008', 'B008.jpg'),
('ENGLISH BREAKFAST', 'A classic English Breakfast includes scrambled or fried eggs, turkey bacon or sausage, grilled tomatoes, sautéed mushrooms, baked beans, and toast.', '500 kcal', 'Eggs, Turkey Bacon, Sausage, Grilled Tomatoes, Sautéed mushrooms, Baked beans, Toast, Butter (for to', 'Eggs, Gluten, Dairy & Soy', 'B009', 'B009.jpg'),
('GARLIC CHEESE TOAST', 'Garlic Cheese Toast is a crispy, golden toast topped with a mixture of garlic butter and melted cheese, providing a flavorful and satisfying side or snack.', '200 kcal', 'Bread, Garlic, Butter, Grated Cheese and Salt.', 'Gluten & Dairy', 'B010', 'B010.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cartID` int(5) NOT NULL,
  `PatientID` int(11) NOT NULL,
  `MealID` varchar(10) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartID`, `PatientID`, `MealID`, `created_at`) VALUES
(15, 0, 'L003', '2024-10-17'),
(16, 0, 'W03', '2024-10-17');

-- --------------------------------------------------------

--
-- Table structure for table `dinner`
--

CREATE TABLE `dinner` (
  `MealName` varchar(80) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Calories` varchar(10) NOT NULL,
  `Ingredients` varchar(200) NOT NULL,
  `AllergenWarnings` varchar(30) NOT NULL,
  `MealID` varchar(6) NOT NULL,
  `ImageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dinner`
--

INSERT INTO `dinner` (`MealName`, `Description`, `Calories`, `Ingredients`, `AllergenWarnings`, `MealID`, `ImageURL`) VALUES
('SPAGHETTI CARBONARA/BOLOGNESE/AGLIO OLIO', 'A classic Italian dish featuring spaghetti tossed in a rich sauce. Choose from creamy Carbonara with pancetta, savory Bolognese with minced meat and tomatoes, or Aglio Olio with garlic and olive oil. Each option is flavorful and satisfying.', '400 kcal', 'Spaghetti Carbonara sauce (eggs, cheese,pancetta) or Bolognese sauce (ground meat, tomatoes) or, Aglio Olio (garlic, olive oil, chili flakes), Parmesan cheese (optional)', 'Gluten, Eggs & Dairy', 'D001', 'D001.jpg'),
('CHICKEN/FISH BURGER', 'A delicious burger featuring either a juicy grilled chicken breast or a crispy fish fillet, served in a soft bun with lettuce, tomatoes, and your choice of sauce.', '400 kcal', 'Chicken breast or fish fillet, Burger bun, Lettuce, Tomato, Mayonnaise or other sauce', 'Gluten', 'D002', 'D002.jpg'),
('PORRIDGE WITH CARROT, POTATO AND SHREDDED CHICKEN', 'A comforting bowl of porridge made with rice, blended with tender pieces of chicken, soft carrots, and potatoes, providing warmth and nourishment.', '250 kcal', 'Rice, Shredded chicken, Carrots, Potatoes, Chicken broth, Salt and pepper', 'NA', 'D003', 'D003.jpg'),
('RICE WITH FRIED FISH AND CLEAR VEGETABLES', 'A wholesome meal featuring steamed rice served with crispy fried fish and a side of clear vegetable soup, providing a light and nutritious option.', '400 kcal', 'Steamed rice, Fried fish, Clear soup (water, vegetables), Mixed vegetables (carrots, spinach)', 'NA', 'D004', 'D004.jpg'),
('MEATBALLS WITH MASHED POTATO AND BROCCOLI', 'Tender meatballs served with creamy mashed potatoes and steamed broccoli, creating a comforting and hearty meal.', '500 kcal', 'Meatballs (beef or chicken), Mashed potatoes (potatoes, butter, milk), Steamed broccoli, Gravy (optional)', 'Gluten & Dairy', 'D005', 'D005.jpg'),
('LAKSA', 'A spicy and aromatic noodle soup with coconut milk, featuring rice noodles, shrimp or chicken, and a blend of herbs and spices.', '400 kcal', 'Rice noodles, Coconut milk, Shrimp or chicken, Laksa paste (spices, herbs), Bean sprouts, Lime (for garnish)', 'Seafood', 'D006', 'D006.jpg'),
('RICE WITH SCRAMBLE EGGS AND PAD KRA PAO', 'A flavorful Thai dish featuring steamed rice topped with a fried egg and spicy stir-fried meat (usually chicken or pork) with holy basil, served with a side of fresh vegetables.', '500 kcal', 'Steamed rice, Scramble egg, Ground chicken or pork, Holy basil, Garlic and chili, Vegetables (cucumbers, lettuce)', 'Eggs', 'D007', 'D007.jpg'),
('RICE WITH CHICKEN/BEEF RENDANG AND CABBAGE', 'A fragrant dish featuring steamed rice served with rich and flavorful rendang, either chicken or beef, accompanied by sautéed cabbage.', '600 kcal', 'Steamed rice, Chicken or beef rendang (spices, coconut milk), Sautéed cabbage', 'NA', 'D008', 'D008.jpg'),
('CHICKEN RICE ', 'A flavorful dish featuring poached or roasted chicken served over fragrant rice cooked in chicken broth, accompanied by a side of chili sauce and cucumber slices.', '500 kcal', 'Poached or roasted chicken, Fragrant rice (cooked in chicken broth), Chili sauce, Cucumber slices, Soy sauce (optional)', 'Soy & Gluten', 'D009', 'D009.jpg'),
('KUE TEOW KUNGFU', 'A delicious stir-fried noodle dish featuring flat rice noodles, mixed with vegetables and your choice of protein, typically served with a flavorful sauce.', '400 kcal', 'Flat rice noodles (kue teow), Mixed vegetables (carrots, bell peppers), Chicken, shrimp, or tofu, Soy sauce, Garlic and ginger', 'Soy', 'D010', 'D010.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `drink`
--

CREATE TABLE `drink` (
  `MealName` varchar(80) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Calories` varchar(10) NOT NULL,
  `Ingredients` varchar(200) NOT NULL,
  `AllergenWarnings` varchar(30) NOT NULL,
  `MealID` varchar(6) NOT NULL,
  `ImageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `drink`
--

INSERT INTO `drink` (`MealName`, `Description`, `Calories`, `Ingredients`, `AllergenWarnings`, `MealID`, `ImageURL`) VALUES
('KOPI-O (BLACK COFFEE) (SUGAR FREE)', 'A strong and aromatic black coffee made from finely ground coffee beans, brewed with hot water and served without milk or sugar, allowing the rich coffee flavor to shine. ', '2 kcal', 'Brewed coffee and Water', 'Coffee', 'W01', 'W01.jpg'),
('TEH-O (BLACK TEA) (SUGAR FREE)', 'A refreshing black tea brewed from tea leaves, served hot or cold without milk or sugar, providing a robust flavor and aroma.', '2 kcal ', 'Brewed black tea and Water', 'Tea', 'W02', 'W02.jpg'),
('TEH SUSU (MILK TEA) ', 'A rich and creamy tea made by brewing black tea and adding condensed or evaporated milk, creating a sweet and comforting beverage.', '123 kcal', 'Brewed black tea, Milk (fresh milk)', 'Dairy & Tea', 'W03', 'W03.jpg'),
('COCO (CHOCOLATE MALT DRINK) (SUGAR FREE)', 'A popular chocolate malt drink made from Milo powder, mixed with hot or cold water or milk, known for its rich flavor and energy-boosting properties.', '100 kcal', 'Coco powder, Water or milk', 'Dairy & Gluten', 'W04', 'W04.jpg'),
('FRESH MILK', 'Fresh milk, known for its creamy texture and nutritional benefits, served chilled or warm, making it a wholesome beverage option.', '100 kcal', 'Fresh milk (whole, low-fat, or skim)', 'Dairy', 'W05', 'W05.jpg'),
('LEMON JUICE (SUGAR FREE)', 'Freshly squeezed lemon juice mixed with water, offering a tart and refreshing beverage, often enjoyed chilled.', '15 kcal', 'Fresh lemon juice and Water', 'NA', 'W06', 'W06.png'),
('APPLE JUICE (SUGAR FREE)', 'A sweet and refreshing juice made from fresh apples, providing a natural source of vitamins and a delicious flavor.', '110 kcal', 'Fresh apple juice', 'NA ', 'W07', 'W07.jpg'),
('ORANGE JUICE (SUGAR FREE)', 'A popular citrus juice made from freshly squeezed oranges, known for its vibrant flavor and high vitamin C content.', '110 kcal', 'Fresh orange juice', 'NA', 'W08', 'W08.jpg'),
('LYCHEE JUICE (SUGAR FREE)', 'A sweet and fragrant juice made from fresh lychee fruit, offering a tropical flavor that is both refreshing and delightful.', '100 kcal', 'Fresh lychee juice', 'NA', 'W09', 'W09.jpg'),
('ROSE SYRUP (SUGAR FREE)', 'A sweet and fragrant drink made from sugar-free rose syrup mixed with water, offering a refreshing floral taste without added sugar, perfect for a light and enjoyable beverage.', '15 kcal', 'Sugar-free rose syrup and Water', 'NA', 'W10', 'W10.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `lunch`
--

CREATE TABLE `lunch` (
  `MealName` varchar(80) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Calories` varchar(10) NOT NULL,
  `Ingredients` varchar(200) NOT NULL,
  `AllergenWarnings` varchar(30) NOT NULL,
  `MealID` varchar(6) NOT NULL,
  `ImageURL` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lunch`
--

INSERT INTO `lunch` (`MealName`, `Description`, `Calories`, `Ingredients`, `AllergenWarnings`, `MealID`, `ImageURL`) VALUES
('STEAMED WHITE RICE WITH GRILLED CHICKEN/FISH AND SALAD VEGETABLES', 'A wholesome meal featuring fluffy steamed white rice served with succulent grilled chicken or fish, accompanied by a side of fresh salad vegetables.', '450 kcal', 'Steamed White Rice, Grilled Chicken breast or fish fillet, Salad vegetables (lettuce, cucumbers, tomatoes), Olive oil or dressing (optional)', 'NA', 'L001', 'L001.jpg'),
('STEAMED WHITE RICE WITH SOY SAUCE CHICKEN/FISH AND MIXED VEGETABLES', 'A flavorful dish featuring steamed white rice served with chicken or fish cooked in savory soy sauce, paired with a medley of mixed vegetables.', '450 kcal', 'Steamed white rice, Soy sauce chicken or fish, Mixed vegetables (carrots, peas, bell peppers), Garlic and ginger (optional)', 'Soy & Gluten', 'L002', 'L002.jpg'),
('PORRIDGE WITH CARROT, POTATO AND SHREDDED CHICKEN', 'A comforting bowl of porridge made with rice, blended with tender pieces of chicken, soft carrots, and potatoes, providing warmth and nourishment.', '250 kcal', 'Rice, Shredded chicken, Carrots, Potatoes, Chicken broth, Salt and pepper', 'Gluten', 'L003', 'L003.jpg'),
('GRILLED CHICKEN/LAMB OR CHICKEN/LAMB CHOP', 'Tender grilled chicken or lamb chop, seasoned and cooked to perfection, offering a savory protein option that is both delicious and satisfying.', '350 kcal', 'Chicken breast or lamb chop, Olive oil, Herbs and spices (salt, pepper, garlic powder)', 'NA', 'L004', 'L004.jpg'),
('CHICKEN RICE ', 'A popular dish featuring tender poached or roasted chicken served over fragrant rice cooked in chicken broth, accompanied by a side of chili sauce and cucumber slices. ', '500 kcal', 'Poached or roasted chicken, Fragrant rice (cooked in chicken broth), Chili sauce, Cucumber slices, Soy sauce (optional)', 'Soy & Gluten', 'L005', 'L005.jpg'),
('SEAFOOD/CHICKEN TOM YUM WITH RICE/NOODLES', 'A spicy and sour Thai soup featuring shrimp or chicken, infused with aromatic herbs and spices, served with either rice or noodles for a hearty meal.', '350 kcal', 'Shrimp or chicken, Tom Yum paste, Lemongrass, Lime juice, Mushrooms, Rice or noodles', 'Seafood', 'L006', 'L006.jpg'),
('FISH & CHIPS', 'A classic dish featuring battered and fried fish served with crispy chips (fries), often accompanied by tartar sauce and a lemon wedge.', '600 kcal', 'Battered fish fillet (cod or haddock), Chips (fries), Tartar sauce, Lemon wedge', 'Gluten', 'L007', 'L007.jpg'),
('STEAMED RICE WITH SPICED FRIED CHICKEN', 'Fragrant steamed rice served with crispy, spiced fried chicken, delivering a satisfying and flavorful meal that is both comforting and filling.', '550 kcal', 'Steamed rice, Spiced fried chicken, Chili sauce (optional)', 'NA', 'L008', 'L008.jpg'),
('BAKSO (INDONESIAN MEATBALL SOUP', 'A flavorful Indonesian soup made with savory meatballs, served in a warm broth with noodles and garnished with green onions and fried shallots.', '350 kcal', 'Meatballs (beef or chicken), Broth, Noodles, Green onions, Fried shallots', 'Gluten', 'L009', 'L009.jpg'),
('GRILLED CHICKEN SALAD', 'A fresh and healthy salad featuring grilled chicken served on a bed of mixed greens, topped with colorful vegetables and a light dressing, perfect for a nutritious meal.', '300 kcal', 'Grilled chicken breast, Mixed salad greens (lettuce, spinach), Tomatoes, Cucumbers, Carrots, Olive oil or dressing', 'Dairy', 'L010 ', 'L010.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `meal`
--

CREATE TABLE `meal` (
  `MealName` varchar(80) NOT NULL,
  `Description` varchar(300) NOT NULL,
  `Calories` varchar(10) NOT NULL,
  `Ingredients` varchar(200) NOT NULL,
  `AllergenWarnings` varchar(30) NOT NULL,
  `MealID` varchar(6) NOT NULL,
  `MealImage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meal`
--

INSERT INTO `meal` (`MealName`, `Description`, `Calories`, `Ingredients`, `AllergenWarnings`, `MealID`, `MealImage`) VALUES
('CEREAL WITH FRESH MILK', 'Honeystar / Cornflakes / frootlops ', '199 kcal', 'Corn flour, Sugar, Palm oil, Wheat flour, Honey, Malt extract, Salt, Vitamins and minerals (like iron, calcium, vitamin C, vitamin D, etc.)', 'Dairy , Gluten', 'B001', ''),
('TOASTED BREAD WITH MUSHROOM SOUP', 'A comforting combination of crispy toasted bread served with creamy mushroom soup, perfect for a warm and nourishing meal.', '350 kcal', 'White or whole wheat bread, butter. Fresh mushrooms (like button or cremini), vegetable or chicken broth, heavy cream, garlic, onions, flour (for  thickening), butter, salt, and pepper.', 'Gluten & Dairy', 'B002', ''),
('PORRIDGE WITH CARROT, POTATO AND SHREDDED CHICKEN', 'A comforting bowl of porridge made with rice, blended with tender pieces of chicken, soft carrots, and potatoes, providing warmth and nourishment.', '250 kcal', 'Rice, Shredded Chicken Breast, Carrots, Potatoes, Chicken broth, Salt and pepper', 'NA', 'B003', ''),
('RICE NOODLES SOUP WITH CHICKEN', 'A light and flavorful dish featuring tender rice noodles served in a savory chicken broth, topped wi', '350 kcal', 'Rice noodles, Shredded Chicken Breast, Chicken broth, Green onions, Cilantro, Fried shallots, Salt a', 'NA', 'B004', ''),
('FRIED RICE', 'A savory dish of stir-fried rice cooked with a mix of vegetables, eggs, and soy sauce, offering a fl', '400 kcal', 'Cooked Rice, Eggs, Mixed Vegetables, Soy sauce, Garlic, Green onions, Cooking oil, Salt and pepper', 'Eggs & Soy', 'B005', ''),
('CHICKEN WRAP ', 'A light and nutritious wrap filled with  tender grilled chicken, fresh lettuce, tomatoes, and a tangy dressing, all wrapped in a soft tortilla.', '320 kcal', 'Grilled Chicken Breast, Tortilla Wrap, Lettuce, Tomatoes, Cucumber, Mayonnaise or yogurt-based dressing, Salt and pepper', 'Eggs, Dairy & Gluten', 'B006', ''),
('NASI LEMAK ', 'A Malaysian classic, Nasi Lemak is a fragrant rice dish cooked in coconut milk, served with a spicy sambal, crispy anchovies, hard-boiled egg, roasted peanuts, and cucumber slices. ', '450 kcal', 'Coconut Milk Rice, Sambal, Fried Anchovies, Roasted peanuts, Hard-boiled egg, Cucumber, Salt', 'Eggs & Peanuts', 'B007', ''),
('ROTI JALA ', 'Roti Jala is a traditional Malaysian net-like crepe served with a side of curry.', '150 kcal', 'Flour, Eggs, Coconut Milk, Water, Salt and Oil (for cooking).', 'Eggs & Gluten', 'B008', ''),
('ENGLISH BREAKFAST', 'A classic English Breakfast includes scrambled or fried eggs, turkey bacon or sausage, grilled tomatoes, sautéed mushrooms, baked beans, and toast.', '500 kcal', 'Eggs, Turkey Bacon, Sausage, Grilled Tomatoes, Sautéed mushrooms, Baked beans, Toast, Butter (for to', 'Eggs, Gluten, Dairy & Soy', 'B009', ''),
('GARLIC CHEESE TOAST', 'Garlic Cheese Toast is a crispy, golden toast topped with a mixture of garlic butter and melted cheese, providing a flavorful and satisfying side or snack.', '200 kcal', 'Bread, Garlic, Butter, Grated Cheese and Salt.', 'Gluten & Dairy', 'B010', ''),
('SPAGHETTI CARBONARA/BOLOGNESE/AGLIO OLIO', 'A classic Italian dish featuring spaghetti tossed in a rich sauce. Choose from creamy Carbonara with pancetta, savory Bolognese with minced meat and tomatoes, or Aglio Olio with garlic and olive oil. Each option is flavorful and satisfying.', '400 kcal', 'Spaghetti Carbonara sauce (eggs, cheese,pancetta) or Bolognese sauce (ground meat, tomatoes) or, Aglio Olio (garlic, olive oil, chili flakes), Parmesan cheese (optional)', 'Gluten, Eggs & Dairy', 'D001', ''),
('CHICKEN/FISH BURGER', 'A delicious burger featuring either a juicy grilled chicken breast or a crispy fish fillet, served in a soft bun with lettuce, tomatoes, and your choice of sauce.', '400 kcal', 'Chicken breast or fish fillet, Burger bun, Lettuce, Tomato, Mayonnaise or other sauce', 'Gluten', 'D002', ''),
('PORRIDGE WITH CARROT, POTATO AND SHREDDED CHICKEN', 'A comforting bowl of porridge made with rice, blended with tender pieces of chicken, soft carrots, and potatoes, providing warmth and nourishment.', '250 kcal', 'Rice, Shredded chicken, Carrots, Potatoes, Chicken broth, Salt and pepper', 'NA', 'D003', ''),
('RICE WITH FRIED FISH AND CLEAR VEGETABLES', 'A wholesome meal featuring steamed rice served with crispy fried fish and a side of clear vegetable soup, providing a light and nutritious option.', '400 kcal', 'Steamed rice, Fried fish, Clear soup (water, vegetables), Mixed vegetables (carrots, spinach)', 'NA', 'D004', ''),
('MEATBALLS WITH MASHED POTATO AND BROCCOLI', 'Tender meatballs served with creamy mashed potatoes and steamed broccoli, creating a comforting and hearty meal.', '500 kcal', 'Meatballs (beef or chicken), Mashed potatoes (potatoes, butter, milk), Steamed broccoli, Gravy (optional)', 'Gluten & Dairy', 'D005', ''),
('LAKSA', 'A spicy and aromatic noodle soup with coconut milk, featuring rice noodles, shrimp or chicken, and a blend of herbs and spices.', '400 kcal', 'Rice noodles, Coconut milk, Shrimp or chicken, Laksa paste (spices, herbs), Bean sprouts, Lime (for garnish)', 'Seafood', 'D006', ''),
('RICE WITH SCRAMBLE EGGS AND PAD KRA PAO', 'A flavorful Thai dish featuring steamed rice topped with a fried egg and spicy stir-fried meat (usually chicken or pork) with holy basil, served with a side of fresh vegetables.', '500 kcal', 'Steamed rice, Scramble egg, Ground chicken or pork, Holy basil, Garlic and chili, Vegetables (cucumbers, lettuce)', 'Eggs', 'D007', ''),
('RICE WITH CHICKEN/BEEF RENDANG AND CABBAGE', 'A fragrant dish featuring steamed rice served with rich and flavorful rendang, either chicken or beef, accompanied by sautéed cabbage.', '600 kcal', 'Steamed rice, Chicken or beef rendang (spices, coconut milk), Sautéed cabbage', 'NA', 'D008', ''),
('CHICKEN RICE ', 'A flavorful dish featuring poached or roasted chicken served over fragrant rice cooked in chicken broth, accompanied by a side of chili sauce and cucumber slices.', '500 kcal', 'Poached or roasted chicken, Fragrant rice (cooked in chicken broth), Chili sauce, Cucumber slices, Soy sauce (optional)', 'Soy & Gluten', 'D009', ''),
('KUE TEOW KUNGFU', 'A delicious stir-fried noodle dish featuring flat rice noodles, mixed with vegetables and your choice of protein, typically served with a flavorful sauce.', '400 kcal', 'Flat rice noodles (kue teow), Mixed vegetables (carrots, bell peppers), Chicken, shrimp, or tofu, Soy sauce, Garlic and ginger', 'Soy', 'D010', ''),
('STEAMED WHITE RICE WITH GRILLED CHICKEN/FISH AND SALAD VEGETABLES', 'A wholesome meal featuring fluffy steamed white rice served with succulent grilled chicken or fish, accompanied by a side of fresh salad vegetables.', '450 kcal', 'Steamed White Rice, Grilled Chicken breast or fish fillet, Salad vegetables (lettuce, cucumbers, tomatoes), Olive oil or dressing (optional)', 'NA', 'L001', ''),
('STEAMED WHITE RICE WITH SOY SAUCE CHICKEN/FISH AND MIXED VEGETABLES', 'A flavorful dish featuring steamed white rice served with chicken or fish cooked in savory soy sauce, paired with a medley of mixed vegetables.', '450 kcal', 'Steamed white rice, Soy sauce chicken or fish, Mixed vegetables (carrots, peas, bell peppers), Garlic and ginger (optional)', 'Soy & Gluten', 'L002', ''),
('PORRIDGE WITH CARROT, POTATO AND SHREDDED CHICKEN', 'A comforting bowl of porridge made with rice, blended with tender pieces of chicken, soft carrots, and potatoes, providing warmth and nourishment.', '250 kcal', 'Rice, Shredded chicken, Carrots, Potatoes, Chicken broth, Salt and pepper', 'Gluten', 'L003', ''),
('GRILLED CHICKEN/LAMB OR CHICKEN/LAMB CHOP', 'Tender grilled chicken or lamb chop, seasoned and cooked to perfection, offering a savory protein option that is both delicious and satisfying.', '350 kcal', 'Chicken breast or lamb chop, Olive oil, Herbs and spices (salt, pepper, garlic powder)', 'NA', 'L004', ''),
('CHICKEN RICE ', 'A popular dish featuring tender poached or roasted chicken served over fragrant rice cooked in chicken broth, accompanied by a side of chili sauce and cucumber slices. ', '500 kcal', 'Poached or roasted chicken, Fragrant rice (cooked in chicken broth), Chili sauce, Cucumber slices, Soy sauce (optional)', 'Soy & Gluten', 'L005', ''),
('SEAFOOD/CHICKEN TOM YUM WITH RICE/NOODLES', 'A spicy and sour Thai soup featuring shrimp or chicken, infused with aromatic herbs and spices, served with either rice or noodles for a hearty meal.', '350 kcal', 'Shrimp or chicken, Tom Yum paste, Lemongrass, Lime juice, Mushrooms, Rice or noodles', 'Seafood', 'L006', ''),
('FISH & CHIPS', 'A classic dish featuring battered and fried fish served with crispy chips (fries), often accompanied by tartar sauce and a lemon wedge.', '600 kcal', 'Battered fish fillet (cod or haddock), Chips (fries), Tartar sauce, Lemon wedge', 'Gluten', 'L007', ''),
('STEAMED RICE WITH SPICED FRIED CHICKEN', 'Fragrant steamed rice served with crispy, spiced fried chicken, delivering a satisfying and flavorful meal that is both comforting and filling.', '550 kcal', 'Steamed rice, Spiced fried chicken, Chili sauce (optional)', 'NA', 'L008', ''),
('BAKSO (INDONESIAN MEATBALL SOUP', 'A flavorful Indonesian soup made with savory meatballs, served in a warm broth with noodles and garnished with green onions and fried shallots.', '350 kcal', 'Meatballs (beef or chicken), Broth, Noodles, Green onions, Fried shallots', 'Gluten', 'L009', ''),
('GRILLED CHICKEN SALAD', 'A fresh and healthy salad featuring grilled chicken served on a bed of mixed greens, topped with colorful vegetables and a light dressing, perfect for a nutritious meal.', '300 kcal', 'Grilled chicken breast, Mixed salad greens (lettuce, spinach), Tomatoes, Cucumbers, Carrots, Olive oil or dressing', 'Dairy', 'L010 ', ''),
('KOPI-O (BLACK COFFEE) (SUGAR FREE)', 'A strong and aromatic black coffee made from finely ground coffee beans, brewed with hot water and served without milk or sugar, allowing the rich coffee flavor to shine. ', '2 kcal', 'Brewed coffee and Water', 'Coffee', 'W01', ''),
('TEH-O (BLACK TEA) (SUGAR FREE)', 'A refreshing black tea brewed from tea leaves, served hot or cold without milk or sugar, providing a robust flavor and aroma.', '2 kcal ', 'Brewed black tea and Water', 'Tea', 'W02', ''),
('TEH SUSU (MILK TEA) ', 'A rich and creamy tea made by brewing black tea and adding condensed or evaporated milk, creating a sweet and comforting beverage.', '123 kcal', 'Brewed black tea, Milk (fresh milk)', 'Dairy & Tea', 'W03', ''),
('COCO (CHOCOLATE MALT DRINK) (SUGAR FREE)', 'A popular chocolate malt drink made from Milo powder, mixed with hot or cold water or milk, known for its rich flavor and energy-boosting properties.', '100 kcal', 'Coco powder, Water or milk', 'Dairy & Gluten', 'W04', ''),
('FRESH MILK', 'Fresh milk, known for its creamy texture and nutritional benefits, served chilled or warm, making it a wholesome beverage option.', '100 kcal', 'Fresh milk (whole, low-fat, or skim)', 'Dairy', 'W05', ''),
('LEMON JUICE (SUGAR FREE)', 'Freshly squeezed lemon juice mixed with water, offering a tart and refreshing beverage, often enjoyed chilled.', '15 kcal', 'Fresh lemon juice and Water', 'NA', 'W06', ''),
('APPLE JUICE (SUGAR FREE)', 'A sweet and refreshing juice made from fresh apples, providing a natural source of vitamins and a delicious flavor.', '110 kcal', 'Fresh apple juice', 'NA ', 'W07', ''),
('ORANGE JUICE (SUGAR FREE)', 'A popular citrus juice made from freshly squeezed oranges, known for its vibrant flavor and high vitamin C content.', '110 kcal', 'Fresh orange juice', 'NA', 'W08', ''),
('LYCHEE JUICE (SUGAR FREE)', 'A sweet and fragrant juice made from fresh lychee fruit, offering a tropical flavor that is both refreshing and delightful.', '100 kcal', 'Fresh lychee juice', 'NA', 'W09', ''),
('ROSE SYRUP (SUGAR FREE)', 'A sweet and fragrant drink made from sugar-free rose syrup mixed with water, offering a refreshing floral taste without added sugar, perfect for a light and enjoyable beverage.', '15 kcal', 'Sugar-free rose syrup and Water', 'NA', 'W10', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PatientID` varchar(6) NOT NULL,
  `Name` varchar(40) NOT NULL,
  `Age` int(3) NOT NULL,
  `Gender` varchar(1) NOT NULL,
  `RoomNumber` varchar(5) NOT NULL,
  `DietaryRistrictions` varchar(50) NOT NULL,
  `Allergies` varchar(50) NOT NULL,
  `password` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PatientID`, `Name`, `Age`, `Gender`, `RoomNumber`, `DietaryRistrictions`, `Allergies`, `password`) VALUES
('DI3174', 'AMIRUL HAKIM BIN NASRUDDIN', 27, 'M', 'D503', 'Sugar free diet.', 'Dairy', '971106148624'),
('DI4179', 'SARAH LIM ', 16, 'F', 'C103', 'Patient must avoid all dairy. ', 'Dairy', '80917062184'),
('DI5943', 'MUHAMMAD IQMAL BIN RADIN', 56, 'M', 'A101', 'Lactose-Free Diet.', 'Dairy', '680831106788'),
('DI9321', 'SYAFIKAH', 24, 'F', 'D601', 'No dietary restrictions required.', 'NA', '200220021546'),
('EG7356', 'AHMAD ISHAK BIN NOH', 60, 'M', 'A105', 'Patient must avoid all eggs. ', 'Egg', '640816019476'),
('EG9327', 'NUR MALIA BINTI ISKANDAR', 5, 'F', 'C201', 'No egg meals, all sort of egg.', 'Egg ', '190125149138'),
('GL1759', 'HAMIZAN BIN HAZIM', 40, 'M', 'B101', 'Patient must avoid all Gluten Products.', 'Gluten', '8409286157'),
('GL9126', 'CRYN LIM CHIN ', 25, 'F', 'D106', 'Patient must avoid all Gluten Products.', 'Gluten', '990906318426'),
('GL9163', 'PRIYA RAJENDRAN', 29, 'F', 'D509', 'Patient must avoid all Gluten products. ', 'Gluten', '950623068429'),
('NT1539', 'SYARIFAH SYIRA BINTI SYED NAIM', 32, 'F', 'D301', 'Patient must avoid all Nuts Products.', 'Nuts', '920518496237'),
('NT6335', 'WONG SIEW MEI', 49, 'M', 'B205', 'Patient must avoid all Nuts products. ', 'Nuts', '751203059614'),
('SF5138', 'ASHOK NAIR', 22, 'M', 'D101', 'Patient must avoid all seafood due to allergies. ', 'Seafood', '20117036487'),
('SF6720', 'AMIRA BINTI AMIR ', 41, 'F', 'B301', 'Patient must avoid all seafood due to allergies. ', 'Seafood', '830104031561'),
('SF8042', 'IBRAHIM BIN KADIR', 55, 'M', 'A104', 'Patient must avoid all seafood due to allergies. ', 'Seafood', '690718624815'),
('SY5168', 'NOR FARZANAA BINTI NAIM', 34, 'F', 'D201', 'Patient must avoid all soy products.', 'Soy', '900608098642'),
('SY6319', 'HARITH ISKANDAR BIN NASIR', 32, 'M', 'D501', 'Patient must avoid all soy products.', 'Soy', '921221018047'),
('SY8364', 'PARAM NAVEENDRAN', 34, 'M', 'D502', 'Patient must avoid all soy products.', 'Soy', '9003178261'),
('XX4701', 'LIM WEI XUAN', 37, 'M', 'D208', 'No dietary restrictions required.', '', '870608050012'),
('XX9064', 'DAVID ARUMUGEM', 59, 'M', 'A109', 'Diabetes, sugar free diet.', '', '650506060660');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `OrderID` int(6) NOT NULL,
  `PatientID` varchar(6) NOT NULL,
  `MealID` varchar(255) NOT NULL,
  `Date` date NOT NULL,
  `Status` enum('Delivered','Pending','Cancel') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`OrderID`, `PatientID`, `MealID`, `Date`, `Status`) VALUES
(1, 'EG9327', 'B001', '2024-09-27', 'Delivered'),
(2, 'EG9327', 'L003', '2024-09-27', 'Delivered'),
(3, 'EG9327', 'D009', '2024-09-27', 'Delivered'),
(4, 'SF8042', 'B005', '2024-09-29', 'Delivered'),
(4, 'SF8042', 'W02', '2024-09-29', 'Delivered'),
(5, 'SF8042', 'L005', '2024-09-29', 'Delivered'),
(6, 'SF8042', 'D001', '2024-09-29', 'Delivered'),
(7, 'SF8042', 'B007', '2024-09-30', 'Delivered'),
(8, 'SF8042', 'L009', '2024-09-30', 'Delivered'),
(9, 'SF8042', 'D010', '2024-09-30', 'Delivered'),
(10, 'SF8042', 'B003', '2024-10-01', 'Delivered'),
(10, 'SF8042', 'W01', '2024-10-01', 'Delivered'),
(11, 'SF8042', 'L003', '2024-10-01', 'Delivered'),
(12, 'SF8042', 'D008', '2024-10-01', 'Delivered'),
(13, 'DI4179', 'B003', '2024-09-13', 'Delivered'),
(14, 'DI4179', 'L006', '2024-09-13', 'Delivered'),
(15, 'DI4179', 'D007', '2024-09-13', 'Delivered'),
(15, 'DI4179', 'W06', '2024-09-13', 'Delivered'),
(14, 'DI4179', 'W09', '2024-09-13', 'Delivered'),
(16, 'DI4179', 'B008', '2024-09-14', 'Delivered'),
(17, 'DI4179', 'L007', '2024-09-14', 'Delivered'),
(18, 'DI4179', 'D004', '2024-09-14', 'Delivered'),
(19, 'XX4701', 'B006', '2024-10-10', 'Delivered'),
(20, 'XX4701', 'L003', '2024-10-10', 'Delivered'),
(21, 'XX4701', 'D003', '2024-10-10', 'Delivered'),
(19, 'XX4701', 'W05', '2024-10-10', 'Delivered'),
(20, 'XX4701', 'W07', '2024-10-10', 'Delivered'),
(22, 'GL9126', 'B003', '2024-10-16', 'Delivered'),
(23, 'GL9126', 'L004', '2024-10-16', 'Delivered'),
(24, 'GL9126', 'D007', '2024-10-16', 'Delivered'),
(0, 'DI3174', 'B004', '2024-10-13', 'Pending'),
(0, 'DI3174', 'B007', '2024-10-13', 'Pending'),
(0, 'DI3174', 'L002', '2024-10-13', 'Pending'),
(0, 'DI3174', 'D008', '2024-10-13', 'Pending'),
(0, 'GL9126', 'L009', '2024-10-13', 'Pending');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breakfast`
--
ALTER TABLE `breakfast`
  ADD PRIMARY KEY (`MealID`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `fk_user` (`MealID`);

--
-- Indexes for table `dinner`
--
ALTER TABLE `dinner`
  ADD PRIMARY KEY (`MealID`);

--
-- Indexes for table `drink`
--
ALTER TABLE `drink`
  ADD PRIMARY KEY (`MealID`);

--
-- Indexes for table `lunch`
--
ALTER TABLE `lunch`
  ADD PRIMARY KEY (`MealID`);

--
-- Indexes for table `meal`
--
ALTER TABLE `meal`
  ADD PRIMARY KEY (`MealID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PatientID`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `MealIDs` (`MealID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cartID` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`MealID`) REFERENCES `meal` (`MealID`);

--
-- Constraints for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD CONSTRAINT `tblorder_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patient` (`PatientID`),
  ADD CONSTRAINT `tblorder_ibfk_2` FOREIGN KEY (`MealID`) REFERENCES `meal` (`MealID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
