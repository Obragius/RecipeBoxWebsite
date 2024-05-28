-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 21, 2024 at 03:30 PM
-- Server version: 5.7.32-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_k1801606`
--

-- --------------------------------------------------------

--
-- Table structure for table `Account`
--

CREATE TABLE `Account` (
  `accountID` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `addressID` int(11) NOT NULL,
  `telephone` varchar(13) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(512) DEFAULT NULL,
  `isAdmin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Account`
--

INSERT INTO `Account` (`accountID`, `firstname`, `surname`, `addressID`, `telephone`, `username`, `password`, `isAdmin`) VALUES
(8, 'Jacob', 'Surrey', 40, '573483857', 'BigJacob', '$2y$10$3IOH3J5bXd5IIJK3NWv6Y.3TH/LHdjCH9KTzNXB.Wh9hcPUFQ6vti', NULL),
(9, 'Faith', 'Norman', 41, '573485744', 'Faith', '$2y$10$O5nTmuapN9xHIVBYFby/BOyDQ/p/rKFVPKRNnLynIh6t3TKqXqqd6', NULL),
(10, '-', '-', 42, '0', 'Admin', '$2y$10$fCVFE0NqOTdUoFutV0Wo6O81bA0lOk6mQoclRAAqM/RE85VZIBOSO', 1),
(11, 'Reave', 'Smith', 43, '5738574983', 'Foodie', '$2y$10$e2wX.tavS5QUsG6MOn173OdCPNEFlJpiQ5yQ3sLu/J3jl5WyKV2/O', 1),
(17, 'James', 'Adams', 50, '5739474732', NULL, NULL, NULL),
(18, 'Harry', 'Vahru', 51, '29522280', 'HariVah', '$2y$10$UC30ZkqNZ.6MdHihGByryeTBTHhEGhbmttG0yunZu15e1Faix.lZm', NULL),
(19, 'bums', 'bums', 52, '745', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `AccountView`
-- (See below for the actual view)
--
CREATE TABLE `AccountView` (
`accountID` int(11)
,`firstname` varchar(50)
,`surname` varchar(50)
,`telephone` varchar(13)
,`username` varchar(50)
,`password` varchar(512)
,`isAdmin` int(1)
,`lineOne` varchar(50)
,`lineTwo` varchar(50)
,`postcode` varchar(10)
,`town` varchar(50)
,`city` varchar(50)
,`country` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `Address`
--

CREATE TABLE `Address` (
  `addressID` int(11) NOT NULL,
  `lineOne` varchar(50) NOT NULL,
  `lineTwo` varchar(50) DEFAULT NULL,
  `postcode` varchar(10) NOT NULL,
  `town` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Address`
--

INSERT INTO `Address` (`addressID`, `lineOne`, `lineTwo`, `postcode`, `town`, `city`, `country`) VALUES
(40, '20 Amazing street', '30 Good House', 'GG 2WP', 'Big', 'Small', 'Kingston University'),
(41, '47284 Roll', '2 Jump', 'BB2 3DQ', 'Tawn', 'Caty', 'Countri'),
(42, '-', '-', '-', '-', '-', '-'),
(43, '30 Ice Cream Street', '20 Chococlate House', 'TRD 23', 'Wandsworth', 'London', 'United Kingdom'),
(50, '55 Cold Avenue', '1 Panorama House', 'JJ7 453', 'Leeds', 'Leeds', 'United Kingdom'),
(51, 'Idk 68', 'Idk 69', '1019', '', 'Riga', 'Latvia'),
(52, 'bums', 'bums', 'bums', 'bums', 'bums', 'bums');

-- --------------------------------------------------------

--
-- Table structure for table `Basket`
--

CREATE TABLE `Basket` (
  `accountID` int(11) NOT NULL,
  `recipeID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Food`
--

CREATE TABLE `Food` (
  `foodID` int(11) NOT NULL,
  `foodName` varchar(50) NOT NULL,
  `foodTag` varchar(2048) NOT NULL,
  `foodCost` int(10) NOT NULL,
  `foodDescription` varchar(4096) DEFAULT NULL,
  `foodUnit` varchar(50) DEFAULT NULL,
  `calories` int(11) DEFAULT NULL,
  `carbohydrates` int(11) DEFAULT NULL,
  `protein` int(11) DEFAULT NULL,
  `fat` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Food`
--

INSERT INTO `Food` (`foodID`, `foodName`, `foodTag`, `foodCost`, `foodDescription`, `foodUnit`, `calories`, `carbohydrates`, `protein`, `fat`) VALUES
(37, 'Pasta (500g)', '', 100, 'Pasta is a type of food typically made from an unleavened dough of wheat flour mixed with water or eggs, and formed into sheets or other shapes, then cooked by boiling or baking', 'g', 153, 30, 5, 0),
(38, 'Pork Sausage', 'Meat,Sausage,Pork', 25, 'A sausage is a type of meat product usually made from ground meat&mdash;often pork, beef, or poultry&mdash;along with salt, spices and other flavourings. Other ingredients, such as grains or breadcrumbs may be included as fillers or extenders.  ', 'g', 131, 3, 0, 9),
(39, 'Sliced Mushrooms(250g)', '', 110, 'A mushroom or toadstool is the fleshy, spore-bearing fruiting body of a fungus, typically produced above ground, on soil, or on its food source.', 'g', 0, 0, 1, 0),
(40, 'Tomato Sauce(500g)', '', 80, 'In cooking, a sauce is a liquid, cream, or semi-solid food, served on or used in preparing other foods. Most sauces are not normally consumed by themselves; they add flavor, moisture, and visual appeal to a dish.', 'g', 320, 5, 1, 0),
(41, 'Grated Cheese(100)', 'Cheese', 150, 'Cheese is a dairy product produced in wide ranges of flavors, textures, and forms by coagulation of the milk protein casein.', 'g', 390, 18, 0, 29),
(43, 'Kiwi', 'Fruit', 30, 'Edible berry of several species of woody vines in the genus Actinidia.', 'g', 81, 18, 1, 0),
(44, 'Mango', 'Fruit', 85, 'A mango is an edible stone fruit produced by the tropical tree Mangifera indica.', 'g', 45, 10, 1, 0),
(46, 'Strawberries(kg)', 'Berrie', 739, 'Widely grown hybrid species of the genus Fragaria, collectively known as the strawberries. ', 'kg', 27, 6, 0, 0),
(47, 'Onion(kg)', 'Vegetable', 100, 'An onion (Allium cepa L., from Latin cepa meaning &quot;onion&quot;), also known as the bulb onion or common onion, is a vegetable that is the most widely cultivated species of the genus Allium.', 'kg', 39, 8, 1, 0),
(48, 'Garlic', '', 33, 'Garlic (Allium sativum) is a species of bulbous flowering plant in the genus Allium. Its close relatives include the onion, shallot, leek, chive,[2] Welsh onion and Chinese onion.', 'g', 11, 1, 0, 0),
(49, 'Vegetable Oil(100ml)', 'Oil', 20, 'Vegetable oils, or vegetable fats, are oils extracted from seeds or from other parts of fruits. Like animal fats, vegetable fats are mixtures of triglycerides.', 'ml', 0, 0, 0, 0),
(50, 'Chicken(kg)', 'Meat,Chicken', 900, 'The chicken (Gallus gallus domesticus) is a domesticated junglefowl species, with attributes of wild species such as the grey and the Ceylon junglefowl.', 'kg', 0, 0, 0, 0),
(51, 'Rice(kg)', 'Rice', 175, 'Rice is the seed of the grass species Oryza sativa (Asian rice) or less commonly O. glaberrima (African rice). The name wild rice is usually used for species of the genera Zizania and Porteresia, both wild and domesticated, although the term may also be used for primitive or uncultivated varieties of Oryza.', 'kg', 0, 0, 0, 0),
(54, 'Red Chili', 'Spicy', 50, 'Chili peppers (also chile, chile pepper, chilli pepper, or chilli[3]), from Nahuatl chÄ«lli (Nahuatl pronunciation: [ËˆtÍ¡ÊƒiËlËi] (listen)), are varieties of the berry-fruit of plants from the genus Capsicum, which are members of the nightshade family Solanaceae, cultivated for their pungency.', 'g', 0, 0, 0, 0),
(55, 'Peanut Butter(100g)', '', 1380, 'Peanut butter is a food paste or spread made from ground, dry-roasted peanuts. It commonly contains additional ingredients that modify the taste or texture, such as salt, sweeteners, or emulsifiers. ', 'kg', 0, 0, 0, 0),
(56, 'Coconut Milk(400ml)', 'Milk', 100, 'Coconut milk is an opaque, milky-white liquid extracted from the grated pulp of mature coconuts.[1] The opacity and rich taste of coconut milk are due to its high oil content, most of which is saturated fat.', 'ml', 0, 0, 0, 0),
(57, 'Roasted Peanuts(kg)', 'Peanuts', 1024, 'The peanut (Arachis hypogaea), also known as the groundnut,[2] goober (US),[3] pindar (US)[3] or monkey nut (UK), is a legume crop grown mainly for its edible seeds.', 'kg', 0, 0, 0, 0),
(58, 'Pizza Dough', '', 260, 'Made with flour high in protein for super stretchy dough that will create light and crisp pizzas perfect for your favourite toppings, and olive oil for a rich flavoured crust. Simply roll and create anything from a classic Margherita with juicy tomato sauce and\r\ncreamy mozzarella, to dough sticks for dipping or calzones for stuffing.', 'g', 0, 0, 0, 0),
(59, 'Mozzarella Cheese(240g)', 'Cheese', 100, 'Cheeeeeeeeeeeeeeeese', 'g', 0, 0, 0, 0),
(60, 'Tomato Sauce(310g)', '', 240, 'Tomato sauce, it is red', 'g', 0, 0, 0, 0),
(61, 'Cherry Tomatoes(kg)', 'Vegetable', 303, 'Cherry tomatoes, they are also red', 'kg', 0, 0, 0, 0),
(62, 'Cabbage', 'Vegetable', 40, 'It is a green thing', 'g', 0, 0, 0, 0),
(63, 'Carrots(kg)', 'Vegetable', 50, 'An orange thingy', 'kg', 0, 0, 0, 0),
(64, 'Red Onion', 'Vegetable', 33, 'A purple thing called red', 'g', 0, 0, 0, 0),
(65, 'Paprika(kg)', '', 5000, 'It is a spice', 'kg', 0, 0, 0, 0),
(66, 'Mayonnaise(100g)', '', 52, 'It is a white sauce', 'g', 0, 0, 0, 0),
(67, 'Egg', 'Dairy', 28, 'A thing chickens tend to lose', 'g', 0, 0, 0, 0),
(68, 'Sweet Potatoes', '', 39, 'It is like a potato, but sweet', 'g', 0, 0, 0, 0),
(69, 'Lime', '', 24, 'A green lemon, but not really', 'g', 0, 0, 0, 0),
(70, 'Salmon(230g)', 'Fish', 500, 'A fish that I enjoy in sushi', 'g', 0, 0, 0, 0),
(71, 'Broccoli(kg)', 'Vegetable', 192, 'A mini tree that you can eat', 'kg', 0, 0, 0, 0),
(72, 'Noodles(340g)', 'Noodles', 250, 'A nice addition to your meal', 'g', 0, 0, 0, 0),
(73, 'Peperoni(100g)', 'Meat', 2670, 'A nice addition to a pizza ', 'kg', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `FoodList`
--

CREATE TABLE `FoodList` (
  `recipeID` int(11) NOT NULL,
  `foodID` int(11) NOT NULL,
  `count` int(5) DEFAULT NULL,
  `amount` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `FoodList`
--

INSERT INTO `FoodList` (`recipeID`, `foodID`, `count`, `amount`) VALUES
(64, 37, 1, 0),
(64, 38, 4, 0),
(64, 39, 1, 0),
(64, 40, 1, 0),
(64, 41, 1, 0),
(75, 43, 2, 0),
(75, 44, 1, 0),
(75, 46, 0, 400),
(78, 47, 0, 100),
(78, 48, 1, 0),
(78, 49, 0, 100),
(78, 50, 0, 700),
(78, 51, 0, 500),
(82, 47, 0, 100),
(82, 48, 3, 0),
(82, 50, 0, 800),
(82, 54, 2, 0),
(82, 55, 0, 100),
(82, 56, 1, 0),
(83, 48, 1, 0),
(83, 58, 1, 0),
(83, 59, 1, 0),
(83, 60, 1, 0),
(83, 61, 0, 200),
(84, 62, 1, 0),
(84, 63, 0, 300),
(84, 64, 1, 0),
(84, 65, 0, 50),
(84, 66, 0, 500),
(85, 51, 0, 500),
(85, 67, 4, 0),
(87, 68, 2, 0),
(87, 69, 1, 0),
(87, 70, 1, 0),
(87, 71, 0, 250),
(89, 48, 3, 0),
(89, 50, 0, 225),
(89, 54, 1, 0),
(89, 69, 1, 0),
(89, 71, 0, 175),
(89, 72, 2, 0),
(90, 48, 1, 0),
(90, 58, 1, 0),
(90, 59, 1, 0),
(90, 60, 1, 0),
(90, 61, 0, 300),
(90, 73, 0, 50),
(92, 47, 0, 150),
(92, 50, 0, 300),
(92, 51, 0, 500),
(93, 48, 2, 0),
(93, 51, 0, 500),
(93, 54, 1, 0),
(93, 57, 0, 50),
(93, 64, 1, 0),
(93, 65, 0, 20),
(93, 71, 0, 200);

-- --------------------------------------------------------

--
-- Table structure for table `Invoice`
--

CREATE TABLE `Invoice` (
  `invoiceID` int(11) NOT NULL,
  `paymentMethod` varchar(50) NOT NULL,
  `invoiceDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `OrderHistory`
--

CREATE TABLE `OrderHistory` (
  `accountID` int(11) NOT NULL,
  `orderID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `OrderHistory`
--

INSERT INTO `OrderHistory` (`accountID`, `orderID`) VALUES
(9, 42),
(9, 43),
(9, 44),
(9, 46),
(17, 45),
(19, 47),
(19, 48),
(19, 49);

-- --------------------------------------------------------

--
-- Table structure for table `Orders`
--

CREATE TABLE `Orders` (
  `orderID` int(11) NOT NULL,
  `deliveryAddress` int(11) NOT NULL,
  `orderDate` varchar(11) NOT NULL,
  `recipeID` int(11) NOT NULL,
  `invoiceID` int(11) DEFAULT NULL,
  `Quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Orders`
--

INSERT INTO `Orders` (`orderID`, `deliveryAddress`, `orderDate`, `recipeID`, `invoiceID`, `Quantity`) VALUES
(42, 41, '29/03/2023', 83, NULL, 1),
(43, 41, '29/03/2023', 75, NULL, 2),
(44, 41, '29/03/2023', 85, NULL, 1),
(45, 50, '30/03/2023', 90, NULL, 2),
(46, 41, '30/03/2023', 82, NULL, 1),
(47, 52, '04/04/2023', 85, NULL, 1),
(48, 52, '04/04/2023', 92, NULL, 1),
(49, 52, '04/04/2023', 82, NULL, 1);

-- --------------------------------------------------------

--
-- Stand-in structure for view `OrderView`
-- (See below for the actual view)
--
CREATE TABLE `OrderView` (
`firstname` varchar(50)
,`surname` varchar(50)
,`addressID` int(11)
,`telephone` varchar(13)
,`lineOne` varchar(50)
,`lineTwo` varchar(50)
,`postcode` varchar(10)
,`town` varchar(50)
,`city` varchar(50)
,`country` varchar(50)
,`orderDate` varchar(11)
,`RecipeTitle` varchar(50)
,`invoiceID` int(11)
,`Quantity` int(11)
);

-- --------------------------------------------------------

--
-- Table structure for table `Recipe`
--

CREATE TABLE `Recipe` (
  `recipeID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(2048) NOT NULL,
  `steps` text NOT NULL,
  `image` varchar(500) DEFAULT NULL,
  `recipeAddedCost` int(11) NOT NULL DEFAULT '0',
  `recipeTags` varchar(2048) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Recipe`
--

INSERT INTO `Recipe` (`recipeID`, `title`, `description`, `steps`, `image`, `recipeAddedCost`, `recipeTags`) VALUES
(64, 'Sausage Bolognese', 'Pasta, sauce, and sausages, what could be a better combination? The sausage meat adds great flavour to a simple dish.', 'Heat a large, wide frying pan, then crumble in the sausage meat and fennel seeds (no need to add any oil). Fry for a few mins until golden and the fat is released, stirring well to break up the meat. Add the mushrooms and fry for a few mins until beginning to soften. Stir in the wine now, if using, bubble for 1 min, then add the tomato sauce and heat through until bubbling.+Meanwhile, boil the penne. When ready, drain and tip into the sauce. Mix well until completely coated, then divide between four plates, finishing with a little parmesan.', 'A Bowl Of Sausage Bolognese', 70, 'Italian,Meat,Sausage,Pork,Cheese'),
(75, 'Fruit Salad', 'Look for ripe, sweet-smelling fruit for this simple fruit salad with kiwi, mango, pineapple, grapes, orange and berries. It&amp;amp;rsquo;s a lovely, light summer dessert', 'Prepare the fruit with a small serrated knife. Cut the top and bottom off the kiwi, stand it up on one of its flat surfaces and cut away the skin, keeping the knife as close to the skin as possible. Slice in half, following the core through the centre, then cut each half into slices. Put in a bowl and repeat with the other kiwi.+Carefully cut the skin off the mango and slice off each cheek, running your knife as close to the stone as you can. Cut each piece into slices. Remove any remaining fruit from the stone in long thin slices. Add the mango to the kiwi.+Top and tail the pineapple, then in a similar way to the kiwi, cut away the skin. Use your knife to go around the pineapple, taking out the divets or eyes, two to three at a time, youâ€™ll be left with a spiral pattern weaving around the outside of the fruit. Take of a circular slice, roughly 150g, quarter, remove the core then cut into chunks. Add to the bowl.+Halve the grapes and add to the rest of the fruit along with the berries, you may want to slice or halve strawberries if theyâ€™re large. Remove the peel from the orange using the same method as the kiwi and pineapple. Holding the orange over the bowl of fruit, remove the orange segments by carefully cutting between the membrane and the fruit. The pieces should fall out into the bowl along with any juice. Squeeze the membrane over the fruit to extract the juice, add a drizzle of honey, if you like. Mix everything together and leave in the fridge to macerate for 30 mins, if you have time.', 'A bowl which contains a fruit salad', 150, 'Salad,Vegan,Vegeterian,Fruit,Berrie'),
(78, 'Chicken Madras', 'Ditch the takeaway menu and cook our healthy chicken madras curry instead. This simple family dinner is full of fragrant spices and tender pieces of chicken.', 'Blitz 1 quartered onion, 2 garlic cloves, a thumb-sized chunk of ginger and Â½ red chilli together in a food processor until it becomes a coarse paste.+Heat 1 tbsp vegetable oil in a large saucepan and add the paste, fry for 5 mins, until softened. If it starts to stick to the pan at all, add a splash of water.+Tip in Â½ tsp turmeric, 1 tsp ground cumin, 1 tsp ground coriander and 1-2 tsp hot chilli powder and stir well, cook for a couple of mins to toast them a bit, then add 4 chicken breasts, cut into chunks. Stir and make sure everything is covered in the spice mix.+Cook until the chicken begins to turn pale, adding a small splash of water if it sticks to the base of the pan at all.+Pour in 400g can chopped tomatoes, along with a big pinch of salt, cover and cook on a low heat for 30 mins, until the chicken is tender.', 'A bowl of chicken madras', 200, 'Indian,Vegetable,Oil,Meat,Chicken,Rice'),
(82, 'Peanut Butter Chicken', 'You\'ll love this new, budget chicken dish. Any leftovers freeze well and make a handy lunch.', 'Heat 1 tbsp of the oil in a deep frying pan over a medium heat. Brown the chicken in batches, setting aside once golden. Fry the onion for 8 minutes until softened. Then add the garlic, chilli and ginger and fry in the other 1 tbsp oil for 1 min. Add the garam masala and fry for 1 min more.+Stir in the peanut butter, coconut milk and tomatoes, and bring to a simmer. Return the chicken to the pan and add the chopped coriander. Cook for 30 mins until the sauce thickens and the chicken is cooked through.+Serve with the remaining coriander, roasted peanuts and rice, if you like.', 'A bowl of Peanut Butter Chicken', 200, 'Gluten-Free,Vegetable,Meat,Chicken,Spicy,Milk'),
(83, 'Pizza Margherita', 'Even a novice cook can master the art of pizza with our simple step-by-step guide. Bellissimo!', 'Make the base: Put the flour into a large bowl, then stir in the yeast and salt. Make a well, pour in 200ml warm water and the olive oil and bring together with a wooden spoon until you have a soft, fairly wet dough. Turn onto a lightly floured surface and knead for 5 mins until smooth. Cover with a tea towel and set aside. You can leave the dough to rise if you like, but itâ€™s not essential for a thin crust.+Make the sauce: Mix the passata, basil and crushed garlic together, then season to taste. Leave to stand at room temperature while you get on with shaping the base.+Roll out the dough: if youâ€™ve let the dough rise, give it a quick knead, then split into two balls. On a floured surface, roll out the dough into large rounds, about 25cm across, using a rolling pin. The dough needs to be very thin as it will rise in the oven. Lift the rounds onto two floured baking sheets.+Top and bake: heat the oven to 240C/220C fan/gas 8. Put another baking sheet or an upturned baking tray in the oven on the top shelf. Smooth sauce over bases with the back of a spoon. Scatter with cheese and tomatoes, drizzle with olive oil and season. Put one pizza, still on its baking sheet, on top of the preheated sheet or tray. Bake for 8-10 mins until crisp. Serve with a little more olive oil, and basil leaves if using. Repeat step for remaining pizza.', 'Delicious Margharita Pizza', 100, 'Vegeterian,Pizza,Cheese,Vegetable'),
(84, 'Classic Coleslaw', 'Forget shop-bought versions and make a homemade slaw. It\'s an ideal side dish for barbecues or to serve with burgers, salads, sandwiches and more', 'Remove any bruised or damaged outer cabbage leaves. Halve through the stem, and remove the dense core with a sharp knife and discard. Put cut side down onto a chopping board, and slice as finely as you can into thin shreds. You can also do this on a mandoline (you might want to quarter before slicing) or in a food processor with the shredding attachment. Tip into a bowl.+Grate the carrots on a box grater to coarsely shred, or cut into thin strips using a julienne peeled or the grater attachment on the food processor. Tip into the bowl. Finely slice the onion, and thin as you can, and add to the bowl with the other veg. Add the herbs if using. A mixture is nice if you have some to use up.+In a jug, whisk the mustard, mayo, yogurt and vinegar. Season well, and taste for sharpness and creamy. Add more vinegar if you like.+Tip the dressing into the veg bowl, and mix everything together well with a large spoon. Stir so all the veg gets coated lightly in the dressing. Sprinkle with a few pinches of paprika, and serve straight away. Can be covered and chilled for up to 3 days. Mix well before serving.', 'A bowl of Coleslaw', 140, 'Vegeterian,Vegetable'),
(85, 'Egg Rice', 'A bowl of egg rice, nothing should be easier', 'Peel the egg+Boil rice+Add the ingridients together in a bowl+Enjoy', 'A bowl of egg rice', 50, 'Vegeterian,Rice,Dairy'),
(87, 'Sesame Salmon', 'Try this Asian-inspired salmon supper with a nutty sesame dressing, crisp veg and comforting sweet potato mash. It\'s healthy, low-calorie and rich in omega-3', 'Heat oven to 200C/180 fan/ gas 6 and line a baking tray with parchment. Mix together 1/2 tbsp sesame oil, the soy, ginger, garlic and honey. Put the sweet potato wedges, skin and all, into a glass bowl with the lime wedges. Cover with cling film and microwave on high for 12-14 mins until completely soft.+Meanwhile, spread the broccoli and salmon out on the baking tray. Spoon over the marinade and season. Roast in the oven for 10-12 mins, then sprinkle over the sesame seeds.+Remove the lime wedges and roughly mash the sweet potato using a fork. Mix in the remaining sesame oil, the chilli and some seasoning. Divide between plates, along with the salmon and broccoli.', 'A plate of Sesame Salmon', 300, ',Fish,Vegetable'),
(89, 'Chili Chicken Noodles', 'Whip up this healthy chilli chicken noodle bowl in just 25 minutes. The addition of peanut butter gives it richness yet it\'s still under 500 calories', 'Heat the oil in a wok and add all the stir-fry ingredients except for the tamari. Toss over a high heat for a min, then cover, reduce the heat and cook for 5 mins more until the chicken is tender. Toss through the tamari.+Meanwhile, cook the noodles in a pan of boiling water for 5 mins. Drain, but reserve the water. Mix the peanut butter, lime juice and zest, cumin and 3 tbsp of the water, then toss with the noodles until coated. Serve with the stir-fry.', 'A plate of Chili Chicken Noodles', 100, 'Spicy,Meat,Chicken,Spicy,Vegetable,Noodles'),
(90, 'Pizza Pepperoni', 'Even a novice cook can master the art of pizza with our simple step-by-step guide. Bellissimo!', 'Make the base: Put the flour into a large bowl, then stir in the yeast and salt. Make a well, pour in 200ml warm water and the olive oil and bring together with a wooden spoon until you have a soft, fairly wet dough. Turn onto a lightly floured surface and knead for 5 mins until smooth. Cover with a tea towel and set aside. You can leave the dough to rise if you like, but itâ€™s not essential for a thin crust.+Make the sauce: Mix the passata, basil and crushed garlic together, then season to taste. Leave to stand at room temperature while you get on with shaping the base.+Roll out the dough: if youâ€™ve let the dough rise, give it a quick knead, then split into two balls. On a floured surface, roll out the dough into large rounds, about 25cm across, using a rolling pin. The dough needs to be very thin as it will rise in the oven. Lift the rounds onto two floured baking sheets.+Top and bake: heat the oven to 240C/220C fan/gas 8. Put another baking sheet or an upturned baking tray in the oven on the top shelf. Smooth sauce over bases with the back of a spoon. Scatter with cheese and tomatoes, drizzle with olive oil and season. Put one pizza, still on its baking sheet, on top of the preheated sheet or tray. Bake for 8-10 mins until crisp. Serve with a little more olive oil, and basil leaves if using. Repeat step for remaining pizza.', 'Delicious Pepperoni Pizza', 100, 'Pizza,Cheese,Vegetable,Meat'),
(92, 'Chicken Rice', 'A nice plain meal with almost no steps', 'Boil your rice+Chop your onion+Fry chicken and onion together+Add everything on the plate and enjoy', 'A plate of Chicken with Rice', 150, 'Plain,Meat,Chicken,Rice,Vegetable'),
(93, 'Stir-fry Rice Broccoli', 'Combine ready-to-cook vegetarian chicken-style pieces with broccoli, garlic, ginger and brown rice for a quick dinner', 'In a medium pan, pour boiling water over the broccoli, then boil for 4 mins.+Heat the olive oil in a non-stick wok and stir-fry the ginger, garlic and onion for 2 mins, add the mild chilli powder and stir briefly. Add the vegetarian chicken-style pieces and stir-fry for 2 mins more. Drain the broccoli and reserve the water. Tip the broccoli into the wok with the soy, honey, red pepper and 4 tbsp broccoli water then cook until heated through. Meanwhile, heat the rice following the pack instructions and serve with the stir-fry.', 'A plate of Stir-Fry Rice with Broccoli', 230, 'Vegeterian,Rice,Spicy,Peanuts,Vegetable');

-- --------------------------------------------------------

--
-- Structure for view `AccountView`
--
DROP TABLE IF EXISTS `AccountView`;

CREATE ALGORITHM=UNDEFINED DEFINER=`k1801606`@`localhost` SQL SECURITY DEFINER VIEW `AccountView`  AS  select `Account`.`accountID` AS `accountID`,`Account`.`firstname` AS `firstname`,`Account`.`surname` AS `surname`,`Account`.`telephone` AS `telephone`,`Account`.`username` AS `username`,`Account`.`password` AS `password`,`Account`.`isAdmin` AS `isAdmin`,`Address`.`lineOne` AS `lineOne`,`Address`.`lineTwo` AS `lineTwo`,`Address`.`postcode` AS `postcode`,`Address`.`town` AS `town`,`Address`.`city` AS `city`,`Address`.`country` AS `country` from (`Account` join `Address` on((`Account`.`addressID` = `Address`.`addressID`))) ;

-- --------------------------------------------------------

--
-- Structure for view `OrderView`
--
DROP TABLE IF EXISTS `OrderView`;

CREATE ALGORITHM=UNDEFINED DEFINER=`k1801606`@`localhost` SQL SECURITY DEFINER VIEW `OrderView`  AS  select `Account`.`firstname` AS `firstname`,`Account`.`surname` AS `surname`,`Account`.`addressID` AS `addressID`,`Account`.`telephone` AS `telephone`,`Address`.`lineOne` AS `lineOne`,`Address`.`lineTwo` AS `lineTwo`,`Address`.`postcode` AS `postcode`,`Address`.`town` AS `town`,`Address`.`city` AS `city`,`Address`.`country` AS `country`,`Orders`.`orderDate` AS `orderDate`,`Recipe`.`title` AS `RecipeTitle`,`Orders`.`invoiceID` AS `invoiceID`,`Orders`.`Quantity` AS `Quantity` from ((((`OrderHistory` join `Orders` on((`OrderHistory`.`orderID` = `Orders`.`orderID`))) join `Account` on((`OrderHistory`.`accountID` = `Account`.`accountID`))) join `Address` on((`Orders`.`deliveryAddress` = `Address`.`addressID`))) join `Recipe` on((`Orders`.`recipeID` = `Recipe`.`recipeID`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Account`
--
ALTER TABLE `Account`
  ADD PRIMARY KEY (`accountID`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `addressID` (`addressID`);

--
-- Indexes for table `Address`
--
ALTER TABLE `Address`
  ADD PRIMARY KEY (`addressID`);

--
-- Indexes for table `Basket`
--
ALTER TABLE `Basket`
  ADD PRIMARY KEY (`accountID`,`recipeID`),
  ADD KEY `accountID` (`accountID`),
  ADD KEY `recipeID` (`recipeID`);

--
-- Indexes for table `Food`
--
ALTER TABLE `Food`
  ADD PRIMARY KEY (`foodID`),
  ADD UNIQUE KEY `UniqueFood` (`foodName`);

--
-- Indexes for table `FoodList`
--
ALTER TABLE `FoodList`
  ADD PRIMARY KEY (`recipeID`,`foodID`),
  ADD KEY `foodID` (`foodID`),
  ADD KEY `recipeID` (`recipeID`);

--
-- Indexes for table `Invoice`
--
ALTER TABLE `Invoice`
  ADD PRIMARY KEY (`invoiceID`);

--
-- Indexes for table `OrderHistory`
--
ALTER TABLE `OrderHistory`
  ADD PRIMARY KEY (`accountID`,`orderID`),
  ADD KEY `accountID` (`accountID`),
  ADD KEY `orderID` (`orderID`);

--
-- Indexes for table `Orders`
--
ALTER TABLE `Orders`
  ADD PRIMARY KEY (`orderID`),
  ADD KEY `recipeID` (`recipeID`),
  ADD KEY `ivoiceID` (`invoiceID`),
  ADD KEY `deliverAddress` (`deliveryAddress`);

--
-- Indexes for table `Recipe`
--
ALTER TABLE `Recipe`
  ADD PRIMARY KEY (`recipeID`),
  ADD UNIQUE KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Account`
--
ALTER TABLE `Account`
  MODIFY `accountID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `Address`
--
ALTER TABLE `Address`
  MODIFY `addressID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;
--
-- AUTO_INCREMENT for table `Food`
--
ALTER TABLE `Food`
  MODIFY `foodID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
--
-- AUTO_INCREMENT for table `Invoice`
--
ALTER TABLE `Invoice`
  MODIFY `invoiceID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `Orders`
--
ALTER TABLE `Orders`
  MODIFY `orderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `Recipe`
--
ALTER TABLE `Recipe`
  MODIFY `recipeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Account`
--
ALTER TABLE `Account`
  ADD CONSTRAINT `Account_ibfk_1` FOREIGN KEY (`addressID`) REFERENCES `Address` (`addressID`);

--
-- Constraints for table `Basket`
--
ALTER TABLE `Basket`
  ADD CONSTRAINT `Basket_ibfk_1` FOREIGN KEY (`recipeID`) REFERENCES `Recipe` (`recipeID`),
  ADD CONSTRAINT `Basket_ibfk_2` FOREIGN KEY (`accountID`) REFERENCES `Account` (`accountID`);

--
-- Constraints for table `FoodList`
--
ALTER TABLE `FoodList`
  ADD CONSTRAINT `FoodList_ibfk_1` FOREIGN KEY (`foodID`) REFERENCES `Food` (`foodID`),
  ADD CONSTRAINT `FoodList_ibfk_2` FOREIGN KEY (`recipeID`) REFERENCES `Recipe` (`recipeID`);

--
-- Constraints for table `OrderHistory`
--
ALTER TABLE `OrderHistory`
  ADD CONSTRAINT `OrderHistory_ibfk_1` FOREIGN KEY (`orderID`) REFERENCES `Orders` (`orderID`),
  ADD CONSTRAINT `OrderHistory_ibfk_2` FOREIGN KEY (`accountID`) REFERENCES `Account` (`accountID`);

--
-- Constraints for table `Orders`
--
ALTER TABLE `Orders`
  ADD CONSTRAINT `Orders_ibfk_1` FOREIGN KEY (`recipeID`) REFERENCES `Recipe` (`recipeID`),
  ADD CONSTRAINT `Orders_ibfk_2` FOREIGN KEY (`invoiceID`) REFERENCES `Invoice` (`invoiceID`),
  ADD CONSTRAINT `Orders_ibfk_3` FOREIGN KEY (`deliveryAddress`) REFERENCES `Address` (`addressID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
