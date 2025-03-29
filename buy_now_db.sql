-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Mar 19, 2025 at 07:49 PM
-- Server version: 5.7.44
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `buy_now_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`) VALUES
(11, 31, 2),
(12, 32, 5),
(13, 2123123, 6);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT 'default.jpg',
  `rating` decimal(3,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `rating`) VALUES
(1, 'AirPods for Broke People', 'Two empty Tic Tac boxes. No Bluetooth. No music.', 199.99, 'gadget.jpg', 3.50),
(2, 'Suspicious Red Button', 'No labels. No manual. It glows. You will press it.', 5999.99, 'red.jpg', 4.90),
(3, 'USB of Eternal Regret', 'Plug it in and enjoy 3 minutes of normalcy before doom.', 9.99, 'usb.jpg', 4.60),
(4, 'The MFA is for Cowards Shirt', 'Let the world know you dont believe in two-factor.', 240.99, 'mfa.jpg', 1.20),
(5, 'AI-Powered Stock Market Predictor', 'Accurately predicts... your downfall.', 499.99, 'stock.jpg', 1.00),
(6, 'TRUST ME, BRO Financial Advice Course', 'Just follow my advice bro. We gonna hit millions.', 1337.99, 'fin.jpg', 3.50),
(7, 'I PROMISE ILL LEARN TO CODE Course', 'Includes 100 Udemy courses you will never finish.', 79.99, 'course.jpg', 4.10),
(8, 'LET HIM COOK Microwave - Limited Edition', 'May cause electrical fires.', 549.99, 'micro.jpg', 4.80);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `review_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `product_id`, `review_text`, `created_at`) VALUES
(112, 1, 1, 'This product increased my IQ by 3 points. Worth it.', '2025-03-19 15:58:19'),
(113, 2, 1, 'Bought this and now my plants fear me.', '2025-03-19 15:58:19'),
(114, 32, 1, 'Was not expecting much', '2025-03-19 15:58:19'),
(115, 55, 1, 'The prophecy foretold this item.', '2025-03-19 15:58:19'),
(116, 56, 1, 'If Batman had this, Joker wouldn’t stand a chance.', '2025-03-19 15:58:19'),
(117, 57, 1, 'Even my grandma thinks this is overpowered.', '2025-03-19 15:58:19'),
(118, 58, 1, 'I regret nothing. My wallet does.', '2025-03-19 15:58:19'),
(119, 59, 1, 'Bought it as a joke. Now I’m a believer.', '2025-03-19 15:58:19'),
(120, 60, 1, 'This thing should come with a warning label.', '2025-03-19 15:58:19'),
(121, 61, 1, 'I have no idea what it does but it looks dangerous.', '2025-03-19 15:58:19'),
(122, 62, 1, 'This belongs in a museum.', '2025-03-19 15:58:19'),
(123, 63, 1, 'Could be illegal in some countries.', '2025-03-19 15:58:19'),
(124, 64, 1, 'Shrek himself would endorse this.', '2025-03-19 15:58:19'),
(125, 1, 2, 'My cat won’t stop staring at it. Concerned.', '2025-03-19 15:58:19'),
(126, 2, 2, 'I bought this and immediately became 10% cooler.', '2025-03-19 15:58:19'),
(127, 3, 2, 'Not sure if I own this or if it owns me.', '2025-03-19 15:58:19'),
(128, 55, 2, 'Works as advertised, but I’m scared of it.', '2025-03-19 15:58:19'),
(129, 56, 2, 'Every time I use it, I hear boss music.', '2025-03-19 15:58:19'),
(130, 57, 2, 'Did I just unlock a secret level in life?', '2025-03-19 15:58:19'),
(131, 58, 2, 'Might have caused a minor blackout in my city.', '2025-03-19 15:58:19'),
(132, 59, 2, 'If aliens came to Earth, they’d want this.', '2025-03-19 15:58:19'),
(133, 60, 2, 'Used it once. Now my neighbors are suspicious.', '2025-03-19 15:58:19'),
(134, 61, 2, 'This should be classified as a superweapon.', '2025-03-19 15:58:19'),
(135, 62, 2, 'Doesn’t do what I expected, but somehow better.', '2025-03-19 15:58:19'),
(136, 63, 2, 'Bought it and now birds follow me everywhere.', '2025-03-19 15:58:19'),
(137, 64, 2, 'My credit card cried, but I laughed.', '2025-03-19 15:58:19'),
(138, 1, 3, 'This item radiates pure chaotic energy.', '2025-03-19 15:58:19'),
(139, 2, 3, 'NASA should study this thing.', '2025-03-19 15:58:19'),
(140, 3, 3, 'I feel like a main character using this.', '2025-03-19 15:58:19'),
(141, 55, 3, 'Nothing makes sense anymore, but this does.', '2025-03-19 15:58:19'),
(142, 56, 3, 'Might be responsible for my latest bad decision.', '2025-03-19 15:58:19'),
(143, 57, 3, 'If Gandalf had this, Lord of the Rings would be over in 2 minutes.', '2025-03-19 15:58:19'),
(144, 58, 3, 'My dog respects me more now.', '2025-03-19 15:58:19'),
(145, 59, 3, 'Feels like something from a sci-fi movie.', '2025-03-19 15:58:19'),
(146, 60, 3, 'The FBI might show up after buying this.', '2025-03-19 15:58:19'),
(147, 61, 3, 'This should be illegal.', '2025-03-19 15:58:19'),
(148, 62, 3, 'Instantly made me cooler.', '2025-03-19 15:58:19'),
(149, 63, 3, 'The power... THE POWER!', '2025-03-19 15:58:19'),
(150, 64, 3, 'Changed my life in ways I can’t explain.', '2025-03-19 15:58:19'),
(151, 1, 4, 'I touched it and suddenly understood quantum physics.', '2025-03-19 15:58:19'),
(152, 2, 4, 'Jeff Bezos is probably mad this exists.', '2025-03-19 15:58:19'),
(153, 3, 4, 'Shrek himself would approve.', '2025-03-19 15:58:19'),
(154, 55, 4, 'Got this for fun, now I’m a cult leader.', '2025-03-19 15:58:19'),
(155, 56, 4, 'Not sure if I bought it or it bought me.', '2025-03-19 15:58:19'),
(156, 57, 4, 'Instant regret... then instant love.', '2025-03-19 15:58:19'),
(157, 58, 4, 'NASA might want to confiscate this.', '2025-03-19 15:58:19'),
(158, 59, 4, 'My toaster started speaking Morse code.', '2025-03-19 15:58:19'),
(159, 60, 4, 'This should be featured in an anime.', '2025-03-19 15:58:19'),
(160, 61, 4, 'My pet lizard tried to eat it.', '2025-03-19 15:58:19'),
(161, 62, 4, 'Legend says this unlocks the multiverse.', '2025-03-19 15:58:19'),
(162, 63, 4, 'I put this on my shelf and now it glows.', '2025-03-19 15:58:19'),
(163, 64, 4, 'I feel like a final boss using this.', '2025-03-19 15:58:19'),
(164, 1, 5, 'Was expecting a scam, got a treasure instead.', '2025-03-19 15:58:19'),
(165, 2, 5, 'I don’t know what I bought, but I like it.', '2025-03-19 15:58:19'),
(166, 3, 5, 'It buzzes sometimes. Not sure why.', '2025-03-19 15:58:19'),
(167, 55, 5, 'I think this thing hacked my WiFi.', '2025-03-19 15:58:19'),
(168, 56, 5, 'Buying this may have changed my destiny.', '2025-03-19 15:58:19'),
(169, 57, 5, 'I feel like a superhero now.', '2025-03-19 15:58:19'),
(170, 58, 5, 'Goku himself would want this.', '2025-03-19 15:58:19'),
(171, 59, 5, 'Why do I hear boss music?', '2025-03-19 15:58:19'),
(172, 60, 5, 'My neighbors are jealous now.', '2025-03-19 15:58:19'),
(173, 61, 5, 'Every time I use this, I hear a narrator.', '2025-03-19 15:58:19'),
(174, 62, 5, 'I now control the stock market.', '2025-03-19 15:58:19'),
(175, 63, 5, 'Might be haunted, but that’s part of the fun.', '2025-03-19 15:58:19'),
(176, 64, 5, 'It looks illegal. It’s not, but it looks like it.', '2025-03-19 15:58:19'),
(177, 1, 6, 'Elon Musk, take notes.', '2025-03-19 15:58:19'),
(178, 2, 6, 'It does things. I don’t know how.', '2025-03-19 15:58:19'),
(179, 3, 6, 'Was not ready for this level of awesomeness.', '2025-03-19 15:58:19'),
(180, 55, 6, 'The government might ban this soon.', '2025-03-19 15:58:19'),
(181, 56, 6, 'I might be on a watchlist now.', '2025-03-19 15:58:19'),
(182, 57, 6, 'Even Thanos would respect this.', '2025-03-19 15:58:19'),
(183, 58, 6, 'My gaming skills improved 300% with this.', '2025-03-19 15:58:19'),
(184, 59, 6, 'I think it just solved world hunger.', '2025-03-19 15:58:19'),
(185, 60, 6, 'Definitely a must-have for mad scientists.', '2025-03-19 15:58:19'),
(186, 61, 6, 'I can hear colors now.', '2025-03-19 15:58:19'),
(187, 62, 6, 'This should be part of history books.', '2025-03-19 15:58:19'),
(188, 63, 6, 'Shrek and Batman would fight over this.', '2025-03-19 15:58:19'),
(189, 64, 6, 'Instantly doubled my confidence level.', '2025-03-19 15:58:19'),
(190, 1, 7, 'I feel like Tony Stark using this.', '2025-03-19 15:58:19'),
(191, 2, 7, 'Might have summoned a demon. Worth it.', '2025-03-19 15:58:19'),
(192, 3, 7, 'I now have superpowers. I think.', '2025-03-19 15:58:19'),
(193, 55, 7, 'Every time I use this, something crazy happens.', '2025-03-19 15:58:19'),
(194, 56, 7, 'If you don’t own this, are you even living?', '2025-03-19 15:58:19'),
(195, 57, 7, 'Best investment I’ve ever made.', '2025-03-19 15:58:19'),
(196, 58, 7, 'Aliens probably use this technology.', '2025-03-19 15:58:19'),
(197, 59, 7, 'If I go missing, it’s because of this.', '2025-03-19 15:58:19'),
(198, 60, 7, 'This unlocked my full potential.', '2025-03-19 15:58:19'),
(199, 61, 7, 'This is what peak performance looks like.', '2025-03-19 15:58:19'),
(201, 63, 7, 'Did I just hack reality?', '2025-03-19 15:58:19'),
(202, 64, 7, 'I need another one. Immediately.', '2025-03-19 15:58:19'),
(203, 3, 1, 'Even my 5 year old child can create a better looking website. Fire the developers!', '2025-03-19 17:54:37');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('user','admin') DEFAULT 'user',
  `bank_balance` decimal(10,2) DEFAULT '5000.00',
  `total_items_purchased` int(11) DEFAULT '0',
  `bio` text,
  `profile_pic` varchar(255) DEFAULT 'default.png',
  `otp` int(11) DEFAULT '997',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `bank_balance`, `total_items_purchased`, `bio`, `profile_pic`, `otp`, `created_at`) VALUES
(1, 'John', 'abc@gmail.com', '$2y$10$NWTSPkcdvhYMCYSd4YIGuJS/MTwkwBPTRhjKjbtUOB...', 'user', 0.00, 0, NULL, 'default.png', 674, '2025-03-19 12:59:46'),
(2, 'CryptoBro419', 'crypto@notascam.com', '$2y$10$d8kFeZjaa4G505A9qv1QSve230oOu6Q2M.vpB.wS2vaR...', 'user', 3263.12, 0, NULL, 'default.png', 555, '2025-03-19 12:59:46'),
(3, 'Chad', 'chad@goatt.com', '$2y$10$kwzbDJ23wD1tnx.ifa36OuHcrb1UgTiLaClpfd/zuN9...', 'user', 5000.00, 0, NULL, 'default.png', 313, '2025-03-19 12:59:46'),
(31, 'larry', 'larry@goatt.com', 'larry', 'user', 3263.12, 0, 'Testestttttdddddd', 'default.png', 556, '2025-03-19 16:07:27'),
(32, 'Mike', 'mikey@goatt.com', 'chd', 'user', 5000.00, 0, 'dddd', 'default.png', 881, '2025-03-19 16:07:27'),
(53, 'ShrekOnSteroids', 'shrekonsteroids@mememail.com', '8495e434f3', 'user', 5000.00, 0, 'Strong', 'default.png', 855, '2025-03-19 15:25:46'),
(54, 'GokuTaxEvasion', 'gokutaxevasion@mememail.com', '57099abc58', 'user', 5000.00, 0, 'I am inevitable - but also unemployed', 'default.png', 533, '2025-03-19 15:25:46'),
(55, 'JohnWick69', 'johnwick69@mememail.com', 'babfc9df15', 'user', 5000.00, 0, 'Will sell soul for anime figures', 'default.png', 878, '2025-03-19 15:25:46'),
(56, 'KarenSlayer', 'karenslayer@mememail.com', 'cc20b4cb4d', 'user', 5000.00, 0, 'When\'s GTA 6 dropping?', 'default.png', 108, '2025-03-19 15:25:46'),
(57, '404UsernameNotFound', '404usernamenotfound@mememail.com', '30d76023e1', 'user', 5000.00, 0, 'Bingus approves this message', 'default.png', 703, '2025-03-19 15:25:46'),
(58, 'AnimeProtagonist', 'animeprotagonist@mememail.com', 'b168cb51da', 'user', 5000.00, 0, 'Speedrunning life on 1 HP', 'default.png', 173, '2025-03-19 15:25:46'),
(59, 'BigChungus420', 'bigchungus420@mememail.com', 'b476b342c0', 'user', 5000.00, 0, 'MrBeast challenge reject', 'default.png', 724, '2025-03-19 15:25:46'),
(60, 'RickAstleyFan', 'rickastleyfan@mememail.com', '3d4f145217', 'user', 5000.00, 0, 'Certified meme historian', 'default.png', 887, '2025-03-19 15:25:46'),
(61, 'SussyBaka', 'sussybaka@mememail.com', 'ad9d2ecca1', 'user', 5000.00, 0, 'Professional procrastinator', 'default.png', 920, '2025-03-19 15:25:46'),
(62, 'OnePunchBanana', 'onepunchbanana@mememail.com', 'dc7a28a276', 'user', 5000.00, 0, 'Respawned too many times', 'default.png', 770, '2025-03-19 15:25:46'),
(63, 'NarutoRunMaster', 'narutorunmaster@mememail.com', '8fc1f0fbbe', 'user', 5000.00, 0, 'Just a sentient AI testing you', 'default.png', 638, '2025-03-19 15:25:46'),
(64, 'MasterChiefLOL', 'masterchieflol@mememail.com', '57fa652d66', 'user', 5000.00, 0, 'Ligma survivor', 'default.png', 913, '2025-03-19 15:25:46'),
(65, 'EzioAuditoreIRL', 'ezioauditoreirl@mememail.com', '1aef881d66', 'user', 5000.00, 0, 'Stealth is optional', 'default.png', 941, '2025-03-19 15:25:46'),
(66, 'ShadowRealmVictim', 'shadowrealmvictim@mememail.com', '1811ba28a0', 'user', 5000.00, 0, 'Downloaded more RAM', 'default.png', 343, '2025-03-19 15:25:46'),
(67, 'DogeToTheMoon', 'dogetothemoon@mememail.com', '0552764556', 'user', 5000.00, 0, 'Investing in stonks', 'default.png', 872, '2025-03-19 15:25:46'),
(68, 'YodaSpeaksInReverse', 'yodaspeaksinreverse@mememail.com', 'e92c7ff2ce', 'user', 5000.00, 0, 'Certified keyboard warrior', 'default.png', 388, '2025-03-19 15:25:46'),
(69, 'KeanuReevesNPC', 'keanureevesnpc@mememail.com', '665d50c363', 'user', 5000.00, 0, 'I am inevitable - but also unemployed', 'default.png', 170, '2025-03-19 15:25:46'),
(70, 'BowserStepDad', 'bowserstepdad@mememail.com', '2519654474', 'user', 5000.00, 0, 'Speedrunning life on 1 HP', 'default.png', 218, '2025-03-19 15:25:46'),
(71, 'ToxicGamer69', 'toxicgamer69@mememail.com', '20a15bda7e', 'user', 5000.00, 0, 'Anime was a mistake - Miyazaki', 'default.png', 554, '2025-03-19 15:25:46'),
(72, 'GigaChadMeme', 'gigachadmeme@mememail.com', 'cff81570b0', 'user', 5000.00, 0, 'Just a sentient AI testing you', 'default.png', 986, '2025-03-19 15:25:46'),
(73, 'ItachiDidNothingWrong', 'itachididnothingwrong@mememail.com', 'e65ea5fc60', 'user', 5000.00, 0, 'Certified keyboard warrior', 'default.png', 866, '2025-03-19 15:25:46'),
(74, 'EldenRingNoHit', 'eldenringnohit@mememail.com', 'c8112eb3ae', 'user', 5000.00, 0, 'Lived long enough to see loot boxes', 'default.png', 157, '2025-03-19 15:25:46'),
(75, 'DoomSlayerSim', 'doomslayersim@mememail.com', '0d3c28dba4', 'user', 5000.00, 0, 'Rip and tear!', 'default.png', 494, '2025-03-19 15:25:46'),
(76, 'MinecraftSpeedrunWR', 'minecraftspeedrunwr@mememail.com', 'f33cdd6038', 'user', 5000.00, 0, 'Punching trees since 2011', 'default.png', 620, '2025-03-19 15:25:46'),
(77, 'SkyrimHorseFly', 'skyrimhorsefly@mememail.com', 'a9a719b533', 'user', 5000.00, 0, 'Fast travel? Never heard of it', 'default.png', 685, '2025-03-19 15:25:46'),
(78, 'KratosAngerIssues', 'kratosangerissues@mememail.com', '3b02c605b3', 'user', 5000.00, 0, 'Boy.', 'default.png', 355, '2025-03-19 15:25:46'),
(79, 'AmongUsImpostor', 'amongusimpostor@mememail.com', 'c2ceb0791d', 'user', 5000.00, 0, 'Definitely not sus', 'default.png', 309, '2025-03-19 15:25:46'),
(80, 'SaitamaOneHit', 'saitamaonehit@mememail.com', '2d74b13a79', 'user', 5000.00, 0, 'Bald and OP', 'default.png', 883, '2025-03-19 15:25:46'),
(81, 'GeraltBathScene', 'geraltbathscene@mememail.com', 'a882a0caa1', 'user', 5000.00, 0, 'Toss a coin to your Witcher', 'default.png', 110, '2025-03-19 15:25:46'),
(82, 'RedPillMatrix', 'redpillmatrix@mememail.com', 'b03f58e0e0', 'user', 5000.00, 0, 'Speedrunning life on 1 HP', 'default.png', 939, '2025-03-19 15:25:46'),
(83, 'DarthVaper', 'darthvaper@mememail.com', '3ee010d89a', 'user', 5000.00, 0, 'Join the dark side, we have cookies', 'default.png', 842, '2025-03-19 15:25:46'),
(84, 'ThanosSnap2.0', 'thanossnap2.0@mememail.com', 'e83b13332a', 'user', 5000.00, 0, 'Balanced, as all things should be', 'default.png', 216, '2025-03-19 15:25:46'),
(85, 'DarkSoulsNoDodge', 'darksoulsnododge@mememail.com', '03b28cbcc7', 'user', 5000.00, 0, 'Rolling is for cowards', 'default.png', 852, '2025-03-19 15:25:46'),
(86, 'SpeedrunAnyPercent', 'speedrunanypercent@mememail.com', 'a7e349308c', 'user', 5000.00, 0, 'I glitch through walls IRL', 'default.png', 658, '2025-03-19 15:25:46'),
(87, 'SansUndertale', 'sansundertale@mememail.com', 'f1c4dc9b85', 'user', 5000.00, 0, 'You’re gonna have a bad time', 'default.png', 115, '2025-03-19 15:25:46'),
(88, 'WaluigiForSmash', 'waluigiforsmash@mememail.com', 'efca75db72', 'user', 5000.00, 0, 'Justice for Waluigi', 'default.png', 201, '2025-03-19 15:25:46'),
(89, 'GTA5CheatCode', 'gta5cheatcode@mememail.com', '35d5953758', 'user', 5000.00, 0, 'I have all the cheat codes', 'default.png', 833, '2025-03-19 15:25:46'),
(90, 'PepegaBrain', 'pepegabrain@mememail.com', 'ee7f4ed361', 'user', 5000.00, 0, 'Certified keyboard warrior', 'default.png', 188, '2025-03-19 15:25:46'),
(91, 'MonkeUprising', 'monkeuprising@mememail.com', 'e9ed4b05c4', 'user', 5000.00, 0, 'Return to monke', 'default.png', 222, '2025-03-19 15:25:46'),
(92, 'Evil_user', 'cyberpunkbugcollector@mememail.com', 'eceedca276', 'user', 5000.00, 0, 'Cats are cool, Anyways congrats on getting the flag\nFlag{HaCk3d_Ev1L-Us3rrrr}', 'cat.png', 580, '2025-03-19 15:25:46'),
(93, 'TrollfaceCertified', 'trollfacecertified@mememail.com', '71ee297401', 'user', 5000.00, 0, 'Problem?', 'default.png', 261, '2025-03-19 15:25:46'),
(94, 'OJSimpsonGaming', 'ojsimpsongaming@mememail.com', '6de79956c1', 'user', 5000.00, 0, 'One more game, then I’ll sleep', 'default.png', 859, '2025-03-19 15:25:46'),
(95, 'ZeldaIsTheBoy', 'zeldaistheboy@mememail.com', 'c71fa4a544', 'user', 5000.00, 0, 'Link is not Zelda', 'default.png', 644, '2025-03-19 15:25:46'),
(96, 'UltraInstinctShaggy', 'ultrainstinctshaggy@mememail.com', '68c2a05977', 'user', 5000.00, 0, 'Only using 1% of my power', 'default.png', 228, '2025-03-19 15:25:46'),
(97, 'RealLifeNPC', 'reallifenpc@mememail.com', '06069c3c99', 'user', 5000.00, 0, 'Side questing IRL', 'default.png', 517, '2025-03-19 15:25:46'),
(98, 'ChadOverlord', 'chadoverlord@mememail.com', '87856363b9', 'user', 5000.00, 0, 'Just a sentient AI testing you', 'default.png', 211, '2025-03-19 15:25:46'),
(99, 'WholesomeDankMemer', 'wholesomedankmemer@mememail.com', '7335e6d56f', 'user', 5000.00, 0, 'Spreading dank positivity', 'default.png', 471, '2025-03-19 15:25:46'),
(100, 'MajimaEverywhere', 'majimaeverywhere@mememail.com', '473289c318', 'user', 5000.00, 0, 'Anywhere, anytime', 'default.png', 837, '2025-03-19 15:25:46'),
(2123123, 'administrator_745', 'admin@adminadmin.com', '$2y$10$yg3EIHTkipgL8d7lDizaTOFXm69NqmLBDZNDkmsHnu2MbUMi6pw7e', 'admin', 10000.00, 972, NULL, 'default.png', 431, '2025-03-19 12:59:46'),
(2123124, 'apple', 'a@d.c', 'a1', 'user', 5000.00, 0, NULL, 'default.png', 997, '2025-03-19 16:15:28'),
(2123125, 'Smartguy', '', '$2y$10$UnlUTjnej104.rC83IwHi.TxiayZXUc4D7VqN5JGiJH/ub9o880aa', 'user', 4618.05, 16, 'weweqwe', 'default.png', 864, '2025-03-19 16:15:57'),
(2123127, 'apple33', 'applew@gm.cc', '$2y$10$cby9V5pWgG.w7w//9m.Wp.k8Uo7sFYYPYWs26OqgzpjKhPnGunJfW', 'user', 5000.00, 0, NULL, 'default.png', 997, '2025-03-19 16:24:05'),
(2123129, 'Darshilnoob', 'cipher@thelegendaryhacker.com', '$2y$10$QZpzsabkaHOhRQydzP6.z.QXIH/eBQQIBvkloHpZPUj5hVM/bQdna', 'user', 5000.00, 0, NULL, 'default.png', 997, '2025-03-19 17:29:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=204;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2123130;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
