<?php 
session_start();
$logged = false;
if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {
	 $logged = true;
	 $user_id = $_SESSION['user_id'];
    }
  $notFound = 0;
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Province Treks - Gantabya</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Merienda:wght@700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="css/all-trek.css"/>
  <link rel="stylesheet" href="css/navbar_custom.css">
  <style>
    body, html {
  margin: 0;
  padding: 0;
}

header {
  margin-bottom: 0;
}
    .hero {
        background-image: url("./img/province/karnali.jpg"); /* Default background */
  height: 400px;                  
  width: 100%;                    
  background-size: cover;
  background-position: center;
  position: relative;
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
}

.hero::before {
  content: "";
  position: absolute;
  top: 0; left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* Black overlay with 50% opacity */
  z-index: 1;
}

.hero-overlay {
  position: relative;
  z-index: 2; /* Ensures text appears above the overlay */
  text-align: center;
  padding: 2rem;
}
    .hero h1 {
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
    }
    .hero p {
      font-size: 1.2rem;
    }
  </style>
</head>
<body>
  <?php 
      include 'inc\NavBar.php';
      ?>

  <section class="hero">
    <div class="hero-overlay">
      <h1 id="province-name">Province Treks</h1>
      <p id="province-quote">"Exploring the essence of nature, culture, and adventure."</p>
    </div>
  </section>

  <main class="container">
    <section id="treks-listing" class="treks-grid"></section>

    <div id="no-results" style="display: none;">No treks found matching your criteria.</div>

    <section class="pagination-controls">
      <button id="prev-page-button">Previous</button>
      <div class="page-numbers" id="page-numbers-container"></div>
      <span id="pagination-info"></span>
      <button id="next-page-button">Next</button>
    </section>
  </main>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const treksGrid = document.getElementById('treks-listing');
      const prevButton = document.getElementById('prev-page-button');
      const nextButton = document.getElementById('next-page-button');
      const pageNumbersContainer = document.getElementById('page-numbers-container');
      const paginationInfo = document.getElementById('pagination-info');
      const noResultsMessage = document.getElementById('no-results');

      const urlParams = new URLSearchParams(window.location.search);
      const selectedProvince = urlParams.get('province')?.toLowerCase() || '';

      // Set province name and quote
      const provinceDisplayName = selectedProvince.charAt(0).toUpperCase() + selectedProvince.slice(1);
      document.getElementById('province-name').textContent = provinceDisplayName + ' Province';
      const provinceQuotes = {
        bagmati: "Where culture meets nature and adventure begins.",
        gandaki: "Gateway to the Himalayas and the soul of trekking.",
        sudurpaschim: "Untouched beauty in the far west of Nepal.",
        province1: "The land of mighty peaks and ancient trails.",
        madhesh: "A blend of plains and tradition.",
        lumbini: "Birthplace of the Buddha and serene paths.",
        karnali: "Wild, remote, and wonderfully raw."
      };
      document.getElementById('province-quote').textContent = provinceQuotes[selectedProvince] || "Exploring the essence of nature, culture, and adventure.";

      let allOriginalTrekCards = [];
      let currentFilteredTreks = [];
      let currentPage = 1;
      const itemsPerPage = 9;

      const fetchTrekData = () => {
                return [
                    {
                        id: 1,
                        image: "img/EBC/BG.jpg",
                        title: "Everest Base Camp Trek",
                        location: "Khumbu Region, Nepal",
                        duration: "14 Days",
                        price: "75,000",
                        description: "A challenging trek to the foot of the world's highest peak, offering breathtaking views and Sherpa culture.",
                        difficulty: "hard",
                        tags: ["adventure", "high altitude", "popular"],
                        province: "province1" // Assign province here
                    },
                    {
                        id: 2,
                        image: "img/Annapurna/gh.jpeg",
                        title: "Annapurna Circuit Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "18 Days",
                        price: "55,000",
                        description: "Diverse landscapes, from sub-tropical to alpine, with stunning views of Annapurna and Dhaulagiri ranges.",
                        difficulty: "medium",
                        tags: ["adventure", "cultural", "recommended"],
                        province: "gandaki" // Assign province here
                    },
                    {
                        id: 3,
                        image: "img/Lang/la4.jpeg",
                        title: "Langtang Valley Trek",
                        location: "Langtang Region, Nepal",
                        duration: "10 Days",
                        price: "20,000",
                        description: "A relatively shorter trek offering close-up views of the Langtang Lirung and Ganesh Himal ranges.",
                        difficulty: "medium",
                        tags: ["scenic", "cultural"],
                        province: "bagmati" // Assign province here
                    },
                    {
                        id: 4,
                        image: "img/GPH/po3.jpeg",
                        title: "Ghorepani Poon Hill Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "5 Days",
                        price: "25,000",
                        description: "Famous for its sunrise views over the Himalayas from Poon Hill, a relatively easy and short trek.",
                        difficulty: "easy",
                        tags: ["short trek", "scenic"],
                        province: "gandaki" // Assign province here
                    },
                    {
                        id: 5,
                        image: "img/MANA/man4.jpeg",
                        title: "Manaslu Circuit Trek",
                        location: "Manaslu Region, Nepal",
                        duration: "17 Days",
                        price: "100,000",
                        description: "A restricted area trek offering raw Himalayan wilderness, diverse culture, and stunning mountain panoramas.",
                        difficulty: "hard",
                        tags: ["adventure", "remote"],
                        province: "gandaki" // Assign province here
                    },
                    {
                        id: 6,
                        image: "img/UPM/mu3.jpeg",
                        title: "Upper Mustang Trek",
                        location: "Mustang Region, Nepal",
                        duration: "12 Days",
                        price: "150,000",
                        description: "Journey into a forbidden kingdom, experiencing unique Tibetan Buddhist culture and arid landscapes.",
                        difficulty: "medium",
                        tags: ["cultural", "unique", "restricted"],
                        province: "gandaki" // Assign province here
                    },
                    {
                        id: 7,
                        image: "img/KAN/ka2.jpeg",
                        title: "Kanchenjunga Base Camp Trek",
                        location: "Kanchenjunga Region, Nepal",
                        duration: "22 Days",
                        price: "180,000",
                        description: "An adventurous and challenging trek to the base of the world's third highest mountain.",
                        difficulty: "hard",
                        tags: ["adventure", "remote", "challenging"],
                        province: "province1" // Assign province here
                    },
                    {
                        id: 8,
                        image: "img/ETP/eve3.jpeg",
                        title: "Everest Three Passes Trek",
                        location: "Khumbu Region, Nepal",
                        duration: "20 Days",
                        price: "130,000",
                        description: "Combines high passes, stunning viewpoints, and Everest Base Camp for the ultimate Himalayan experience.",
                        difficulty: "hard",
                        tags: ["adventure", "high altitude", "challenging"],
                        province: "province1" // Assign province here
                    },
                    {
                        id: 9,
                        image: "img/MHBC/mar2.jpeg",
                        title: "Mardi Himal Base Camp Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "7 Days",
                        price: "45,000",
                        description: "A relatively new and less crowded trek offering spectacular close-up views of the Annapurna range.",
                        difficulty: "easy",
                        tags: ["scenic", "short trek"],
                        province: "gandaki" // Assign province here
                    },
                    {
                        id: 10,
                        image: "img/RARA/ra2.jpeg",
                        title: "Rara Lake Trek",
                        location: "Mugu District, Nepal",
                        duration: "12 Days",
                        price: "70,000",
                        description: "Explore Nepal's largest lake, a pristine and serene destination in the remote Far West.",
                        difficulty: "medium",
                        tags: ["remote", "nature"],
                        province: "karnali" // Assign province here
                    },
                    {
                        id: 11,
                        image: "img/UDT/ud1.jpeg",
                        title: "Upper Dolpo Trek",
                        location: "Dolpo Region, Nepal",
                        duration: "25 Days",
                        price: "250,000",
                        description: "A true wilderness expedition into one of the most isolated regions of Nepal, preserving ancient traditions.",
                        difficulty: "hard",
                        tags: ["remote", "cultural", "expedition"],
                        province: "karnali" // Assign province here
                    },
                    {
                        id: 12,
                        image: "img/PPT/pp3.jpeg",
                        title: "Pikey Peak Trek",
                        location: "Everest Region, Nepal",
                        duration: "7 Days",
                        price: "50,000",
                        description: "Offers stunning panoramic views of Everest, Kanchenjunga, Makalu, and other peaks, an off-the-beaten-path option.",
                        difficulty: "easy",
                        tags: ["scenic", "short trek"],
                        province: "province1" // Assign province here
                    },
                    {
                        id: 13,
                        image: "img/TVT/tv2.jpeg",
                        title: "Tsum Valley Trek",
                        location: "Manaslu Region, Nepal",
                        duration: "15 Days",
                        price: "95,000",
                        description: "A sacred Buddhist pilgrimage route in a hidden valley, offering unique cultural insights and untouched nature.",
                        difficulty: "medium",
                        tags: ["cultural", "sacred", "remote"],
                        province: "gandaki" // Assign province here
                    },
                    {
                        id: 14,
                        image: "img/MBCT/mak2.jpeg",
                        title: "Makalu Base Camp Trek",
                        location: "Makalu Barun National Park, Nepal",
                        duration: "20 Days",
                        price: "160,000",
                        description: "An adventurous trek to the base of the world's fifth highest mountain, known for its pristine wilderness.",
                        difficulty: "hard",
                        tags: ["adventure", "remote", "challenging"],
                        province: "province1" // Assign province here
                    },
                    {
                        id: 15,
                        image: "img/UMLM/um3.jpeg",
                        title: "Upper Mustang (Lo Manthang) Trek",
                        location: "Mustang Region, Nepal",
                        duration: "14 Days",
                        price: "160,000",
                        description: "Explore the walled city of Lo Manthang, the ancient capital of the Kingdom of Lo, in the arid trans-Himalayan region.",
                        difficulty: "medium",
                        tags: ["cultural", "unique", "restricted"],
                        province: "gandaki" // Assign province here
                    },
                    {
                        id: 16,
                        image: "img/GLT/go2.jpeg",
                        title: "Gosaikunda Lake Trek",
                        location: "Langtang Region, Nepal",
                        duration: "7 Days",
                        price: "35,000",
                        description: "A popular pilgrimage trek to a sacred alpine lake, offering stunning mountain views and cultural experiences.",
                        difficulty: "medium",
                        tags: ["pilgrimage", "scenic"],
                        province: "bagmati" // Assign province here
                    },
                    {
                        id: 17,
                        image: "img/RVT/ru1.jpeg",
                        title: "Ruby Valley Trek",
                        location: "Ganesh Himal Region, Nepal",
                        duration: "12 Days",
                        price: "70,000",
                        description: "An off-the-beaten-path trek offering cultural immersion, pristine nature, and views of Ganesh Himal.",
                        difficulty: "medium",
                        tags: ["cultural", "off-beat", "nature"],
                        province: "bagmati" // Assign province here
                    },
                    {
                        id: 18,
                        image: "img/THT/tam2.jpeg",
                        title: "Tamang Heritage Trail",
                        location: "Langtang Region, Nepal",
                        duration: "7 Days",
                        price: "40,000",
                        description: "Experience the rich Tamang culture, traditional villages, and picturesque landscapes of the Langtang region.",
                        difficulty: "easy",
                        tags: ["cultural", "village trek"],
                        province: "bagmati" // Assign province here
                    },
                    {
                        id: 19,
                        image: "img/HET/hel2.jpeg",
                        title: "Helambu Trek",
                        location: "Langtang Region, Nepal",
                        duration: "8 Days",
                        price: "45,000",
                        description: "A relatively short and easy trek close to Kathmandu, known for its Sherpa and Tamang villages and rhododendron forests.",
                        difficulty: "easy",
                        tags: ["cultural", "short trek"],
                        province: "bagmati" // Assign province here
                    },
                    {
                        id: 20,
                        image: "img/KRT/ko2.jpeg",
                        title: "Khopra Ridge Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "9 Days",
                        price: "60,000",
                        description: "An alternative to the Ghorepani trek, offering stunning panoramic views of the Annapurna and Dhaulagiri ranges.",
                        difficulty: "medium",
                        tags: ["scenic", "less crowded"],
                        province: "gandaki" // Assign province here
                    },
                    {
                        id: 21,
                        image: "img/DCT/dh2.jpeg",
                        title: "Dhaulagiri Circuit Trek",
                        location: "Dhaulagiri Region, Nepal",
                        duration: "17 Days",
                        price: "200,000",
                        description: "A challenging and remote trek circumnavigating the world's seventh highest mountain, Dhaulagiri.",
                        difficulty: "hard",
                        tags: ["expedition", "remote", "challenging"],
                        province: "gandaki" // Assign province here
                    },
                    {
                        id: 22,
                        image: "img/NPVT/nar2.jpeg",
                        title: "Nar Phu Valley Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "13 Days",
                        price: "120,000",
                        description: "Explore hidden valleys and ancient Buddhist monasteries in this restricted area north of Annapurna.",
                        difficulty: "medium",
                        tags: ["cultural", "restricted", "hidden gem"],
                        province: "gandaki" // Assign province here
                    },
                    {
                        id: 23,
                        image: "img/CNT/chi2.jpeg",
                        title: "Chisapani Nagarkot Trek",
                        location: "Kathmandu Valley Rim, Nepal",
                        duration: "3 Days",
                        price: "20,000",
                        description: "A short and easy trek near Kathmandu, perfect for a quick escape with sunrise views over the Himalayas.",
                        difficulty: "easy",
                        tags: ["short trek", "sunrise"],
                        province: "bagmati" // Assign province here
                    },
                    {
                        id: 24,
                        image: "img/ABCT/api3.jpeg",
                        title: "Api Base Camp Trek",
                        location: "Far Western Nepal",
                        duration: "15 Days",
                        price: "140,000",
                        description: "A challenging trek to the base of Mt. Api, offering wilderness and unique cultural experiences in a less-explored region.",
                        difficulty: "hard",
                        tags: ["remote", "adventure", "challenging"],
                        province: "sudurpaschim" // Assign province here
                    },
                    {
                        id: 25,
                        image: "img/MDT/mo2.jpeg",
                        title: "Mohare Danda Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "7 Days",
                        price: "45,000",
                        description: "An eco-friendly community lodge trek offering stunning views of Dhaulagiri and Annapurna ranges.",
                        difficulty: "easy",
                        tags: ["eco-friendly", "community", "scenic"],
                        province: "gandaki" // Assign province here
                    },
                    {
                        id: 26,
                        image: "img/LDSGT/ld2.jpeg",
                        title: "Lower Dolpo (Shey Gompa) Trek",
                        location: "Dolpo Region, Nepal",
                        duration: "18 Days",
                        price: "230,000",
                        description: "A captivating journey into the mystical Lower Dolpo, visiting ancient monasteries like Shey Gompa and pristine landscapes.",
                        difficulty: "hard",
                        tags: ["cultural", "remote", "spiritual"],
                        province: "karnali" // Assign province here
                    },
                    {
                        id: 27,
                        image: "img/ALPT/am3.jpeg",
                        title: "Amphu Lapcha Pass Trek",
                        location: "Khumbu Region, Nepal",
                        duration: "21 Days",
                        price: "250,000",
                        description: "A highly challenging and technical pass linking the Khumbu and Hinku valleys, for experienced trekkers.",
                        difficulty: "hard",
                        tags: ["expedition", "technical", "challenging"],
                        province: "province1" // Assign province here
                    },
                    {
                        id: 28,
                        image: "img/LCT/lc3.jpeg",
                        title: "Limbu Cultural Trail",
                        location: "Eastern Nepal",
                        duration: "10 Days",
                        price: "70,000",
                        description: "Discover the unique culture and traditions of the Limbu ethnic group in the hills of Eastern Nepal.",
                        difficulty: "medium",
                        tags: ["cultural", "ethnic"],
                        province: "province1" // Assign province here
                    },
                    {
                        id: 29,
                        image: "img/RTLPT/ro2.jpeg",
                        title: "Rolwaling Tashi Lapcha Pass Trek",
                        location: "Rolwaling Region, Nepal",
                        duration: "19 Days",
                        price: "220,000",
                        description: "A remote and adventurous trek through the Rolwaling Valley, crossing the challenging Tashi Lapcha Pass.",
                        difficulty: "hard",
                        tags: ["remote", "adventure", "challenging"],
                        province: "bagmati" // Assign province here
                    },
                    {
                        id: 30,
                        image: "img/CHT/ch2.jpeg",
                        title: "Chepang Hill Trail",
                        location: "Chitwan District, Nepal",
                        duration: "4 Days",
                        price: "25,000",
                        description: "Experience the unique lifestyle and culture of the indigenous Chepang people with stunning views of the plains and Himalayas.",
                        difficulty: "easy",
                        tags: ["cultural", "village trek", "short trek"],
                        province: "bagmati" // Assign province here
                    }
                ];
            };

      const createTrekCard = (trek) => {
        const card = document.createElement('div');
        card.className = 'trek-card';
        card.innerHTML = `
          <img src="${trek.image}" alt="${trek.title}" class="trek-card-image">
          <div class="trek-card-content">
            <h3 class="trek-card-title">${trek.title}</h3>
            <div class="trek-card-info"><i class="fas fa-map-marker-alt"></i> ${trek.location}</div>
            <div class="trek-card-description">${trek.description}</div>
            <div class="trek-card-tags">
              <span class="tag">${trek.difficulty.charAt(0).toUpperCase() + trek.difficulty.slice(1)}</span>
              ${trek.tags.map(tag => `<span class="tag">${tag.charAt(0).toUpperCase() + tag.slice(1)}</span>`).join('')}
            </div>
            <div class="trek-card-meta">
              <div>
                <span class="trek-card-duration"><i class="fas fa-clock"></i> ${trek.duration}</span>
                <span class="trek-card-price">NPR ${trek.price}</span>
              </div>
              <a href="individual.php?destination=${trek.id}" class="learn-more-button">Learn More</a>
            </div>
          </div>
        `;
        return card;
      };

      const displayPage = (page) => {
        currentPage = page;
        treksGrid.innerHTML = '';
        noResultsMessage.style.display = 'none';

        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const treksToDisplay = currentFilteredTreks.slice(startIndex, endIndex);

        if (treksToDisplay.length === 0 && currentFilteredTreks.length === 0) {
          noResultsMessage.style.display = 'block';
          return;
        }

        treksToDisplay.forEach((trek, index) => {
          const card = createTrekCard(trek);
          card.style.animationDelay = `${index * 0.08}s`;
          treksGrid.appendChild(card);
        });

        updatePaginationControls(currentFilteredTreks.length);
      };

      const updatePaginationControls = (totalItems) => {
        const totalPages = Math.ceil(totalItems / itemsPerPage);
        prevButton.disabled = currentPage === 1;
        nextButton.disabled = currentPage === totalPages || totalPages === 0;

        pageNumbersContainer.innerHTML = '';
        for (let i = 1; i <= totalPages; i++) {
          const pageSpan = document.createElement('span');
          pageSpan.textContent = i;
          pageSpan.classList.add('page-number');
          if (i === currentPage) pageSpan.classList.add('active');
          pageSpan.addEventListener('click', () => displayPage(i));
          pageNumbersContainer.appendChild(pageSpan);
        }

        const displayedStart = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
        const displayedEnd = Math.min(currentPage * itemsPerPage, totalItems);
        paginationInfo.textContent = `${displayedStart} - ${displayedEnd} of ${totalItems}`;
      };

      prevButton.addEventListener('click', () => {
        if (currentPage > 1) displayPage(currentPage - 1);
      });

      nextButton.addEventListener('click', () => {
        const totalPages = Math.ceil(currentFilteredTreks.length / itemsPerPage);
        if (currentPage < totalPages) displayPage(currentPage + 1);
      });

      allOriginalTrekCards = fetchTrekData();
      currentFilteredTreks = allOriginalTrekCards.filter(trek =>
        trek.province && trek.province.toLowerCase() === selectedProvince // Filter by the new 'province' property
      );
      displayPage(1);
    });

    function goBack() {
  if (document.referrer !== "/index.php") {
    // User has a referrer, go back to it
    window.history.back();
  } else {
    // No referrer (user landed directly), redirect somewhere safe
    window.location.href = '/';  // change to homepage or a fallback URL
  }
}
  </script>
   <?php
    include 'inc/footer.php';
    ?> 
</body>
</html>