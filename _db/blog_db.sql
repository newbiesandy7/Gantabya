-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 17, 2025 at 07:32 PM
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
-- Database: `blog_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `username`, `password`) VALUES
(1, 'sandy', 'A', 'admin', '$2y$10$kggeKkIs6rEWf.p/6muJCOepa8zY4DcDU3CBZua8iNc9SBM3MMGym');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `checkin_date` date DEFAULT NULL,
  `checkout_date` date DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `hotel_id`, `room_id`, `user_name`, `user_email`, `checkin_date`, `checkout_date`, `status`, `created_at`) VALUES
(1, 3, 2, 'nirmal', 'dasdad@gmail.com', '2025-07-18', '2025-07-18', 'cancelled', '2025-07-17 15:59:57'),
(2, 3, 1, 'dfsfddsfs', 'fsdafasf@gmail.com', '2025-07-19', '2025-07-29', 'confirmed', '2025-07-17 16:37:50'),
(3, 3, 1, 'dfdsafsfsf', 'nirmalacharya68@gmail.com', '2025-07-17', '2025-07-18', 'confirmed', '2025-07-17 16:48:48');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `category` varchar(127) NOT NULL
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
  `comment_id` int(11) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `crated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `comment`, `user_id`, `post_id`, `crated_at`) VALUES
(3, 'wow', 2, 7, '2025-06-08 11:54:59'),
(4, 'wow! great story', 1, 15, '2025-06-20 15:23:21'),
(5, 'wow', 1, 16, '2025-06-22 15:59:50'),
(9, 'good job', 5, 12, '2025-07-17 14:39:32'),
(10, 'damiiii', 5, 21, '2025-07-17 23:02:05');

-- --------------------------------------------------------

--
-- Table structure for table `hotel_managers`
--

CREATE TABLE `hotel_managers` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `hotel_name` varchar(255) DEFAULT NULL,
  `hotel_location` varchar(255) DEFAULT NULL,
  `background_type` varchar(20) DEFAULT 'color',
  `background_value` varchar(255) DEFAULT '#ffffff',
  `font_family` varchar(100) DEFAULT '''Segoe UI'', sans-serif',
  `text_color` varchar(20) DEFAULT '#222222',
  `accent_color` varchar(20) DEFAULT '#f7c948'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotel_managers`
--

INSERT INTO `hotel_managers` (`id`, `username`, `password`, `email`, `hotel_name`, `hotel_location`, `background_type`, `background_value`, `font_family`, `text_color`, `accent_color`) VALUES
(1, 'nirmal', '$2y$10$nNqwG5FaZtIweA26DSoeAe4qkyPJ5osBv7.3mGzDw8WlH7ACJQ3Ci', 'nirmalacharya68@gmail.com', 'top hotel', 'tandi-3, chitwan', 'color', '#ffffff', '\'Segoe UI\', sans-serif', '#222222', '#f7c948'),
(3, 'kanchan', '$2y$10$jeot28yokTnhsUJhABSvneIBC.XAuljjHx0qtrK9k6pqV1YrkfxrC', 'nirmal@gmail.com', 'jango tire', 'jarkata, china', NULL, '', '\'Segoe UI\', sans-serif', '#800080', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_title` varchar(127) NOT NULL,
  `post_text` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `category_id` int(11) NOT NULL,
  `cover_url` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `publish` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(21, 5, 'dfdsssf', '<div>fsdsfdfsfsf</div>', '2025-07-17 22:54:40', '2025-07-17 22:54:40', 7, 'COVER-68792e542eb813.68789558.jpg', 1),
(22, 5, '\"7 Hidden Trekking Trails in Nepal That Most Tourists Miss\"', '<div><div>Nepal is globally renowned for its legendary trekking routes like Everest Base Camp and the Annapurna Circuit. But beyond these iconic trails lies a treasure trove of lesser-known paths that remain untouched by mass tourism—perfect for adventurers looking to explore Nepal’s authentic, raw beauty.</div>\r\n<div>In this blog post, we unveil seven hidden trekking trails scattered across the Himalayas that offer serene landscapes, rich cultural encounters, and a deep connection with nature. These routes wind through remote villages, ancient forests, high mountain passes, and sacred valleys that few outsiders ever get to see. Ideal for those who crave solitude, authenticity, and off-the-beaten-path adventure, each of these trails provides a unique experience—whether it\'s witnessing centuries-old traditions in the Far West, encountering wildlife in the mid-hills, or gazing at pristine peaks uncluttered by crowds.</div>\r\n<div>We’ll cover essential information on each trail—difficulty level, best seasons, accommodation options, and tips for responsible travel. Whether you\'re a seasoned trekker or an adventurous beginner looking to go beyond the usual, this guide will inspire your next journey into Nepal’s lesser-known wonders.</div><br></div>', '2025-07-17 23:03:29', '2025-07-17 23:03:29', 7, 'COVER-6879306569a209.53037074.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `like_id` int(11) NOT NULL,
  `liked_by` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `liked_at` datetime NOT NULL DEFAULT current_timestamp()
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
(15, 2, 18, '2025-06-22 21:34:40'),
(16, 5, 13, '2025-07-17 14:39:20'),
(17, 5, 12, '2025-07-17 14:39:22'),
(19, 5, 21, '2025-07-17 23:02:00');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `room_type` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_per_night` decimal(10,2) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `manager_id`, `room_type`, `description`, `price_per_night`, `image_path`) VALUES
(1, 3, 'delux', 'nice and cozy xa hai guys', 1500.00, '68791b9f64fbb_Untitled3.jpeg'),
(2, 3, 'damaka room', 'pataka apdkinxa re rati', 2500.00, '68791bb5ca8ce_Untitled4.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `slideshow`
--

CREATE TABLE `slideshow` (
  `id` int(11) NOT NULL,
  `manager_id` int(11) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `caption` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slideshow`
--

INSERT INTO `slideshow` (`id`, `manager_id`, `image_path`, `caption`) VALUES
(1, 3, '68791b228caef_hotel.jpeg', 'asdff'),
(2, 3, '68791b82b8d90_Untitled.jpeg', ''),
(3, 3, '68791b87a245a_Untitled4.jpeg', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fname`, `username`, `password`) VALUES
(1, 'sandhya shrestha', 'Sandhya', '$2y$10$6t7QzaquVApqqikXAvq1b.cIyzP1lOnHSOwO0ftxG1wTGjx6RLuc6'),
(2, 'nirmal', 'junkie', '$2y$10$b2h7ixqGUjCDr4ctNDBNMuQ4f3AJ1tVZ3T6Xv47BzyYjSoBW/4TzC'),
(3, 'James ', 'james', '$2y$10$TTAd/b38YIbfC6Nujm2MsOmG12QPPeVhBDTeyWnEWrenIf.ksvubm'),
(5, 'kanchan acharya', 'kanchan7', '$2y$10$.Wjgs6LoeJCOycLD6yvUh.vLfT3RkFS2CSSx8geLYKUHhBg31N3ta');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `hotel_id` (`hotel_id`),
  ADD KEY `room_id` (`room_id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hotel_managers`
--
ALTER TABLE `hotel_managers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `slideshow`
--
ALTER TABLE `slideshow`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotel_managers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post`
--
ALTER TABLE `post`
  ADD CONSTRAINT `post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE;
ALTER TABLE `comment`
  ADD CONSTRAINT `cmt_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cmt_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE;
  ALTER TABLE `post_like`
  ADD CONSTRAINT `like_ibfk_1` FOREIGN KEY (`liked_by`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `like_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE;
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
