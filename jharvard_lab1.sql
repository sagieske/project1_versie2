-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 30, 2012 at 08:37 AM
-- Server version: 5.5.27
-- PHP Version: 5.3.16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jharvard_lab1`
--

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE IF NOT EXISTS `favorites` (
  `recipeID` int(10) NOT NULL,
  `userID` int(10) NOT NULL,
  `username` varchar(20) NOT NULL,
  PRIMARY KEY (`recipeID`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`recipeID`, `userID`, `username`) VALUES
(4, 12, 'example');

-- --------------------------------------------------------

--
-- Table structure for table `ratings`
--

CREATE TABLE IF NOT EXISTS `ratings` (
  `username` varchar(50) COLLATE ascii_bin NOT NULL,
  `recipeID` int(10) NOT NULL,
  `rating` int(1) NOT NULL,
  `id` int(10) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=11 ;

--
-- Dumping data for table `ratings`
--

INSERT INTO `ratings` (`username`, `recipeID`, `rating`, `id`) VALUES
('example', 4, 7, 10);

-- --------------------------------------------------------

--
-- Table structure for table `recently_viewed`
--

CREATE TABLE IF NOT EXISTS `recently_viewed` (
  `recipeID` int(20) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `username` varchar(20) COLLATE ascii_bin NOT NULL,
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=ascii COLLATE=ascii_bin;

--
-- Dumping data for table `recently_viewed`
--

INSERT INTO `recently_viewed` (`recipeID`, `time`, `username`) VALUES
(4, '2012-11-30 13:36:13', 'example');

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE IF NOT EXISTS `recipes` (
  `recipeID` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(256) COLLATE ascii_bin NOT NULL,
  `description` text COLLATE ascii_bin NOT NULL,
  `time` int(4) NOT NULL,
  `yield` int(2) NOT NULL,
  `ingredients` text COLLATE ascii_bin NOT NULL,
  `procedure` text COLLATE ascii_bin NOT NULL,
  PRIMARY KEY (`recipeID`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=15 ;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`recipeID`, `name`, `description`, `time`, `yield`, `ingredients`, `procedure`) VALUES
(1, 'Omelette', 'Pancake but with eggs.', 5, 2, '4 eggs', 'Bake eggs'),
(2, 'Rice', 'Delicious.', 15, 5, 'Lots of rice\r\nSome salt\r\nWater', 'Pour water on rice and cook. Scream at rice to become yummy.'),
(4, 'Jen''s Chorizo Pasta', 'Main Course. Pasta. Italian', 50, 6, ' (4 ounce) links chorizo sausage (such as Johnsonville?)\r\n \r\n 1 (16 ounce) box penne pasta\r\n \r\n 1 cup butter\r\n 4 cloves garlic, minced\r\n 1 cup heavy whipping cream\r\n0.25 1 cup grated Parmesan cheese\r\n \r\n 1 tablespoon butter\r\n 1 onion, sliced\r\n 1 red bell pepper, sliced\r\n 1 (8 ounce) package button mushrooms, stems trimmed\r\n salt and pepper to taste', 'Preheat an outdoor grill for medium heat, and lightly oil the grate.\r\nCook the sausages on the preheated grill, turning occasionally, until no longer pink in the center, about 10 minutes. An instant-read thermometer inserted into the center should read 160 degrees F (70 degrees C). Cut into bite sized pieces; set aside.\r\nFill a large pot with lightly salted water and bring to a rolling boil over high heat. Once the water is boiling, stir in the penne, and return to a boil. Cook the pasta uncovered, stirring occasionally, until the pasta has cooked through, but is still firm to the bite, about 11 minutes. Drain well in a colander set in the sink.\r\nMeanwhile, melt 1 cup of butter in a saucepan over medium heat. Stir in the garlic, and cook until softened and fragrant, about 5 minutes. Stir in the cream and red pepper flakes; bring to a simmer over medium-high heat, and whisk in the Parmesan cheese until melted. Keep warm over low heat, stirring occasionally to keep smooth.\r\nMelt the remaining 1 tablespoon of butter in a large skillet over medium-high heat. Stir in the onion, red bell pepper, and mushrooms. Cook and stir until the vegetables are tender. Once tender, stir in the chorizo pieces, and cook until hot. Combine with the penne pasta and Parmesan cream sauce to serve.'),
(5, 'Garlic Sausage and Pasta in a Bechamel Sauce', 'Main Dish.  Italian', 40, 8, '0.5 cup butter\r\n1 cup all-purpose flour\r\nsalt to taste\r\nwhite pepper to taste\r\n4 cups milk\r\n1 (16 ounce) package corkscrew-shaped pasta (fusilli)\r\n2 egg yolks\r\n0.25 teaspoon ground nutmeg\r\n1 (12 ounce) package garlic chicken sausage', '1.Melt butter in a small saucepan over medium-low heat; whisk flour into the melted butter until dissolved, 5 to 10 minutes. Season with salt and white pepper. Pour milk into the flour mixture; cook and stir until sauce is smooth and thickened, 10 to 15 minutes.\r\n2.Bring a large pot of lightly salted water to a boil. Cook pasta in the boiling water, stirring occasionally until cooked through but firm to the bite, 12 minutes. Drain and transfer to a serving bowl.\r\n3.Remove sauce from heat and stir in egg yolks and nutmeg until well incorporated. Pour sauce over pasta; toss to coat.\r\n4.Cook and stir sausage in a skillet over medium heat until browned and cooked through, 5 to 10 minutes. Stir sausage into pasta; season with salt and white pepper.'),
(6, 'Jen''s Chorizo Pasta', 'Main Course. Pasta. Italian', 50, 6, ' (4 ounce) links chorizo sausage\r\n 1 (16 ounce) box penne pasta\r\n \r\n 1 cup butter\r\n 4 cloves garlic, minced\r\n 1 cup heavy whipping cream\r\n0.25 1 cup grated Parmesan cheese\r\n \r\n 1 tablespoon butter\r\n 1 onion, sliced\r\n 1 red bell pepper, sliced\r\n 1 (8 ounce) package button mushrooms, stems trimmed\r\n salt and pepper to taste', 'Preheat an outdoor grill for medium heat, and lightly oil the grate.\r\nCook the sausages on the preheated grill, turning occasionally, until no longer pink in the center, about 10 minutes. An instant-read thermometer inserted into the center should read 160 degrees F (70 degrees C). Cut into bite sized pieces; set aside.\r\nFill a large pot with lightly salted water and bring to a rolling boil over high heat. Once the water is boiling, stir in the penne, and return to a boil. Cook the pasta uncovered, stirring occasionally, until the pasta has cooked through, but is still firm to the bite, about 11 minutes. Drain well in a colander set in the sink.\r\nMeanwhile, melt 1 cup of butter in a saucepan over medium heat. Stir in the garlic, and cook until softened and fragrant, about 5 minutes. Stir in the cream and red pepper flakes; bring to a simmer over medium-high heat, and whisk in the Parmesan cheese until melted. Keep warm over low heat, stirring occasionally to keep smooth.\r\nMelt the remaining 1 tablespoon of butter in a large skillet over medium-high heat. Stir in the onion, red bell pepper, and mushrooms. Cook and stir until the vegetables are tender. Once tender, stir in the chorizo pieces, and cook until hot. Combine with the penne pasta and Parmesan cream sauce to serve.'),
(7, 'Scallop and Chorizo Pasta', 'Main Course. Italian', 40, 8, '1 (8 ounce) package uncooked linguine pasta\r\n 4 teaspoons olive oil, divided\r\n 6 ounces chorizo sausage, cut into chunks\r\n 1 pound scallops\r\n salt and ground black pepper to taste\r\n cayenne pepper to taste\r\n 1 green bell pepper, julienned\r\n 1 red bell pepper, julienned\r\n 1 yellow bell pepper, julienned\r\n 1 tablespoon minced garlic\r\n 1 cup dry white wine\r\n 1 cup clam juice', 'Bring a large pot of lightly salted water to a boil, and cook the linguine 8 to 10 minutes or until al dente; drain.\r\nHeat 1 teaspoon olive oil in a skillet over high heat, and cook and stir the chorizo sausage 2-3 minutes, until evenly browned. Set aside the sausage, and wipe the skillet. Heat 1 teaspoon olive oil, and toss in the scallops. Season with salt, pepper, and cayenne, and cook and stir about 3 minutes, until opaque and lightly browned. Set aside. Wipe the skillet, and heat another 1 teaspoon olive oil over medium heat. Cook and stir the green bell pepper, red bell pepper, and yellow bell pepper until tender. Remove from heat, and set aside.\r\nHeat the remaining olive oil in the skillet over medium high heat, and cook and stir the garlic until tender. Pour in the wine, and bring to a boil. Cook until most of the wine has been reduced, and scrape the browned bits from the bottom of the skillet. Mix in the clam juice, bring to a boil, and cook until reduced by about0.5. Return the chorizo, scallops, and peppers to the skillet, and toss until coated. Serve over the cooked linguine.'),
(8, 'Grandma Ople''s Apple Pie ', 'Desert.', 60, 12, '1 recipe pastry for a 9 inch double crust pie\r\n0.5 cup unsalted butter\r\n 3 tablespoons all-purpose flour\r\n0.5 cup white sugar\r\n0.5 cup packed brown sugar\r\n0.25 cup water\r\n 8 Granny Smith apples - peeled, cored and sliced', 'Melt butter in a sauce pan. Stir in flour to form a paste. Add white sugar, brown sugar and water; bring to a boil. Reduce temperature, and simmer 5 minutes.\r\nMeanwhile, place the bottom crust in your pan. Fill with apples, mounded slightly. Cover with a lattice work crust. Gently pour the sugar and butter liquid over the crust. Pour slowly so that it does not run off.\r\nBake 15 minutes at 425 degrees F (220 degrees C). Reduce the temperature to 350 degrees F (175 degrees C), and continue baking for 35 to 45 minutes.'),
(9, 'Aunt Carol''s Apple Pie Aunt Carol''s Apple Pie ', 'Desert.', 60, 12, '2 pounds Granny Smith apples\r\n 1 cup white sugar\r\n0.5 cup brown sugar\r\n 2 teaspoons ground cinnamon\r\n0.5 cup all-purpose flour\r\n 2 tablespoons butter\r\n 1 tablespoon white sugar\r\n 1 recipe pastry for a 9 inch double crust pie', 'Peel and slice apples. Toss with sugars, cinnamon and flour. Set aside.\r\nRoll crust to make slightly larger to fit 10-inch glass pie pan. Fit bottom crust in pie pan. Turn in apple mixture and dot with butter. Put crust on top and crimp edges of crust together.\r\nWet hands with water and dampen top of pie. Sprinkle with additional sugar. Puncture top of pie with fork so pie will vent.\r\nBake for 15 minutes at 450 degrees F (230 degrees C), reduce heat to 350 degrees F (175 degrees C) and continue baking for about 45 minutes more, until crust is golden brown. It''s a good practice to place a piece of aluminum foil slightly larger than the pie under the pie plate to catch overflows. Serve warm.'),
(10, 'Jamie''s Cranberry Spinach Salad', 'Salad.', 20, 8, '1 tablespoon butter\r\n0.75 cup almonds, blanched and slivered\r\n 1 pound spinach, rinsed and torn into bite-size pieces\r\n 1 cup dried cranberries\r\n 2 tablespoons toasted sesame seeds\r\n 1 tablespoon poppy seeds\r\n0.5 cup white sugar\r\n 2 teaspoons minced onion\r\n0.25 teaspoon paprika\r\n0.25 cup white wine vinegar\r\n0.25 cup cider vinegar\r\n0.5 cup vegetable oil', 'In a medium saucepan, melt butter over medium heat. Cook and stir almonds in butter until lightly toasted. Remove from heat, and let cool.\r\nIn a medium bowl, whisk together the sesame seeds, poppy seeds, sugar, onion, paprika, white wine vinegar, cider vinegar, and vegetable oil. Toss with spinach just before serving.\r\nIn a large bowl, combine the spinach with the toasted almonds and cranberries.'),
(11, 'Spinach and Strawberry Salad', 'Salad.', 10, 8, '2 bunches spinach, rinsed and torn into bite-size pieces\r\n 4 cups sliced strawberries\r\n0.5 cup vegetable oil\r\n0.5 cup white wine vinegar\r\n0.5 cup white sugar\r\n0.75 teaspoon paprika\r\n 2 tablespoons sesame seeds\r\n 1 tablespoon poppy seeds', 'In a large bowl, toss together the spinach and strawberries.\r\nIn a medium bowl, whisk together the oil, vinegar, sugar, paprika, sesame seeds, and poppy seeds. Pour over the spinach and strawberries, and toss to coat.'),
(12, 'Strawberry Soup I', 'Desert.', 10, 4, '2 pints strawberries\r\n 2 cups plain yogurt\r\n0.5 cup orange juice\r\n0.5 cup white sugar\r\n0.5 cup water\r\n0.2 teaspoon ground cardamom', 'In a blender, combine the strawberries, yogurt, orange juice, sugar, water and cardamom. Puree until well mixed. Chill and serve.'),
(13, 'Peachy Ginger Soup Peachy Ginger Soup Peachy Ginger Soup Peachy Ginger Soup Peachy Ginger Soup ', 'Desert.', 10, 4, '3 pounds fresh peaches - peeled, pitted and chopped\r\n 1 teaspoon ground ginger\r\n 1cups heavy cream\r\n 2 tablespoons rum', 'Puree the peaches and ginger together in a food processor or blender. Stir in heavy cream and rum. Chill. Serve col'),
(14, 'Garlic Soup Garlic Soup ', 'Soup.', 30, 6, '1 cup crushed garlic\r\n 2 tablespoons butter\r\n 6 cups water\r\n 1 tablespoon chicken bouillon granules\r\n0.25 cup chopped fresh tomato\r\n 3 eggs, beaten\r\n salt and pepper to taste', 'In a large pot over medium heat, cook garlic in butter until brown. Pour in water and bring to a boil. Stir in bouillon granules, reduce heat and simmer a minimum of 20 minutes. Stir in tomatoes, whisk in eggs and season with salt and pepper just before serving.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(20) COLLATE ascii_bin NOT NULL,
  `password` varchar(100) COLLATE ascii_bin NOT NULL,
  `identifier` int(3) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`username`),
  UNIQUE KEY `identifier` (`identifier`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=ascii COLLATE=ascii_bin AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `identifier`) VALUES
('example', '5f4dcc3b5aa765d61d8327deb882cf99', 12);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
