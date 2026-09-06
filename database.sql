-- ==========================================================================
-- DIGITAL RECIPE BOOK - DATABASE SCHEMA (MySQL)
-- Course: ICT 1209 - Web Technologies (Rajarata University of Sri Lanka)
-- Database Name: recipe_book
-- ==========================================================================

CREATE DATABASE IF NOT EXISTS `recipe_book` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `recipe_book`;

-- --------------------------------------------------------
-- 1. USERS TABLE (User Authentication)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(50) NOT NULL UNIQUE,
  `email` VARCHAR(100) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL, -- BCRYPT Hashed Password
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 2. MESSAGES TABLE (Contact Form Queries)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `messages`;
CREATE TABLE `messages` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `message` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- 3. RECIPES TABLE (Theme-Specific Recipe App Table)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `recipes`;
CREATE TABLE `recipes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `title` VARCHAR(150) NOT NULL,
  `category` VARCHAR(50) NOT NULL,
  `prep_time` VARCHAR(30) NOT NULL,
  `rating` DECIMAL(3,1) DEFAULT 4.5,
  `reviews` INT(11) DEFAULT 10,
  `ingredients` TEXT NOT NULL,
  `instructions` TEXT NOT NULL,
  `image` VARCHAR(255) DEFAULT 'assets/images/hero_pasta_dish.jpg',
  `user_id` INT(11) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_recipes_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- SAMPLE INITIAL DATA FOR RECIPES
-- --------------------------------------------------------
INSERT INTO `recipes` (`title`, `category`, `prep_time`, `rating`, `reviews`, `ingredients`, `instructions`, `image`) VALUES
('Fluffy Pancakes', 'Breakfast', '15 mins', 4.6, 120, '1 1/2 cups flour, 3 1/2 tsp baking powder, 1 tbsp sugar, 1 1/4 cups milk, 1 egg, 3 tbsp melted butter', 'Mix dry ingredients. Add milk, egg, and melted butter. Cook on hot griddle until bubbles form, then flip.', 'assets/images/fluffy_pancakes.jpg'),
('Chicken Biriyani', 'Lunch', '45 mins', 4.8, 98, '500g Basmati rice, 700g Chicken, 1 cup Yogurt, 2 Onions fried, Biryani spices', 'Marinate chicken in spices and yogurt. Parboil rice. Layer chicken and rice together and cook on dum low heat for 25 mins.', 'assets/images/chicken_biryani.jpg'),
('Spaghetti Carbonara', 'Dinner', '25 mins', 4.5, 76, '400g Spaghetti, 150g Pancetta/Bacon, 4 Egg yolks, 1 cup Pecorino cheese, Black pepper', 'Boil spaghetti. Crisp pancetta in a skillet. Mix egg yolks with cheese. Toss hot pasta into pancetta and mix in egg sauce.', 'assets/images/spaghetti_carbonara.jpg'),
('Chocolate Cake', 'Dessert', '50 mins', 4.7, 64, '2 cups sugar, 1 3/4 cups flour, 3/4 cup cocoa powder, 2 eggs, 1 cup milk, 1/2 cup oil', 'Mix dry ingredients. Add eggs, milk, oil, and vanilla. Stir in boiling water. Bake at 350F for 35 mins.', 'assets/images/chocolate_cake.jpg'),
('Veggie Stir Fry', 'Snacks', '20 mins', 4.4, 52, '1 cup broccoli, 1 bell pepper, 1 cup snap peas, 3 tbsp soy sauce, 1 tbsp sesame oil', 'Stir-fry garlic and vegetables in sesame oil over high heat. Add soy sauce and serve warm.', 'assets/images/veggie_stir_fry.jpg');
