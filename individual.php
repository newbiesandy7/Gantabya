<?php
session_start();
include 'db_conn.php';
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
    $logged = true;
    $user_id = $_SESSION['user_id'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TrekNepal Adventures - Destination Details</title>
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="css/individual.css">
       <link rel="stylesheet" href="css/navbar_custom.css">
</head>
<body>
<?php
include 'inc/Navbar.php';
?>
   <main class="container">
        <div id="dynamic-destination-content">
            <div class="main-content-wrapper">
                <section class="destination-info">
                    <h1>Loading Destination...</h1>
                    <img src="https://placehold.co/800x350/a3bffa/333333?text=Loading..." alt="Loading Image"
                        class="destination-image">
                    <p>Please wait while the destination details are loaded.</p>
                </section>

                <div class="side-content-wrapper">
                    <aside class="weather-section">
                        <h2>Current Weather</h2>
                        <div id="weather-forecast-card" class="weather-card" data-lat="" data-lon=""
                            data-location-name="">
                            <div class="weather-loading-message">
                                <div class="spinner"></div>
                                <p>Loading weather...</p>
                            </div>
                            <div class="weather-content hidden">
                                <h3 class="weather-location"></h3>
                                <div class="weather-main">
                                    <img class="weather-icon-img" src="https://openweathermap.org/img/wn/01d@2x.png"
                                        alt="Weather icon">
                                    <div class="weather-temperature">--°C</div>
                                </div>
                                <p class="weather-description">--</p>
                                <div class="weather-details-grid">
                                    <div class="weather-detail-item"><strong>Feels like:</strong> <span
                                            class="weather-feels-like">--°C</span></div>
                                    <div class="weather-detail-item"><strong>Humidity:</strong> <span
                                            class="weather-humidity">--%</span></div>
                                    <div class="weather-detail-item"><strong>Wind:</strong> <span
                                            class="weather-wind">-- m/s</span></div>
                                    <div class="weather-detail-item"><strong>Pressure:</strong> <span
                                            class="weather-pressure">-- hPa</span></div>
                                </div>
                            </div>
                            <div class="weather-error-message hidden">
                                <p>Could not fetch weather data.</p>
                            </div>
                        </div>
                    </aside>

                    <aside class="budget-calculator-section">
                        <h2>Travel Budget Calculator</h2>
                        <div class="budget-calculator-content">
                            <div class="budget-input-group">
                                <label for="travel-time">Total Travel Time (Days):</label>
                                <input type="number" id="travel-time" value="0" min="0">
                            </div>
                            <div class="budget-input-group">
                                <label for="accommodation-cost">Accommodation Cost :</label>
                                <input type="number" id="accommodation-cost" value="0" min="0">
                            </div>
                            <div class="budget-input-group">
                                <label for="food-drinks-cost">Food & Drinks Cost :</label>
                                <input type="number" id="food-drinks-cost" value="0" min="0">
                            </div>
                            <div class="budget-input-group">
                                <label for="miscellaneous-cost">Miscellaneous Cost :</label>
                                <input type="number" id="miscellaneous-cost" value="0" min="0">
                            </div>
                            <div class="budget-input-group">
                                <label for="number-of-travellers">Number of Travellers:</label>
                                <input type="number" id="number-of-travellers" value="1" min="1">
                            </div>
                            <button class="budget-calculate-btn" id="calculate-budget-btn">Calculate Budget</button>
                            <div class="budget-result hidden" id="estimated-total-budget">
                                Estimated Total Budget: <strong>Rs.0</strong>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>

            <section class="more-info-section">
                <h2>Explore More about this Trek</h2>
                <p>Detailed information will load here.</p>

                <h3>Photo Gallery</h3>
                <div class="photo-gallery-grid">
                </div>

                <h3>Location Map</h3>
                <div class="map-and-details-wrapper">
                    <div class="map-container">
                        <iframe src="about:blank" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="map-side-content">
                        <h4>About the Region</h4>
                        <p>Information about the region will load here.</p>
                    </div>
                </div>
            </section>
        </div>
    </main>

    <footer>
        <p>© 2025 Gantabya. All rights reserved.</p>
    </footer>

    <script>
        const apiKey = 'bd5e378503939ddaee76f12ad7a97608'; // IMPORTANT: Replace with your actual OpenWeatherMap API key

        // All Destinations Data - Populate this with ALL your 30 destinations
        const allDestinations = [
            {
                id: 1,
                name: 'Everest Base Camp Trek',
                imageSrc: './img/EBC/BG.jpg',
                description: [
                    "The Everest Base Camp trek is one of the most iconic and breathtaking trekking adventures in the world. It takes you through stunning Sherpa villages, ancient monasteries, and dramatic mountain landscapes, culminating at the foot of Mount Everest, the world's highest peak. The journey typically takes around 12-14 days, including acclimatization days, and offers unparalleled views of some of the highest mountains on Earth.",
                    "Key highlights include Lukla airport (one of the most extreme airports), Namche Bazaar (the Sherpa capital), Tengboche Monastery, and of course, the Kala Patthar viewpoint for sunrise over Everest."
                   , "--- Itinerary ---",
      "Day 1: Flight to Lukla, trek to Phakding",
      "Day 2: Phakding to Namche Bazaar",
      "Day 3: Acclimatization at Namche",
      "Day 4: Namche to Tengboche",
      "Day 5: Tengboche to Dingboche",
      "Day 6: Acclimatization at Dingboche",
      "Day 7: Dingboche to Lobuche",
      "Day 8: Lobuche to Gorakshep, hike to Everest Base Camp",
      "Day 9: Hike to Kala Patthar, return to Pheriche",
      "Day 10\u201312: Trek back to Lukla",
      "Day 13: Flight back to Kathmandu",
      "--- Expense Breakdown ---",
      "Accommodation: Rs. 9,600",
      "Food: Rs. 14,400",
      "Travel (Flight): Rs. 10,000",
      "Other (Permits): Rs. 400",
      "Total (without guide/porter): Rs. 34,400",
      "Total (with guide and porter): Rs. 100,400"
                ],
                moreInfo: [
                    "The Everest Base Camp trek is not just a physical journey but a cultural immersion. You'll pass through charming Sherpa villages like Phakding and Namche Bazaar, where you can experience the unique Sherpa culture and hospitality. The trail offers breathtaking views of iconic peaks such as Ama Dablam, Lhotse, Nuptse, and of course, Mount Everest itself. Acclimatization days in Namche and Dingboche are crucial for a safe and enjoyable trek, allowing your body to adjust to the increasing altitude. The final ascent to Kala Patthar (5,545m) provides the most spectacular panoramic sunrise views of Everest and the surrounding Himalayas.",
                    "Beyond the well-trodden path, the Everest region offers opportunities for side trips to hidden valleys and less-frequented monasteries, providing a deeper connection with the Himalayan wilderness. Wildlife such as Himalayan Tahr and various bird species can be spotted, adding to the natural beauty of the journey. Local Sherpa guides and porters play a vital role in making the trek possible, and interacting with them offers invaluable insights into their resilient way of life."
                ],
                lat: '28.0042',
                lon: '86.8528',
                locationName: 'Everest Base Camp (approx.)',
                galleryImages: [
                    './img/EBC/ebc1.jpg',
                    './img/EBC/ebc2.png',
                    './img/EBC/Namche_bajar.jpg',
                    './img/EBC/TM.jpg'
                ],
                mapIframeSrc: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d86.72624419999999!3d28.0163351!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39a32d1645e99815%3A0xc3f5d60634691456!2sEverest%20Base%20Camp!5e0!3m2!1sen!2snp!4v1700000000000!5m2!1sen!2snp', // Example real map for EBC
                mapSideContent: 'The Khumbu region, home to Everest Base Camp, is a UNESCO World Heritage Site. It\'s not just about the mountains; it\'s a vibrant ecosystem with unique flora and fauna, and a rich cultural tapestry woven by the Sherpa people. The air is thin, but the views are boundless, offering a profound sense of scale and wonder. Many trekkers find the spiritual atmosphere, with prayer flags fluttering and ancient chortens, as impactful as the physical challenge.'
            },
            {
                id: 2,
                name: 'Annapurna Base Camp Trek',
                imageSrc: 'img/abc/abcbg.jpg',
                description: [
                    "The Annapurna Base Camp (ABC) trek is a spectacular journey through diverse landscapes, from lush rhododendron forests to the high alpine terrain of the Annapurna Sanctuary. It offers breathtaking close-up views of Annapurna I, Machhapuchhre (Fishtail), Hiunchuli, and other towering peaks.",
                    "This trek is generally shorter and at lower altitudes than EBC, making it a popular choice. Highlights include the hot springs at Jhinu Danda, the charming Gurung villages, and the panoramic views from ABC itself.",  "--- Itinerary ---",
    "Day 1: Drive from Pokhara to Nayapul, trek to Ghandruk",
    "Day 2: Ghandruk to Chhomrong",
    "Day 3: Chhomrong to Dovan",
    "Day 4: Dovan to Deurali",
    "Day 5: Deurali to Annapurna Base Camp",
    "Day 6: ABC to Bamboo",
    "Day 7: Bamboo to Jhinu Danda (hot spring)",
    "Day 8: Trek to Nayapul and drive back to Pokhara",

    "--- Expense Breakdown ---",
    "Accommodation: Rs. 7,000",
    "Food: Rs. 10,000",
    "Travel (Bus + Jeep): Rs. 2,200",
    "Other (Permits): Rs. 400",
    "Total (without guide/porter): Rs. 19,600",
    "Total (with guide and porter): Rs. 67,600"
                ],
                moreInfo: [
                    "The trail to Annapurna Base Camp takes you through terraced fields, dense forests, and past cascading waterfalls. You'll encounter a rich variety of flora and fauna, especially in the Annapurna Conservation Area. The trek provides a unique cultural experience, passing through traditional Gurung villages where you can interact with the local communities and learn about their way of life. The final approach into the Annapurna Sanctuary, a natural amphitheater, is truly awe-inspiring, surrounded by a ring of magnificent peaks.",
                    "Acclimatization is still important for this trek, though less critical than EBC. The best seasons to trek are spring (March-May) and autumn (September-November)."
                ],
                lat: '28.3966',
                lon: '83.8646',
                locationName: 'Annapurna Base Camp',
                galleryImages: [
                    'img/abc/1.jpeg',
                    'img/abc/2.jpg',
                    'img/abc/abcbg.jpg',
                    'img/abc/1.jpeg',
                ],
                mapIframeSrc: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d83.757755!3d28.3966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399581c6204c32b9%3A0x6b306e12e12e12e!2sAnnapurna%20Base%20Camp!5e0!3m2!1sen!2snp!4v1700000000001!5m2!1sen!2snp',
                mapSideContent: 'The Annapurna region is famous for its diverse trekking routes, vibrant local culture, and stunning mountain scenery. It encompasses a wide range of ecosystems, from subtropical forests to high-altitude deserts, and is home to various ethnic groups. The Annapurna Conservation Area is Nepal\'s first and largest conservation area, protecting its rich biodiversity. Trekkers are rewarded with spectacular views of some of the world\'s highest peaks and a deep insight into Himalayan life.'
            },
            {
                id: 3,
                name: 'Langtang Valley Trek',
                imageSrc: 'img/Lang/la1.jpg',
                description: [
                    "The Langtang Valley Trek offers a stunning journey into the heart of the Himalayas, just north of Kathmandu. It’s known for its pristine alpine landscapes, rich Tamang culture, and impressive mountain views of Langtang Lirung.",
                    "The trail traverses rhododendron forests, glacial streams, and charming villages, making it perfect for those seeking beauty and culture in a shorter trek."
                , "--- Itinerary ---",
      "Day 1: Drive from Kathmandu to Syabrubesi",
      "Day 2: Trek to Lama Hotel",
      "Day 3: Lama Hotel to Langtang Village",
      "Day 4: Langtang to Kyanjin Gompa",
      "Day 5: Explore Tserko Ri / Kyanjin Ri",
      "Day 6: Return to Lama Hotel",
      "Day 7: Trek back to Syabrubesi",
      "Day 8: Drive back to Kathmandu",
      "--- Expense Breakdown ---",
      "Accommodation: Rs. 4,200",
      "Food: Rs. 7,000",
      "Travel (Bus): Rs. 1,200",
      "Other (Permits): Rs. 100",
      "Total (without guide/porter): Rs. 12,500",
      "Total (with guide and porter): Rs. 44,000"
            
            ],
                moreInfo: [
                    "Langtang National Park is home to rare wildlife like red pandas and Himalayan tahr. Kyanjin Gompa is a spiritual and scenic highlight, where trekkers can explore a Buddhist monastery and nearby glacial viewpoints.",
                    "Due to the 2015 earthquake, the region has rebuilt with resilient communities. Trekking here not only supports local livelihoods but offers authentic Himalayan hospitality. It's an ideal trek for those with limited time but high expectations."
                ],
                lat: '28.2500',
                lon: '85.5000',
                locationName: 'Langtang Valley, Nepal',
                galleryImages: [
                    'img/Lang/la2.jpeg',
                    'img/Lang/la3.jpeg',
                    'img/Lang/la4.jpeg',
                    'img/Lang/la5.jpeg'
                ],
                mapIframeSrc: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3530.704711!2d85.5!3d28.25!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sLangtang+Valley!5e0!3m2!1sen!2snp!4v1700000000003!5m2!1sen!2snp',
                mapSideContent: 'The Langtang region offers a perfect blend of accessibility, cultural richness, and natural grandeur. With less crowding than Annapurna or Everest regions, trekkers here find serenity among the peaks, and meaningful encounters with local Tamang communities.'
            },
            {
                id: 4,
                name: 'Ghorepani Poon Hill Trek',
                imageSrc: 'img/GPH/ghan.jpeg',
                description: [
                    "Ghorepani Poon Hill Trek is famous for sunrise views over the Annapurna and Dhaulagiri ranges.",
                    "This trek passes through Gurung and Magar villages rich in cultural heritage.",
                    "Typical local food includes dal bhat, lentil soup, and seasonal vegetables.",
                    "The trail goes through lush rhododendron forests and terraced fields.",
                  "--- Itinerary ---",
      "Day 1: Drive from Pokhara to Nayapul, trek to Tikhedhunga",
      "Day 2: Tikhedhunga to Ghorepani",
      "Day 3: Early hike to Poon Hill, then to Tadapani",
      "Day 4: Tadapani to Ghandruk",
      "Day 5: Ghandruk to Nayapul, drive to Pokhara",
      "--- Expense Breakdown ---",
      "Accommodation: Rs. 3,000",
      "Food: Rs. 5,000",
      "Travel (Local Bus): Rs. 1,200",
      "Other (Permits): Rs. 400",
      "Total (without guide/porter): Rs. 9,600",
      "Total (with guide and porter): Rs. 33,600"
                ],
                moreInfo: [
                    "This is one of the most popular short treks in Nepal, renowned for the panoramic sunrise view over the Annapurna and Dhaulagiri ranges from Poon Hill.",
                    "Ideal for beginners, families, or trekkers short on time, this trek combines mountain vistas, rhododendron forests, and welcoming Gurung villages.",
                    "The trek typically starts from Nayapul and ascends through Ulleri, Ghorepani, and Ghandruk. It’s particularly breathtaking in spring when rhododendrons bloom in full color.",
                    "From Poon Hill, trekkers are rewarded with a 360-degree view of snow-capped giants, including Annapurna South, Machhapuchhre, and Dhaulagiri. The trail is well-maintained and accessible year-round."
                ],
                lat: '28.4000',
                lon: '83.6920',
                locationName: 'Poon Hill, Nepal',
                galleryImages: [
                    'img/GPH/gho.jpeg',
                    'img/GPH/po1.jpeg',
                    'img/GPH/po2.jpeg',
                    'img/GPH/po3.jpeg'
                ],
                mapIframeSrc: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d83.692!3d28.4!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995f3c81aeb7033%3A0xb3cce9d4b!2sPoon+Hill!5e0!3m2!1sen!2snp!4v1700000000004!5m2!1sen!2snp',
                mapSideContent: 'Poon Hill is a renowned viewpoint in the Annapurna region. At just over 3,200 meters, it offers one of the best sunrise views in Nepal. Combined with the warmth of Gurung hospitality and lush greenery, it creates a perfect trekking experience.'
            },
            {
                id: 5,
                name: 'Manaslu Circuit Trek',
                imageSrc: 'img/MANA/cul.jpeg',
                description: [
                    "The Manaslu Circuit Trek circles the majestic Mt. Manaslu, the 8th highest mountain in the world. It's a challenging yet culturally rich trek through remote Himalayan terrain and Tibetan-influenced villages.",
                    "With fewer crowds and more raw wilderness, this trek is a great alternative to the Annapurna Circuit."
               ,"--- Itinerary ---",
      "Day 1: Drive from Kathmandu to Soti Khola",
      "Day 2: Trek to Machha Khola",
      "Day 3: Machha Khola to Jagat",
      "Day 4: Jagat to Deng",
      "Day 5: Deng to Namrung",
      "Day 6: Namrung to Samagaon",
      "Day 7: Acclimatization at Samagaon",
      "Day 8: Samagaon to Samdo",
      "Day 9: Samdo to Dharamsala",
      "Day 10: Cross Larke Pass to Bimthang",
      "Day 11: Bimthang to Dharapani",
      "Day 12: Drive back to Kathmandu",
      "--- Expense Breakdown ---",
      "Accommodation: Rs. 6,000",
      "Food: Rs. 9,000",
      "Travel: Rs. 2,500",
      "Other (Permits): Rs. 1,000",
      "Total (without guide/porter): Rs. 18,500",
      "Total (with guide and porter): Rs. 62,500"
             ],
                moreInfo: [
                    "Traversing through Budhi Gandaki Valley, trekkers witness dramatic gorges, suspension bridges, and diverse ethnic settlements like Samagaon and Lho. The high point is Larkya La Pass (5,160m), offering jaw-dropping views.",
                    "The region is a restricted trekking area, requiring a special permit and guide. It’s known for its biodiversity, Buddhist culture, and the blend of rugged nature and heritage."
                ],
                lat: '28.5583',
                lon: '84.5611',
                locationName: 'Manaslu Region, Nepal',
                galleryImages: [
                    'img/MANA/lak.jpeg',
                    'img/MANA/man1.jpeg',
                    'img/MANA/man2.jpeg',
                    'img/MANA/man3.jpeg'
                ],
                mapIframeSrc: 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.5611!3d28.5583!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x399794d3e2cfad01%3A0xd7a8283fa1b89d88!2sManaslu+Circuit!5e0!3m2!1sen!2snp!4v1700000000005!5m2!1sen!2snp',
                mapSideContent: 'The Manaslu region offers an off-the-beaten-path Himalayan experience. It’s a culturally enriching journey through ancient Tibetan monasteries, yak pastures, and breathtaking alpine scenery. This trek suits adventurous spirits seeking solitude and authenticity.'
            },
            {
    "id": 6,
    "name": "Upper Mustang Trek",
    "imageSrc": "img/UPM/mu3.jpeg",
    "description": [
        "Upper Mustang Trek offers trekkers an unforgettable journey through the Mustang Region of Nepal. Experience Tibetan culture and arid landscapes.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    , "--- Itinerary ---",
      "Day 1: Drive to Pokhara",
      "Day 2: Fly to Jomsom, trek to Kagbeni",
      "Day 3: Kagbeni to Chele",
      "Day 4: Chele to Syangboche",
      "Day 5: Syangboche to Ghami",
      "Day 6: Ghami to Tsarang",
      "Day 7: Tsarang to Lo Manthang",
      "Day 8: Explore Lo Manthang",
      "Day 9: Lo Manthang to Drakmar",
      "Day 10: Drakmar to Ghiling",
      "Day 11: Ghiling to Chhuksang",
      "Day 12: Chhuksang to Jomsom",
      "Day 13: Fly to Pokhara and return",
      "--- Expense Breakdown ---",
      "Accommodation: Rs. 7,500",
      "Food: Rs. 11,000",
      "Travel (Bus + Flight): Rs. 5,000",
      "Other (Permits): Rs. 2,000",
      "Total (without guide/porter): Rs. 25,500",
      "Total (with guide and porter): Rs. 73,500"
],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Mustang Region, Nepal",
    "galleryImages": [
       "img/UPM/mus(1).jpeg",
       "img/UPM/mus(2).jpeg",
       "img/UPM/mus(3).jpeg",
       "img/UPM/mu4s(4).jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sUpper+Mustang+Trek!5e0!3m2!1sen!2snp!4v1700000000006!5m2!1sen!2snp",
    "mapSideContent": "Upper Mustang Trek showcases the raw beauty and cultural depth of the Mustang Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 7,
    "name": "Kanchenjunga Base Camp Trek",
    "imageSrc": "img/KAN/ka3.jpeg",
    "description": [
        "Kanchenjunga Base Camp Trek offers trekkers an unforgettable journey through the Kanchenjunga Region of Nepal. Explore the remote base of the world\u2019s third highest peak.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
   ,"--- Itinerary ---",
      "Day 1: Flight to Bhadrapur, drive to Taplejung",
      "Day 2\u20134: Trek through Chiruwa, Sekathum, Amjilosa",
      "Day 5\u20137: Trek to Ghunsa, then to Lhonak",
      "Day 8: Hike to Pangpema (Kanchenjunga Base Camp)",
      "Day 9\u201313: Return to Taplejung",
      "Day 14: Return to Kathmandu",
      "--- Expense Breakdown ---",
      "Accommodation: Rs. 8,000",
      "Food: Rs. 12,000",
      "Travel: Rs. 5,000",
      "Other (Permits): Rs. 1,000",
      "Total (without guide/porter): Rs. 26,000",
      "Total (with guide and porter): Rs. 78,000"
 ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Kanchenjunga Region, Nepal",
    "galleryImages": [
        "img/KAN/ka5.jpeg",
        "img/KAN/ka6.jpeg",
        "img/KAN/ka7.jpeg",
        "img/KAN/ka8.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sKanchenjunga+Base+Camp+Trek!5e0!3m2!1sen!2snp!4v1700000000007!5m2!1sen!2snp",
    "mapSideContent": "Kanchenjunga Base Camp Trek showcases the raw beauty and cultural depth of the Kanchenjunga Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 8,
    "name": "Everest Three Passes Trek",
    "imageSrc": "img/ETP/eve2.jpeg",
    "description": [
        "Everest Three Passes Trek offers trekkers an unforgettable journey through the Khumbu Region of Nepal. The ultimate challenge in the Everest region.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    , "--- Itinerary ---",
      "Day 1\u20134: Lukla to Dingboche via Namche",
      "Day 5: Cross Kongma La to Lobuche",
      "Day 6: Trek to Everest Base Camp and back to Gorakshep",
      "Day 7: Kala Patthar hike and Dzongla",
      "Day 8: Cross Cho La to Gokyo",
      "Day 9: Gokyo Ri climb",
      "Day 10: Cross Renjo La to Lungden",
      "Day 11\u201313: Return to Lukla",
      "--- Expense Breakdown ---",
      "Accommodation: Rs. 10,000",
      "Food: Rs. 15,000",
      "Travel (Flight): Rs. 10,000",
      "Other (Permits): Rs. 400",
      "Total (without guide/porter): Rs. 35,400",
      "Total (with guide and porter): Rs. 105,400" ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Khumbu Region, Nepal",
    "galleryImages": [
       "img/ETP/eve5.jpeg",
       "img/ETP/eve6.jpeg",
       "img/ETP/eve7.jpeg",
       "img/ETP/eve8.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sEverest+Three+Passes+Trek!5e0!3m2!1sen!2snp!4v1700000000008!5m2!1sen!2snp",
    "mapSideContent": "Everest Three Passes Trek showcases the raw beauty and cultural depth of the Khumbu Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 9,
    "name": "Mardi Himal Base Camp Trek",
    "imageSrc":  "img/MHBC/mar2.jpeg",
    "description": [
        "Mardi Himal Base Camp Trek offers trekkers an unforgettable journey through the Annapurna Region of Nepal. A short and scenic trek in the Annapurna range.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    , "--- Itinerary ---",
      "Day 1: Drive from Pokhara to Kande, trek to Forest Camp",
      "Day 2: Forest Camp to High Camp",
      "Day 3: Hike to Mardi Himal Base Camp, return to Low Camp",
      "Day 4: Trek to Siding, drive back to Pokhara",
      "--- Expense Breakdown ---",
      "Accommodation: Rs. 2,500",
      "Food: Rs. 4,000",
      "Travel: Rs. 1,000",
      "Other (Permits): Rs. 400",
      "Total (without guide/porter): Rs. 7,900",
      "Total (with guide and porter): Rs. 27,900"],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Annapurna Region, Nepal",
    "galleryImages": [
        "img/MHBC/mar6.jpeg",
         "img/MHBC/mar7.jpeg",
          "img/MHBC/mar8.jpeg",
           "img/MHBC/mar9.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMardi+Himal+Base+Camp+Trek!5e0!3m2!1sen!2snp!4v1700000000009!5m2!1sen!2snp",
    "mapSideContent": "Mardi Himal Base Camp Trek showcases the raw beauty and cultural depth of the Annapurna Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 10,
    "name": "Rara Lake Trek",
    "imageSrc": "img/RARA/ra2.jpeg",
    "description": [
        "Rara Lake Trek offers trekkers an unforgettable journey through the Mugu District of Nepal. Nepal\u2019s largest and most serene lake destination.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    , "--- Itinerary ---",
      "Day 1: Flight to Nepalgunj",
      "Day 2: Flight to Jumla, trek to Chere Chaur",
      "Day 3\u20134: Trek to Rara Lake via Chala Chaur",
      "Day 5: Rest day at Rara Lake",
      "Day 6\u20137: Return to Jumla",
      "Day 8: Fly back to Kathmandu",
      "--- Expense Breakdown ---",
      "Accommodation: Rs. 5,000",
      "Food: Rs. 7,000",
      "Travel (Flights): Rs. 6,000",
      "Other (Permits): Rs. 500",
      "Total (without guide/porter): Rs. 18,500",
      "Total (with guide and porter): Rs. 54,500" ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Mugu District, Nepal",
    "galleryImages": [
        "img/RARA/ra3(1).jpeg",
        "img/RARA/ra3(2).jpeg",
        "img/RARA/ra3(3).jpeg",
        "img/RARA/ra3(4).jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sRara+Lake+Trek!5e0!3m2!1sen!2snp!4v17000000000010!5m2!1sen!2snp",
    "mapSideContent": "Rara Lake Trek showcases the raw beauty and cultural depth of the Mugu District. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 11,
    "name": "Upper Dolpo Trek",
    "imageSrc":  "img/UDT/ud2.jpeg",
    "description": [
        "Upper Dolpo Trek offers trekkers an unforgettable journey through the Dolpo Region of Nepal. Ancient traditions in an isolated wilderness.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    , "--- Itinerary ---",
      "Day 1\u20133: Flights to Juphal, trek to Dunai and Tarakot",
      "Day 4\u20137: Trek through Dho Tarap to Numa La Base",
      "Day 8\u201310: Cross Numa La and Baga La to Ringmo",
      "Day 11: Visit Shey Phoksundo Lake",
      "Day 12\u201315: Return to Juphal",
      "--- Expense Breakdown ---",
      "Accommodation: Rs. 8,000",
      "Food: Rs. 12,000",
      "Travel (Flights): Rs. 6,000",
      "Other (Permits): Rs. 2,000",
      "Total (without guide/porter): Rs. 28,000",
      "Total (with guide and porter): Rs. 82,000" ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Dolpo Region, Nepal",
    "galleryImages": [
        "img/UDT/ud1.jpeg",
         "img/UDT/ud2.jpeg",
          "img/UDT/ud3.jpeg",
           "img/UDT/ud1.jpeg",
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sUpper+Dolpo+Trek!5e0!3m2!1sen!2snp!4v17000000000011!5m2!1sen!2snp",
    "mapSideContent": "Upper Dolpo Trek showcases the raw beauty and cultural depth of the Dolpo Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 12,
    "name": "Pikey Peak Trek",
    "imageSrc":"img/PPT/pp3.jpeg",
    "description": [
        "Pikey Peak Trek offers trekkers an unforgettable journey through the Everest Region of Nepal. Panoramic Everest views from a less-known trail.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    , "--- Itinerary ---",
      "Day 1: Drive to Dhap",
      "Day 2: Trek to Jhapre",
      "Day 3: Trek to Pikey Base Camp",
      "Day 4: Hike to Pikey Peak, descend to Loding",
      "Day 5: Trek to Phaplu, drive/fly back",
      "--- Expense Breakdown ---",
      "Accommodation: Rs. 3,000",
      "Food: Rs. 5,000",
      "Travel: Rs. 2,000",
      "Other (Permits): Rs. 100",
      "Total (without guide/porter): Rs. 10,100",
      "Total (with guide and porter): Rs. 36,100" ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Everest Region, Nepal",
    "galleryImages": [
       "img/PPT/pp4.jpeg",
       "img/PPT/pp5.jpeg",
       "img/PPT/pp6.jpeg",
       "img/PPT/pp7.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sPikey+Peak+Trek!5e0!3m2!1sen!2snp!4v17000000000012!5m2!1sen!2snp",
    "mapSideContent": "Pikey Peak Trek showcases the raw beauty and cultural depth of the Everest Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 13,
    "name": "Tsum Valley Trek",
    "imageSrc": "img/TVT/tv2.jpeg",
    "description": [
        "Tsum Valley Trek offers trekkers an unforgettable journey through the Manaslu Region of Nepal. A sacred and culturally rich hidden valley.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    , "--- Itinerary ---",
      "Day 1\u20134: Drive to Soti Khola, trek to Lokpa",
      "Day 5\u20137: Trek through Chhokang Paro to Mu Gompa",
      "Day 8\u201310: Explore and return to Lokpa",
      "Day 11\u201313: Return to Arughat and Kathmandu",
      "--- Expense Breakdown (in NPR for local tourists) ---",
      "Accommodation: Rs. 5,500",
      "Food: Rs. 8,000",
      "Travel: Rs. 2,500",
      "Other (Permits): Rs. 1,000",
      "Total (without guide/porter): Rs. 17,000",
      "Total (with guide and porter): Rs. 61,000"
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Manaslu Region, Nepal",
    "galleryImages": [
       "img/TVT/tv4.jpeg",
       "img/TVT/tv5.jpeg",
       "img/TVT/tv6.jpeg",
       "img/TVT/tv7.jpeg",
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sTsum+Valley+Trek!5e0!3m2!1sen!2snp!4v17000000000013!5m2!1sen!2snp",
    "mapSideContent": "Tsum Valley Trek showcases the raw beauty and cultural depth of the Manaslu Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 14,
    "name": "Makalu Base Camp Trek",
    "imageSrc": "img/MBCT/mak2.jpeg",
    "description": [
        "Makalu Base Camp Trek offers trekkers an unforgettable journey through the Makalu Barun National Park of Nepal. Wild and challenging trek to the fifth highest peak.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    , "--- Itinerary ---",
      "Day 1: Flight to Tumlingtar, drive to Chichila",
      "Day 2\u20135: Trek through Num, Seduwa, Tashigaon",
      "Day 6\u20139: Cross Shipton La, trek to Makalu Base Camp",
      "Day 10\u201314: Return to Chichila, fly back to Kathmandu",
      "--- Expense Breakdown (in NPR for local tourists) ---",
      "Accommodation: Rs. 6,000",
      "Food: Rs. 9,000",
      "Travel: Rs. 4,000",
      "Other (Permits): Rs. 1,000",
      "Total (without guide/porter): Rs. 20,000",
      "Total (with guide and porter): Rs. 64,000"],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Makalu Barun National Park, Nepal",
    "galleryImages": [
       "img/MBCT/mak9.jpeg",
       "img/MBCT/mak5.jpeg",
       "img/MBCT/mak7.jpeg",
       "img/MBCT/mak6.jpeg",
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMakalu+Base+Camp+Trek!5e0!3m2!1sen!2snp!4v17000000000014!5m2!1sen!2snp",
    "mapSideContent": "Makalu Base Camp Trek showcases the raw beauty and cultural depth of the Makalu Barun National Park. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 15,
    "name": "Upper Mustang (Lo Manthang) Trek",
    "imageSrc": "img/UMLM/um2.jpeg",
    "description": [
        "Upper Mustang (Lo Manthang) Trek offers trekkers an unforgettable journey through the Mustang Region of Nepal. Explore the ancient walled city of Lo Manthang.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Mustang Region, Nepal",
    "galleryImages": [
       "img/UMLM/um4.jpeg",
       "img/UMLM/um6.jpeg",
       "img/UMLM/um5.jpeg",
       "img/UMLM/um7.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sUpper+Mustang+(Lo+Manthang)+Trek!5e0!3m2!1sen!2snp!4v17000000000015!5m2!1sen!2snp",
    "mapSideContent": "Upper Mustang (Lo Manthang) Trek showcases the raw beauty and cultural depth of the Mustang Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 16,
    "name": "Gosaikunda Lake Trek",
    "imageSrc": "img/GLT/go3.jpeg",
    "description": [
        "Gosaikunda Lake Trek offers trekkers an unforgettable journey through the Langtang Region of Nepal. Alpine lake pilgrimage in the Himalayas.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Langtang Region, Nepal",
    "galleryImages": [
        "img/GLT/go5.jpeg",
        "img/GLT/go6.jpeg",
        "img/GLT/go7.jpeg",
        "img/GLT/go8.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sGosaikunda+Lake+Trek!5e0!3m2!1sen!2snp!4v17000000000016!5m2!1sen!2snp",
    "mapSideContent": "Gosaikunda Lake Trek showcases the raw beauty and cultural depth of the Langtang Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 17,
    "name": "Ruby Valley Trek",
    "imageSrc":"img/RVT/ru1.jpeg",
    "description": [
        "Ruby Valley Trek offers trekkers an unforgettable journey through the Ganesh Himal Region of Nepal. Remote beauty and cultural encounters.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Ganesh Himal Region, Nepal",
    "galleryImages": [
       "img/RVT/ru6.jpeg",
       "img/RVT/ru7.jpeg",
       "img/RVT/ru5.jpeg",
       "img/RVT/ru4.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sRuby+Valley+Trek!5e0!3m2!1sen!2snp!4v17000000000017!5m2!1sen!2snp",
    "mapSideContent": "Ruby Valley Trek showcases the raw beauty and cultural depth of the Ganesh Himal Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 18,
    "name": "Tamang Heritage Trail",
    "imageSrc": "img/THT/tam2.jpeg",
    "description": [
        "Tamang Heritage Trail offers trekkers an unforgettable journey through the Langtang Region of Nepal. Immerse in Tamang culture and mountain views.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Langtang Region, Nepal",
    "galleryImages": [
       "img/THT/tam4.jpeg",
       "img/THT/tam5.jpeg",
       "img/THT/tam6.jpeg",
       "img/THT/tam7.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sTamang+Heritage+Trail!5e0!3m2!1sen!2snp!4v17000000000018!5m2!1sen!2snp",
    "mapSideContent": "Tamang Heritage Trail showcases the raw beauty and cultural depth of the Langtang Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 19,
    "name": "Helambu Trek",
    "imageSrc": "img/HET/hel3.jpeg",
    "description": [
        "Helambu Trek offers trekkers an unforgettable journey through the Langtang Region of Nepal. Easy trek near Kathmandu with Sherpa heritage.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Langtang Region, Nepal",
    "galleryImages": [
       "img/HET/hel4.jpeg",
       "img/HET/hel5.jpeg",
       "img/HET/hel6.jpeg",
       "img/HET/hel7.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sHelambu+Trek!5e0!3m2!1sen!2snp!4v17000000000019!5m2!1sen!2snp",
    "mapSideContent": "Helambu Trek showcases the raw beauty and cultural depth of the Langtang Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 20,
    "name":"img/KRT/ko2.jpeg",
    "imageSrc": "https://placehold.co/800x350/8B4513/FFFFFF?text=Khopra+Ridge",
    "description": [
        "Khopra Ridge Trek offers trekkers an unforgettable journey through the Annapurna Region of Nepal. Stunning alternative to Ghorepani with ridge views.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Annapurna Region, Nepal",
    "galleryImages": [
       "img/KRT/ko4.jpeg",
       "img/KRT/ko5.jpeg",
       "img/KRT/ko6.jpeg",
       "img/KRT/ko7.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sKhopra+Ridge+Trek!5e0!3m2!1sen!2snp!4v17000000000020!5m2!1sen!2snp",
    "mapSideContent": "Khopra Ridge Trek showcases the raw beauty and cultural depth of the Annapurna Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 21,
    "name": "Dhaulagiri Circuit Trek",
    "imageSrc": "img/DCT/dh3.jpeg",
    "description": [
        "Dhaulagiri Circuit Trek offers trekkers an unforgettable journey through the Dhaulagiri Region of Nepal. Remote circumnavigation of Dhaulagiri massif.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Dhaulagiri Region, Nepal",
    "galleryImages": [
       "img/DCT/dh4.jpeg",
       "img/DCT/dh5.jpeg",
       "img/DCT/dh6.jpeg",
       "img/DCT/dh7.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sDhaulagiri+Circuit+Trek!5e0!3m2!1sen!2snp!4v17000000000021!5m2!1sen!2snp",
    "mapSideContent": "Dhaulagiri Circuit Trek showcases the raw beauty and cultural depth of the Dhaulagiri Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 22,
    "name": "Nar Phu Valley Trek",
    "imageSrc": "img/NPVT/nar2.jpeg",
    "description": [
        "Nar Phu Valley Trek offers trekkers an unforgettable journey through the Annapurna Region of Nepal. Trek through isolated valleys and old monasteries.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Annapurna Region, Nepal",
    "galleryImages": [
       "img/NPVT/nar4.jpeg",
       "img/NPVT/nar5.jpeg",
       "img/NPVT/nar6.jpeg",
       "img/NPVT/nar7.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sNar+Phu+Valley+Trek!5e0!3m2!1sen!2snp!4v17000000000022!5m2!1sen!2snp",
    "mapSideContent": "Nar Phu Valley Trek showcases the raw beauty and cultural depth of the Annapurna Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 23,
    "name": "Chisapani Nagarkot Trek",
    "imageSrc": "img/CNT/chi2.jpeg",
    "description": [
        "Chisapani Nagarkot Trek offers trekkers an unforgettable journey through the Kathmandu Valley Rim of Nepal. Quick trek for sunrise views near the capital.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Kathmandu Valley Rim, Nepal",
    "galleryImages": [
       "img/CNT/chi4.jpeg",
       "img/CNT/chi6.jpeg",
       "img/CNT/chi5.jpeg",
       "img/CNT/chi7.jpeg",
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sChisapani+Nagarkot+Trek!5e0!3m2!1sen!2snp!4v17000000000023!5m2!1sen!2snp",
    "mapSideContent": "Chisapani Nagarkot Trek showcases the raw beauty and cultural depth of the Kathmandu Valley Rim. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 24,
    "name": "Api Base Camp Trek",
    "imageSrc": "img/ABCT/api2.jpeg",
    "description": [
        "Api Base Camp Trek offers trekkers an unforgettable journey through the Far Western Nepal of Nepal. Wilderness adventure to the base of Mt. Api.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Far Western Nepal, Nepal",
    "galleryImages": [
      "img/ABCT/api4.jpeg",
      "img/ABCT/api5.jpeg",
      "img/ABCT/api6.jpeg",
      "img/ABCT/api7.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sApi+Base+Camp+Trek!5e0!3m2!1sen!2snp!4v17000000000024!5m2!1sen!2snp",
    "mapSideContent": "Api Base Camp Trek showcases the raw beauty and cultural depth of the Far Western Nepal. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 25,
    "name": "Mohare Danda Trek",
    "imageSrc":"img/MDT/mo3.jpeg",
    "description": [
        "Mohare Danda Trek offers trekkers an unforgettable journey through the Annapurna Region of Nepal. Eco-community trek with panoramic views.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Annapurna Region, Nepal",
    "galleryImages": [
      "img/MDT/mo4.jpeg",
      "img/MDT/mo5.jpeg",
      "img/MDT/mo6.jpeg",
      "img/MDT/mo7.jpeg"

    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sMohare+Danda+Trek!5e0!3m2!1sen!2snp!4v17000000000025!5m2!1sen!2snp",
    "mapSideContent": "Mohare Danda Trek showcases the raw beauty and cultural depth of the Annapurna Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 26,
    "name": "Lower Dolpo (Shey Gompa) Trek",
    "imageSrc": "img/LDSGT/ld2.jpeg",
    "description": [
        "Lower Dolpo (Shey Gompa) Trek offers trekkers an unforgettable journey through the Dolpo Region of Nepal. Mystical land of gompas and spiritual landscapes.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Dolpo Region, Nepal",
    "galleryImages": [
      "img/LDSGT/ld4.jpeg",
      "img/LDSGT/ld5.jpeg",
      "img/LDSGT/ld6.jpeg",
      "img/LDSGT/ld7.jpeg",
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sLower+Dolpo+(Shey+Gompa)+Trek!5e0!3m2!1sen!2snp!4v17000000000026!5m2!1sen!2snp",
    "mapSideContent": "Lower Dolpo (Shey Gompa) Trek showcases the raw beauty and cultural depth of the Dolpo Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 27,
    "name": "Amphu Lapcha Pass Trek",
    "imageSrc": "img/ALPT/am2.jpeg",

    "description": [
        "Amphu Lapcha Pass Trek offers trekkers an unforgettable journey through the Khumbu Region of Nepal. Technical pass for seasoned adventurers.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Khumbu Region, Nepal",
    "galleryImages": [
       "img/ALPT/am7.jpeg",
       "img/ALPT/am5.jpeg",
       "img/ALPT/am6.jpeg",
       "img/ALPT/am4.jpeg",

    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sAmphu+Lapcha+Pass+Trek!5e0!3m2!1sen!2snp!4v17000000000027!5m2!1sen!2snp",
    "mapSideContent": "Amphu Lapcha Pass Trek showcases the raw beauty and cultural depth of the Khumbu Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 28,
    "name": "Limbu Cultural Trail",
    "imageSrc":  "img/LCT/lc2.jpeg",

    "description": [
        "Limbu Cultural Trail offers trekkers an unforgettable journey through the Eastern Nepal of Nepal. Discover the vibrant Limbu culture and heritage.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Eastern Nepal, Nepal",
    "galleryImages": [
         "img/LCT/lc1.jpeg",
          "img/LCT/lc4.jpeg",
           "img/LCT/lc5.jpeg",
            "img/LCT/lc7.jpeg"

    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sLimbu+Cultural+Trail!5e0!3m2!1sen!2snp!4v17000000000028!5m2!1sen!2snp",
    "mapSideContent": "Limbu Cultural Trail showcases the raw beauty and cultural depth of the Eastern Nepal. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 29,
    "name": "Rolwaling Tashi Lapcha Pass Trek",
    "imageSrc": "img/RTLPT/ro2.jpeg",
    "description": [
        "Rolwaling Tashi Lapcha Pass Trek offers trekkers an unforgettable journey through the Rolwaling Region of Nepal. Cross a thrilling high pass linking two valleys.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Rolwaling Region, Nepal",
    "galleryImages": [
       "img/RTLPT/ro4.jpeg",
       "img/RTLPT/ro5.jpeg",
       "img/RTLPT/ro6.jpeg",
       "img/RTLPT/ro7.jpeg"
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sRolwaling+Tashi+Lapcha+Pass+Trek!5e0!3m2!1sen!2snp!4v17000000000029!5m2!1sen!2snp",
    "mapSideContent": "Rolwaling Tashi Lapcha Pass Trek showcases the raw beauty and cultural depth of the Rolwaling Region. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
},
{
    "id": 30,
    "name": "Chepang Hill Trail",
    "imageSrc":  "img/CHT/ch3.jpeg",
    "description": [
        "Chepang Hill Trail offers trekkers an unforgettable journey through the Chitwan District of Nepal. Cultural trek with stunning Himalayan views.",
        "This trek combines natural wonders with cultural experiences, making it ideal for those seeking more than just scenic beauty."
    ],
    "moreInfo": [
        "Along the way, trekkers encounter local villages, diverse landscapes, and opportunities to connect with authentic Himalayan culture. Wildlife, ancient monasteries, and high-altitude views add to the richness of the journey.",
        "Best seasons for this trek vary, but spring and autumn generally provide clear skies and moderate conditions. It is suitable for moderately fit to experienced trekkers depending on the route."
    ],
    "lat": "28.0000",
    "lon": "84.0000",
    "locationName": "Chitwan District, Nepal",
    "galleryImages": [
        "img/CHT/ch4.jpeg",
         "img/CHT/ch5.jpeg",
          "img/CHT/ch6.jpeg",
           "img/CHT/ch7.jpeg"
            
    ],
    "mapIframeSrc": "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d112349.5446452292!2d84.0!3d28.0!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sChepang+Hill+Trail!5e0!3m2!1sen!2snp!4v17000000000030!5m2!1sen!2snp",
    "mapSideContent": "Chepang Hill Trail showcases the raw beauty and cultural depth of the Chitwan District. Trekkers can expect breathtaking vistas, deep cultural roots, and a profound connection with the high Himalayas throughout the journey."
            }
        ];

        // Function to fetch weather data from OpenWeatherMap
        async function fetchWeatherData(lat, lon, locationName) {
            const weatherCard = document.getElementById('weather-forecast-card');
            const weatherLoading = weatherCard.querySelector('.weather-loading-message');
            const weatherContent = weatherCard.querySelector('.weather-content');
            const weatherError = weatherCard.querySelector('.weather-error-message');

            weatherLoading.classList.remove('hidden');
            weatherContent.classList.add('hidden');
            weatherError.classList.add('hidden');

            try {
                const response = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`);
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                const data = await response.json();

                weatherCard.querySelector('.weather-location').textContent = locationName;
                weatherCard.querySelector('.weather-temperature').textContent = `${Math.round(data.main.temp)}°C`;
                weatherCard.querySelector('.weather-icon-img').src = `https://openweathermap.org/img/wn/${data.weather[0].icon}@2x.png`;
                weatherCard.querySelector('.weather-icon-img').alt = data.weather[0].description;
                weatherCard.querySelector('.weather-description').textContent = data.weather[0].description;
                weatherCard.querySelector('.weather-feels-like').textContent = `${Math.round(data.main.feels_like)}°C`;
                weatherCard.querySelector('.weather-humidity').textContent = `${data.main.humidity}%`;
                weatherCard.querySelector('.weather-wind').textContent = `${data.wind.speed} m/s`;
                weatherCard.querySelector('.weather-pressure').textContent = `${data.main.pressure} hPa`;

                weatherLoading.classList.add('hidden');
                weatherContent.classList.remove('hidden');
            } catch (error) {
                console.error('Error fetching weather data:', error);
                weatherLoading.classList.add('hidden');
                weatherError.classList.remove('hidden');
            }
        }

        // Budget Calculator Logic
        document.addEventListener('DOMContentLoaded', () => {
            const calculateBudgetBtn = document.getElementById('calculate-budget-btn');
            if (calculateBudgetBtn) {
                calculateBudgetBtn.addEventListener('click', () => {
                    const travelTime = parseFloat(document.getElementById('travel-time').value) || 0;
                    const accommodationCost = parseFloat(document.getElementById('accommodation-cost').value) || 0;
                    const foodDrinksCost = parseFloat(document.getElementById('food-drinks-cost').value) || 0;
                    const miscellaneousCost = parseFloat(document.getElementById('miscellaneous-cost').value) || 0;
                    const numberOfTravellers = parseFloat(document.getElementById('number-of-travellers').value) || 1; // Default to 1 traveller

                    // Exclude transportation cost and multiply by number of travellers
                    let totalBudget = (accommodationCost + foodDrinksCost + miscellaneousCost) * numberOfTravellers;

                    // A simple per-day cost multiplication
                    if (travelTime > 0) {
                        totalBudget = totalBudget * travelTime;
                    }

                    const estimatedTotalBudgetElement = document.getElementById('estimated-total-budget');
                    estimatedTotalBudgetElement.querySelector('strong').textContent = `Rs.${totalBudget.toFixed(2)}`;
                    estimatedTotalBudgetElement.classList.remove('hidden');
                });
            } else {
                console.error("Calculate Budget button not found.");
            }
        });

        // Function to load destination details based on ID
        function loadDestinationDetails(id) {
            const destination = allDestinations.find(d => d.id == id);
            if (!destination) {
                console.error('Destination not found for ID:', id);
                return;
            }

            // Update main content
            document.querySelector('.destination-info h1').textContent = destination.name;
            document.querySelector('.destination-info .destination-image').src = destination.imageSrc;
            document.querySelector('.destination-info .destination-image').alt = `${destination.name} image`;

            const descriptionContainer = document.querySelector('.destination-info p');
            descriptionContainer.innerHTML = ''; // Clear existing content
            destination.description.forEach(paragraph => {
                const p = document.createElement('p');
                p.textContent = paragraph;
                descriptionContainer.appendChild(p);
            });

            // Update More Info section
            const moreInfoSection = document.querySelector('.more-info-section p');
            moreInfoSection.innerHTML = ''; // Clear existing content
            destination.moreInfo.forEach(paragraph => {
                const p = document.createElement('p');
                p.textContent = paragraph;
                moreInfoSection.appendChild(p);
            });
            // Fallback if h3 not found
            if (document.querySelector('.more-info-section h3')) {
                document.querySelector('.more-info-section h3').textContent = `Why Visit ${destination.name}?`;
            } else {
                // Fallback if h3 not found
            }


            // Update Weather Section data attributes and fetch weather
            const weatherCard = document.getElementById('weather-forecast-card');
            if (weatherCard) {
                weatherCard.dataset.lat = destination.lat;
                weatherCard.dataset.lon = destination.lon;
                weatherCard.dataset.locationName = destination.locationName;
                fetchWeatherData(destination.lat, destination.lon, destination.locationName);
            }

            // Update Photo Gallery
            const photoGalleryGrid = document.querySelector('.photo-gallery-grid');
            photoGalleryGrid.innerHTML = ''; // Clear existing images
            destination.galleryImages.forEach(imgSrc => {
                const img = document.createElement('img');
                img.src = imgSrc;
                img.alt = `${destination.name} image`;
                photoGalleryGrid.appendChild(img);
            });

            // Update Map
            const mapIframe = document.querySelector('.map-container iframe');
            mapIframe.src = destination.mapIframeSrc;
            document.querySelector('.map-side-content h4').textContent = `About the ${destination.locationName || destination.name} Region`;
            document.querySelector('.map-side-content p').textContent = destination.mapSideContent;
        }

        // Initial setup on page load: read destination ID from URL and load content
        document.addEventListener('DOMContentLoaded', () => {
            const urlParams = new URLSearchParams(window.location.search);
            const destinationId = urlParams.get('destination'); // Get 'destination' parameter (e.g., '1', '2', '3')

            // Load details based on URL parameter. If none, default to ID 1.
            loadDestinationDetails(destinationId || '1');
        });
    </script>

     <?php
    include 'inc/footer.php';
    ?> 
</body>
</html>