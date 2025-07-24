-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 17, 2025 at 08:41 AM
-- Server version: 8.0.42
-- PHP Version: 8.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `username`, `password`) VALUES
(1, 'sandy', 'A', 'admin', '$2y$10$kggeKkIs6rEWf.p/6muJCOepa8zY4DcDU3CBZua8iNc9SBM3MMGym');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int NOT NULL,
  `category` varchar(127) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `category`) VALUES
(1, 'mardi'),
(2, 'langtang'),
(4, 'manaslu'),
(5, 'pokhara'),
(6, 'kathmandu'),
(7, 'trek');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int NOT NULL,
  `comment` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `post_id` int NOT NULL,
  `crated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment`, `user_id`, `post_id`, `crated_at`) VALUES
(3, 'wow', 2, 7, '2025-06-08 11:54:59'),
(4, 'wow! great story', 1, 15, '2025-06-20 15:23:21'),
(5, 'wow', 1, 16, '2025-06-22 15:59:50'),
(6, 'omg', 4, 16, '2025-06-22 21:30:50'),
(7, 'haha', 4, 18, '2025-06-22 21:32:51'),
(8, 'wow sai amazing', 2, 18, '2025-06-22 21:34:50');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_managers`
--

CREATE TABLE `hotel_managers` (
  `id` int NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hotel_name` varchar(255) DEFAULT NULL,
  `hotel_location` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `hotel_managers`
--

INSERT INTO `hotel_managers` (`id`, `username`, `password`, `email`, `hotel_name`, `hotel_location`) VALUES
(1, 'sans', '$2y$10$5mWGJY6I9sfuNifHrnU7X.IbtI7kWX6UNU7A8MwWXr/aH3Nn7mmE2', 'abc@gmail.com', 'abc', 'abc'),
(2, 'admin', '$2y$10$qOmM6Pg5j2j5HIWbNLG0juW2cj9qTYWQNTVBwlfbiNXxf/4VfNAeq', 'abc@gmail.com', 'abc', 'abc');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int NOT NULL,
  `user_id` int NOT NULL,
  `post_title` varchar(127) NOT NULL,
  `post_text` text NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `cover_url` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `publish` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `user_id`, `post_title`, `post_text`, `created_at`, `updated_at`, `category_id`, `cover_url`, `publish`) VALUES
(7, 2, 'Conquering the Clouds: My Unforgettable Journey to Mardi Himal', '<div _ngcontent-ng-c230372820=\"\" class=\"conversation-container message-actions-hover-boundary ng-star-inserted\" id=\"8d1c7cd5879d7afb\"><model-response _ngcontent-ng-c230372820=\"\" _nghost-ng-c4161322008=\"\" class=\"ng-star-inserted\"><div _ngcontent-ng-c2580058953=\"\" class=\"response-container ng-tns-c2580058953-17 response-container-with-gpi ng-star-inserted\" jslog=\"173900;track:impression\"><div _ngcontent-ng-c2580058953=\"\" class=\"presented-response-container ng-tns-c2580058953-17\"><div _ngcontent-ng-c2580058953=\"\" class=\"response-container-content ng-tns-c2580058953-17\"><div _ngcontent-ng-c4161322008=\"\" class=\"response-content ng-tns-c2580058953-17\"><message-content _ngcontent-ng-c4161322008=\"\" class=\"model-response-text ng-star-inserted\" _nghost-ng-c2621204161=\"\" id=\"message-content-id-r_8d1c7cd5879d7afb\" style=\"height: auto;\"><div _ngcontent-ng-c2621204161=\"\" class=\"markdown markdown-main-panel enable-updated-hr-color\" id=\"model-response-message-contentr_8d1c7cd5879d7afb\" dir=\"ltr\" style=\"--animation-duration: 400ms; --fade-animation-function: linear;\"><div>The mountains called, and I answered, embarking on the unforgettable <strong>Mardi Himal Trek</strong>. This wasn\'t just a hike; it was an odyssey of breathtaking landscapes and profound personal accomplishment.</div><div>My adventure began in <strong>Pokhara</strong>, a scenic drive leading to the trailhead at Kande. Initially, the path wound through enchanting rhododendron forests, the air crisp with the scent of pine. As we ascended, the scenery transformed. Lush hills gave way to dramatic vistas of terraced fields and traditional Gurung villages, with the imposing <strong>Machhapuchhre (Fishtail Mountain)</strong> always in sight.</div><div><img src=\"https://www.trekcentralnepal.com/wp-content/uploads/2023/03/mardi-trek-trek-central-1280x960.jpg\" align=\"right\">Teahouses along the route offered warm hospitality, delicious local food, and a chance to share stories with fellow trekkers. The simplicity of trail life fostered deep connections with both nature and people.</div><div>The most challenging yet rewarding day was the climb to <strong>Mardi Himal Base Camp</strong>. Starting before dawn, we ascended through the thin, biting air. As the sun painted the sky, the clouds parted, revealing a breathtaking panorama of <strong>Annapurna South, Hiunchuli</strong>, and the majestic Machhapuchhre. Standing there, surrounded by such raw beauty, was a moment of pure transcendence.</div><div>Returning to Pokhara, I carried not just tired muscles, but a rejuvenated spirit. The Mardi Himal Trek is more than a walk; it\'s a journey of self-discovery, a testament to the human spirit, and a vivid reminder of our planet\'s unparalleled beauty. If you seek an adventure that will challenge and inspire, Mardi Himal awaits.</div></div></message-content></div></div></div><div _ngcontent-ng-c2580058953=\"\" class=\"response-container-footer ng-tns-c2580058953-17\"><message-actions _ngcontent-ng-c4161322008=\"\" footer=\"\" _nghost-ng-c26189854=\"\" class=\"ng-tns-c26189854-24 hide-action-bar ng-star-inserted\"><div _ngcontent-ng-c26189854=\"\" class=\"actions-container-v2 ng-tns-c26189854-24\"><div _ngcontent-ng-c26189854=\"\" class=\"buttons-container-v2 ng-tns-c26189854-24 ng-star-inserted\"><div _ngcontent-ng-c26189854=\"\" class=\"menu-button-wrapper ng-tns-c26189854-24 ng-star-inserted\"><div _ngcontent-ng-c26189854=\"\" class=\"more-menu-button-container ng-tns-c26189854-24 ng-star-inserted\"><!----></div><!----></div><!----><!----><!----><div _ngcontent-ng-c26189854=\"\" class=\"spacer ng-tns-c26189854-24 ng-star-inserted\"></div><!----><!----></div><!----><!----></div><!----><mat-menu _ngcontent-ng-c26189854=\"\" yposition=\"above\" xposition=\"after\" class=\"ng-tns-c26189854-24\"><!----></mat-menu><mat-menu _ngcontent-ng-c26189854=\"\" yposition=\"above\" class=\"ng-tns-c26189854-24\"><!----></mat-menu><!----><!----><!----><!----></message-actions><!----><!----></div></div><!----></model-response><div _ngcontent-ng-c230372820=\"\" class=\"restart-chat-button-scroll-placeholder ng-star-inserted\"></div><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----><!----></div><div _ngcontent-ng-c230372820=\"\" class=\"conversation-container message-actions-hover-boundary ng-star-inserted\" id=\"499149de28d69796\"><user-query _ngcontent-ng-c230372820=\"\" _nghost-ng-c2499647772=\"\" class=\"ng-star-inserted\"><!----><user-query-content _ngcontent-ng-c2499647772=\"\" class=\"user-query-container\" _nghost-ng-c3773132751=\"\"><div _ngcontent-ng-c3773132751=\"\" class=\"user-query-container user-query-bubble-container ng-star-inserted\"><div _ngcontent-ng-c3773132751=\"\" class=\"file-preview-container ng-star-inserted\"><!----><!----><!----></div><!----><div _ngcontent-ng-c3773132751=\"\" class=\"query-content ng-star-inserted verticle-align-for-single-line-text\" id=\"user-query-content-2\"><!----><!----><span _ngcontent-ng-c3773132751=\"\" class=\"user-query-bubble-with-background ng-star-inserted\"><!----><span _ngcontent-ng-c3773132751=\"\" class=\"horizontal-container\"><div _ngcontent-ng-c3773132751=\"\" role=\"heading\" aria-level=\"2\" class=\"query-text gds-body-l\" dir=\"ltr\"><div></div></div></span></span></div></div></user-query-content></user-query></div>', '2025-06-07 22:23:18', '2025-06-07 22:23:18', 1, 'COVER-68446afa2a2f03.98851712.jpg', 1),
(12, 2, 'Into the Heart of the Himalayas: My Langtang Trek Adventure', '<div><div>The Langtang Valley had always held a special allure for me – a promise of raw Himalayan beauty, rich culture, and a journey into a valley still recovering with remarkable resilience. My <strong>Langtang Trek</strong> was not just a walk; it was an immersive experience, a profound connection with nature and the incredibly warm-hearted people who call this magnificent region home.</div><div>My adventure began with a thrilling, albeit bumpy, jeep ride from Kathmandu, winding through picturesque terraced hillsides and charming villages. The air grew progressively cooler and fresher as we ascended, leaving the city\'s hustle behind. The trailhead at Syabrubesi marked the true beginning of the trek, a gentle introduction into the verdant embrace of the Langtang National Park.</div><div>The initial days were a symphony of sights and sounds: the roaring Langtang Khola river accompanying us, dense bamboo and rhododendron forests creating a verdant tunnel, and the occasional sighting of playful monkeys. As we climbed higher, the landscape dramatically shifted. Broad, U-shaped glacial valleys opened up, revealing staggering vistas of snow-capped peaks that seemed to pierce the sky. Langtang Lirung, Ganesh Himal, and Dorje Lakpa slowly emerged, their majestic presence a constant reminder of the incredible forces that shaped this land.</div><div>The teahouses along the Langtang trail were more than just shelters; they were hubs of genuine Nepali hospitality. Each evening, after a day of invigorating trekking, I was welcomed with steaming cups of yak butter tea, hearty bowls of <em>dhal bhat</em>, and the comforting warmth of a communal stove. Sharing stories with fellow trekkers and local families, learning about their lives and their journey of rebuilding after the 2015 earthquake, was a truly humbling and enriching experience. Their spirit and resilience were deeply inspiring.</div><div>The highlight of the trek was undoubtedly reaching <strong>Kyanjin Gompa</strong>, a charming village nestled in a vast, open valley. Surrounded by towering peaks, it felt like stepping into another world. The following morning, a pre-dawn hike up <strong>Kyanjin Ri</strong> offered the ultimate reward. As the sun kissed the highest peaks, casting a golden glow on the pristine snow, the 360-degree panoramic views were simply indescribable. Below me, the Langtang Valley stretched out, a testament to nature\'s grandeur and the tenacious spirit of its inhabitants.</div><div>The descent, though physically easier, was emotionally resonant, offering new perspectives on the landscapes and communities we had traversed. Returning to Kathmandu, I carried not just the fatigue of many miles, but a spirit deeply enriched by the raw beauty of Langtang, and an immense admiration for the resilience and warmth of its people.</div><div>The Langtang Trek is an extraordinary journey into the heart of the Himalayas, offering a unique blend of spectacular scenery, profound cultural immersion, and a powerful testament to the enduring spirit of Nepal. If you seek an adventure that will touch your soul and leave an indelible mark, the Langtang Valley awaits.</div></div>', '2025-06-09 09:18:30', '2025-06-09 09:18:30', 2, 'COVER-6846560a78fd74.94289773.jpeg', 1),
(13, 2, 'Into the Heart of the Himalayas: My Langtang Trek Adventure', '<div><div>The Langtang Valley had always held a special allure for me – a promise of raw Himalayan beauty, rich culture, and a journey into a valley still recovering with remarkable resilience. My <strong>Langtang Trek</strong> was not just a walk; it was an immersive experience, a profound connection with nature and the incredibly warm-hearted people who call this magnificent region home.</div><div>My adventure began with a thrilling, albeit bumpy, jeep ride from Kathmandu, winding through picturesque terraced hillsides and charming villages. The air grew progressively cooler and fresher as we ascended, leaving the city\'s hustle behind. The trailhead at Syabrubesi marked the true beginning of the trek, a gentle introduction into the verdant embrace of the Langtang National Park.</div><div>The initial days were a symphony of sights and sounds: the roaring Langtang Khola river accompanying us, dense bamboo and rhododendron forests creating a verdant tunnel, and the occasional sighting of playful monkeys. As we climbed higher, the landscape dramatically shifted. Broad, U-shaped glacial valleys opened up, revealing staggering vistas of snow-capped peaks that seemed to pierce the sky. Langtang Lirung, Ganesh Himal, and Dorje Lakpa slowly emerged, their majestic presence a constant reminder of the incredible forces that shaped this land.</div><div>The teahouses along the Langtang trail were more than just shelters; they were hubs of genuine Nepali hospitality. Each evening, after a day of invigorating trekking, I was welcomed with steaming cups of yak butter tea, hearty bowls of <em>dhal bhat</em>, and the comforting warmth of a communal stove. Sharing stories with fellow trekkers and local families, learning about their lives and their journey of rebuilding after the 2015 earthquake, was a truly humbling and enriching experience. Their spirit and resilience were deeply inspiring.</div><div>The highlight of the trek was undoubtedly reaching <strong>Kyanjin Gompa</strong>, a charming village nestled in a vast, open valley. Surrounded by towering peaks, it felt like stepping into another world. The following morning, a pre-dawn hike up <strong>Kyanjin Ri</strong> offered the ultimate reward. As the sun kissed the highest peaks, casting a golden glow on the pristine snow, the 360-degree panoramic views were simply indescribable. Below me, the Langtang Valley stretched out, a testament to nature\'s grandeur and the tenacious spirit of its inhabitants.</div><div>The descent, though physically easier, was emotionally resonant, offering new perspectives on the landscapes and communities we had traversed. Returning to Kathmandu, I carried not just the fatigue of many miles, but a spirit deeply enriched by the raw beauty of Langtang, and an immense admiration for the resilience and warmth of its people.</div><div>The Langtang Trek is an extraordinary journey into the heart of the Himalayas, offering a unique blend of spectacular scenery, profound cultural immersion, and a powerful testament to the enduring spirit of Nepal. If you seek an adventure that will touch your soul and leave an indelible mark, the Langtang Valley awaits.</div></div>', '2025-06-09 09:20:53', '2025-06-09 09:20:53', 2, 'COVER-68465699172a44.46323458.jpeg', 1),
(14, 2, 'Into the Heart of the Himalayas: My Langtang Trek Adventure', '<div><div>The Langtang Valley had always held a special allure for me – a promise of raw Himalayan beauty, rich culture, and a journey into a valley still recovering with remarkable resilience. My <strong>Langtang Trek</strong> was not just a walk; it was an immersive experience, a profound connection with nature and the incredibly warm-hearted people who call this magnificent region home.</div><div>My adventure began with a thrilling, albeit bumpy, jeep ride from Kathmandu, winding through picturesque terraced hillsides and charming villages. The air grew progressively cooler and fresher as we ascended, leaving the city\'s hustle behind. The trailhead at Syabrubesi marked the true beginning of the trek, a gentle introduction into the verdant embrace of the Langtang National Park.</div><div>The initial days were a symphony of sights and sounds: the roaring Langtang Khola river accompanying us, dense bamboo and rhododendron forests creating a verdant tunnel, and the occasional sighting of playful monkeys. As we climbed higher, the landscape dramatically shifted. Broad, U-shaped glacial valleys opened up, revealing staggering vistas of snow-capped peaks that seemed to pierce the sky. Langtang Lirung, Ganesh Himal, and Dorje Lakpa slowly emerged, their majestic presence a constant reminder of the incredible forces that shaped this land.</div><div>The teahouses along the Langtang trail were more than just shelters; they were hubs of genuine Nepali hospitality. Each evening, after a day of invigorating trekking, I was welcomed with steaming cups of yak butter tea, hearty bowls of <em>dhal bhat</em>, and the comforting warmth of a communal stove. Sharing stories with fellow trekkers and local families, learning about their lives and their journey of rebuilding after the 2015 earthquake, was a truly humbling and enriching experience. Their spirit and resilience were deeply inspiring.</div><div>The highlight of the trek was undoubtedly reaching <strong>Kyanjin Gompa</strong>, a charming village nestled in a vast, open valley. Surrounded by towering peaks, it felt like stepping into another world. The following morning, a pre-dawn hike up <strong>Kyanjin Ri</strong> offered the ultimate reward. As the sun kissed the highest peaks, casting a golden glow on the pristine snow, the 360-degree panoramic views were simply indescribable. Below me, the Langtang Valley stretched out, a testament to nature\'s grandeur and the tenacious spirit of its inhabitants.</div><div>The descent, though physically easier, was emotionally resonant, offering new perspectives on the landscapes and communities we had traversed. Returning to Kathmandu, I carried not just the fatigue of many miles, but a spirit deeply enriched by the raw beauty of Langtang, and an immense admiration for the resilience and warmth of its people.</div><div>The Langtang Trek is an extraordinary journey into the heart of the Himalayas, offering a unique blend of spectacular scenery, profound cultural immersion, and a powerful testament to the enduring spirit of Nepal. If you seek an adventure that will touch your soul and leave an indelible mark, the Langtang Valley awaits.</div></div>', '2025-06-09 09:21:57', '2025-06-09 09:21:57', 2, 'COVER-684656d911a7c4.26215713.jpeg', 1),
(15, 2, 'Into the Heart of the Himalayas: My Langtang Trek Adventure', '<div><div>The Langtang Valley had always held a special allure for me – a promise of raw Himalayan beauty, rich culture, and a journey into a valley still recovering with remarkable resilience. My <strong>Langtang Trek</strong> was not just a walk; it was an immersive experience, a profound connection with nature and the incredibly warm-hearted people who call this magnificent region home.</div><div>My adventure began with a thrilling, albeit bumpy, jeep ride from Kathmandu, winding through picturesque terraced hillsides and charming villages. The air grew progressively cooler and fresher as we ascended, leaving the city\'s hustle behind. The trailhead at Syabrubesi marked the true beginning of the trek, a gentle introduction into the verdant embrace of the Langtang National Park.</div><div>The initial days were a symphony of sights and sounds: the roaring Langtang Khola river accompanying us, dense bamboo and rhododendron forests creating a verdant tunnel, and the occasional sighting of playful monkeys. As we climbed higher, the landscape dramatically shifted. Broad, U-shaped glacial valleys opened up, revealing staggering vistas of snow-capped peaks that seemed to pierce the sky. Langtang Lirung, Ganesh Himal, and Dorje Lakpa slowly emerged, their majestic presence a constant reminder of the incredible forces that shaped this land.</div><div>The teahouses along the Langtang trail were more than just shelters; they were hubs of genuine Nepali hospitality. Each evening, after a day of invigorating trekking, I was welcomed with steaming cups of yak butter tea, hearty bowls of <em>dhal bhat</em>, and the comforting warmth of a communal stove. Sharing stories with fellow trekkers and local families, learning about their lives and their journey of rebuilding after the 2015 earthquake, was a truly humbling and enriching experience. Their spirit and resilience were deeply inspiring.</div><div>The highlight of the trek was undoubtedly reaching <strong>Kyanjin Gompa</strong>, a charming village nestled in a vast, open valley. Surrounded by towering peaks, it felt like stepping into another world. The following morning, a pre-dawn hike up <strong>Kyanjin Ri</strong> offered the ultimate reward. As the sun kissed the highest peaks, casting a golden glow on the pristine snow, the 360-degree panoramic views were simply indescribable. Below me, the Langtang Valley stretched out, a testament to nature\'s grandeur and the tenacious spirit of its inhabitants.</div><div>The descent, though physically easier, was emotionally resonant, offering new perspectives on the landscapes and communities we had traversed. Returning to Kathmandu, I carried not just the fatigue of many miles, but a spirit deeply enriched by the raw beauty of Langtang, and an immense admiration for the resilience and warmth of its people.</div><div>The Langtang Trek is an extraordinary journey into the heart of the Himalayas, offering a unique blend of spectacular scenery, profound cultural immersion, and a powerful testament to the enduring spirit of Nepal. If you seek an adventure that will touch your soul and leave an indelible mark, the Langtang Valley awaits.</div></div>', '2025-06-09 09:22:26', '2025-06-09 09:22:26', 2, 'COVER-684656f6bff617.88853743.jpeg', 1),
(16, 1, 'Dal Bhat and Determination: Tales from Annapurna', '<div><div><em>There are adventures we plan, and then there are those that quietly find us. My Annapurna Base Camp trek started as a spontaneous click on a travel blog and turned into one of the most transformative experiences of my life.</em></div><div><strong>Day 1: Pokhara to Ghandruk — Where It All Begins</strong>  \r\nThe morning sun shimmered over Phewa Lake as we left Pokhara behind. The trail to Ghandruk led us past cascading waterfalls, terraced fields, and cheerful children shouting \"Namaste!\" My legs were still fresh, my backpack straps not yet digging in, and I felt like I could walk to Everest if I had to. (Spoiler: I couldn’t.)</div><div><strong>Day 2–3: Into the Forests and up the Steps of Ulleri</strong>  \r\nThere’s cardio, and then there’s Ulleri. Thousands of stone steps carved into the hillside, each one mocking my gym membership. But the views — oh, the views — kept me going. The forest smelled of damp earth and rhododendron blossoms, and as we reached Ghorepani, the mist rolled in like a scene from a dream.</div><div><strong>Poon Hill Sunrise: Pure Gold</strong>  \r\nWe woke at 4:00 a.m. and climbed in the dark, headlamps bouncing. Then, just as we reached the viewpoint, the sun rose — fiery gold spilling across the Annapurnas and Dhaulagiri. Silence fell across the crowd, broken only by shutters clicking. I forgot about the cold. I forgot about my sore legs. I just stood there, awestruck.</div><div><strong>Day 4–6: Closer to the Sanctuary</strong>  \r\nThe trek from Tadapani to Chhomrong and deeper into the sanctuary was a mix of sweat, laughter, and ginger tea breaks. Each bend in the trail offered a new vista more dramatic than the last. Waterfalls thundered beside us; landslides reminded us of nature’s might. We reached Machhapuchhre Base Camp under a silver moon and collapsed into our sleeping bags like contented, muddy burritos.</div><div><strong>Annapurna Base Camp: A Bowl of Snow and Silence</strong>  \r\nWhen I finally stood at Annapurna Base Camp, 4,130 meters high, I felt small in the best possible way. The mountains formed a perfect amphitheater around us. No traffic, no emails, no to-do lists — just the crunch of boots on snow and the quiet thrill of accomplishment.</div><div><strong>The Return: Downhill Muscles I Didn’t Know I Had</strong>  \r\nIf going up tests your stamina, coming down tests your knees and patience. But each tea house we passed on the return felt like a reunion. We shared laughs over dal bhat and traded stories with fellow trekkers from around the globe. By the time we soaked in the hot springs at Jhinu Danda, our bodies were aching, but our spirits felt lighter than ever.</div><div></div><div><strong>Final Thoughts</strong>  \r\nThe ABC trek isn’t just about reaching a destination. It’s about the rhythm of your breath syncing with your steps, the unexpected kindness of strangers, and the realization that sometimes, the best views come after the hardest climbs.</div></div>', '2025-06-20 15:26:50', '2025-06-20 15:26:50', 7, 'COVER-68552cde7f7c77.18222672.jpeg', 1),
(17, 1, 'Dal Bhat and Determination: Tales from Annapurna', '<div>test<i>hgdfj</i></div>', '2025-06-22 16:00:25', '2025-06-22 16:00:25', 1, 'COVER-6857d7bd73e686.83045978.jpeg', 1),
(18, 4, 'Pokhara: Where Lakeside Dreams Meet Himalayan Majesty', 'my journey<div><b>hi everyone!!!!!!!!</b></div><div><b><font face=\"Courier New\" color=\"#ff0000\"><u>i love to travel</u></font><br></b><div><br></div></div>', '2025-06-22 21:32:24', '2025-06-22 21:32:24', 5, 'COVER-6858258cd5c9d8.04969888.jpeg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `like_id` int NOT NULL,
  `liked_by` int NOT NULL,
  `post_id` int NOT NULL,
  `liked_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`like_id`, `liked_by`, `post_id`, `liked_at`) VALUES
(7, 2, 7, '2025-06-08 11:54:56'),
(11, 2, 15, '2025-06-20 14:52:23'),
(12, 1, 15, '2025-06-20 15:23:05'),
(13, 2, 16, '2025-06-22 16:00:58'),
(14, 4, 16, '2025-06-22 21:30:45'),
(15, 2, 18, '2025-06-22 21:34:40');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int NOT NULL,
  `manager_id` int DEFAULT NULL,
  `room_type` varchar(255) DEFAULT NULL,
  `description` text,
  `price_per_night` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `manager_id`, `room_type`, `description`, `price_per_night`, `image_path`) VALUES
(1, 1, 'dulex', 'test', 1200.00, '6846603825bcf_logo_wobg.png');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int NOT NULL,
  `manager_id` int DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `caption` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `manager_id`, `image_path`, `caption`) VALUES
(1, 1, '6846600dcf51d_LOGO_WB.png', 'test');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `fname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `username`, `password`) VALUES
(1, 'sandhya shrestha', 'Sandhya', '$2y$10$6t7QzaquVApqqikXAvq1b.cIyzP1lOnHSOwO0ftxG1wTGjx6RLuc6'),
(2, 'nirmal', 'junkie', '$2y$10$b2h7ixqGUjCDr4ctNDBNMuQ4f3AJ1tVZ3T6Xv47BzyYjSoBW/4TzC'),
(3, 'James ', 'james', '$2y$10$TTAd/b38YIbfC6Nujm2MsOmG12QPPeVhBDTeyWnEWrenIf.ksvubm'),
(4, 'sai', 'saidon', '$2y$10$FSJ6Pjl9YZqTe9quNLhf9eyd1RLJJCpkRR4C4GhXb2KfrbBdQrPWC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `hotel_managers`
--
ALTER TABLE `hotel_managers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD PRIMARY KEY (`id`),
  ADD KEY `manager_id` (`manager_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `username_2` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `hotel_managers`
--
ALTER TABLE `hotel_managers`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `like_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `hotel_managers` (`id`);

--
-- Constraints for table `slideshow`
--
ALTER TABLE `slideshow`
  ADD CONSTRAINT `slideshow_ibfk_1` FOREIGN KEY (`manager_id`) REFERENCES `hotel_managers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
