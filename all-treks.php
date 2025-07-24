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
    <title>All Treks - Gantabya</title>
   	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Merienda:wght@700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/all-trek.css">
    <link rel="stylesheet" href="css/navbar_custom.css">
</head>
<body>

<?php
include 'inc/NavBar.php'; 
?>
    <main class="container">
        <section class="search-filter-section">
            <div class="search-input-group">
                <i class="fas fa-search"></i>
                <input type="text" id="search-input" placeholder="Search by name, location, or tag...">
            </div>
            <div class="filter-group">
                <select id="difficulty-filter">
                    <option value="">All Difficulties</option>
                    <option value="easy">Easy</option>
                    <option value="medium">Medium</option>
                    <option value="hard">Hard</option>
                </select>
                <select id="duration-filter">
                    <option value="">All Durations</option>
                    <option value="1-7">1-7 Days</option>
                    <option value="8-14">8-14 Days</option>
                    <option value="15+">15+ Days</option>
                </select>
                <button id="apply-filters">Apply Filters</button>
            </div>
        </section>

        <section id="treks-listing" class="treks-grid">
            </section>

        <div id="no-results" style="display: none;">
            No treks found matching your criteria. Please try a different search or filter.
        </div>

        <section class="pagination-controls">
            <button id="prev-page-button">Previous</button>
            <div class="page-numbers" id="page-numbers-container">
                </div>
            <span id="pagination-info"></span>
            <button id="next-page-button">Next</button>
        </section>
    </main>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const treksGrid = document.getElementById('treks-listing');
            const searchInput = document.getElementById('search-input');
            const difficultyFilter = document.getElementById('difficulty-filter');
            const durationFilter = document.getElementById('duration-filter');
            const applyFiltersButton = document.getElementById('apply-filters');
            const prevButton = document.getElementById('prev-page-button');
            const nextButton = document.getElementById('next-page-button');
            const pageNumbersContainer = document.getElementById('page-numbers-container');
            const paginationInfo = document.getElementById('pagination-info');
            const noResultsMessage = document.getElementById('no-results');

            let allOriginalTrekCards = []; // Store original trek data
            let currentFilteredTreks = []; // Store treks after filtering and searching
            let currentPage = 1;
            const itemsPerPage = 9; // Display 9 cards per page

            // Simulate fetching trek data (replace with actual API call if needed)
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
                        tags: ["adventure", "high altitude", "popular"]
                    },
                    {
                        id: 2,
                        image: "img/Annapurna/ab.jpeg",
                        title: "Annapurna Circuit Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "18 Days",
                        price: "55,000",
                        description: "Diverse landscapes, from sub-tropical to alpine, with stunning views of Annapurna and Dhaulagiri ranges.",
                        difficulty: "medium",
                        tags: ["adventure", "cultural", "recommended"]
                    },
                    {
                        id: 3,
                        image: "img/Lang/la1.jpg",
                        title: "Langtang Valley Trek",
                        location: "Langtang Region, Nepal",
                        duration: "10 Days",
                        price: "20,000",
                        description: "A relatively shorter trek offering close-up views of the Langtang Lirung and Ganesh Himal ranges.",
                        difficulty: "medium",
                        tags: ["scenic", "cultural"]
                    },
                    {
                        id: 4,
                        image: "img/GPH/po1.jpeg",
                        title: "Ghorepani Poon Hill Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "5 Days",
                        price: "25,000",
                        description: "Famous for its sunrise views over the Himalayas from Poon Hill, a relatively easy and short trek.",
                        difficulty: "easy",
                        tags: ["short trek", "scenic"]
                    },
                    {
                        id: 5,
                        image: "img/MANA/man1.jpeg",
                        title: "Manaslu Circuit Trek",
                        location: "Manaslu Region, Nepal",
                        duration: "17 Days",
                        price: "100,000",
                        description: "A restricted area trek offering raw Himalayan wilderness, diverse culture, and stunning mountain panoramas.",
                        difficulty: "hard",
                        tags: ["adventure", "remote"]
                    },
                    {
                        id: 6,
                        image: "img/UPM/mu4.jpeg",
                        title: "Upper Mustang Trek",
                        location: "Mustang Region, Nepal",
                        duration: "12 Days",
                        price: "150,000",
                        description: "Journey into a forbidden kingdom, experiencing unique Tibetan Buddhist culture and arid landscapes.",
                        difficulty: "medium",
                        tags: ["cultural", "unique", "restricted"]
                    },
                    {
                        id: 7,
                        image: "img/KAN/ka4.jpeg",
                        title: "Kanchenjunga Base Camp Trek",
                        location: "Kanchenjunga Region, Nepal",
                        duration: "22 Days",
                        price: "180,000",
                        description: "An adventurous and challenging trek to the base of the world's third highest mountain.",
                        difficulty: "hard",
                        tags: ["adventure", "remote", "challenging"]
                    },
                    {
                        id: 8,
                        image: "img/ETP/eve1.jpeg",
                        title: "Everest Three Passes Trek",
                        location: "Khumbu Region, Nepal",
                        duration: "20 Days",
                        price: "130,000",
                        description: "Combines high passes, stunning viewpoints, and Everest Base Camp for the ultimate Himalayan experience.",
                        difficulty: "hard",
                        tags: ["adventure", "high altitude", "challenging"]
                    },
                    {
                        id: 9,
                        image: "img/MHBC/mar1.jpeg",
                        title: "Mardi Himal Base Camp Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "7 Days",
                        price: "45,000",
                        description: "A relatively new and less crowded trek offering spectacular close-up views of the Annapurna range.",
                        difficulty: "easy",
                        tags: ["scenic", "short trek"]
                    },
                    {
                        id: 10,
                        image: "img/RARA/ra1.jpeg",
                        title: "Rara Lake Trek",
                        location: "Mugu District, Nepal",
                        duration: "12 Days",
                        price: "70,000",
                        description: "Explore Nepal's largest lake, a pristine and serene destination in the remote Far West.",
                        difficulty: "medium",
                        tags: ["remote", "nature"]
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
                        tags: ["remote", "cultural", "expedition"]
                    },
                    {
                        id: 12,
                        image: "img/PPT/pp2.jpeg",
                        title: "Pikey Peak Trek",
                        location: "Everest Region, Nepal",
                        duration: "7 Days",
                        price: "50,000",
                        description: "Offers stunning panoramic views of Everest, Kanchenjunga, Makalu, and other peaks, an off-the-beaten-path option.",
                        difficulty: "easy",
                        tags: ["scenic", "short trek"]
                    },
                    {
                        id: 13,
                        image: "img/TVT/tv1.jpeg",
                        title: "Tsum Valley Trek",
                        location: "Manaslu Region, Nepal",
                        duration: "15 Days",
                        price: "95,000",
                        description: "A sacred Buddhist pilgrimage route in a hidden valley, offering unique cultural insights and untouched nature.",
                        difficulty: "medium",
                        tags: ["cultural", "sacred", "remote"]
                    },
                    {
                        id: 14,
                        image: "img/MBCT/mak1.jpeg",
                        title: "Makalu Base Camp Trek",
                        location: "Makalu Barun National Park, Nepal",
                        duration: "20 Days",
                        price: "160,000",
                        description: "An adventurous trek to the base of the world's fifth highest mountain, known for its pristine wilderness.",
                        difficulty: "hard",
                        tags: ["adventure", "remote", "challenging"]
                    },
                    {
                        id: 15,
                        image: "img/UMLM/um1.jpeg",
                        title: "Upper Mustang (Lo Manthang) Trek",
                        location: "Mustang Region, Nepal",
                        duration: "14 Days",
                        price: "160,000",
                        description: "Explore the walled city of Lo Manthang, the ancient capital of the Kingdom of Lo, in the arid trans-Himalayan region.",
                        difficulty: "medium",
                        tags: ["cultural", "unique", "restricted"]
                    },
                    {
                        id: 16,
                        image: "img/GLT/go1.jpeg",
                        title: "Gosaikunda Lake Trek",
                        location: "Langtang Region, Nepal",
                        duration: "7 Days",
                        price: "35,000",
                        description: "A popular pilgrimage trek to a sacred alpine lake, offering stunning mountain views and cultural experiences.",
                        difficulty: "medium",
                        tags: ["pilgrimage", "scenic"]
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
                        tags: ["cultural", "off-beat", "nature"]
                    },
                    {
                        id: 18,
                        image: "img/THT/tam1.jpeg",
                        title: "Tamang Heritage Trail",
                        location: "Langtang Region, Nepal",
                        duration: "7 Days",
                        price: "40,000",
                        description: "Experience the rich Tamang culture, traditional villages, and picturesque landscapes of the Langtang region.",
                        difficulty: "easy",
                        tags: ["cultural", "village trek"]
                    },
                    {
                        id: 19,
                        image: "img/HET/hel1.jpeg",
                        title: "Helambu Trek",
                        location: "Langtang Region, Nepal",
                        duration: "8 Days",
                        price: "45,000",
                        description: "A relatively short and easy trek close to Kathmandu, known for its Sherpa and Tamang villages and rhododendron forests.",
                        difficulty: "easy",
                        tags: ["cultural", "short trek"]
                    },
                    {
                        id: 20,
                        image: "img/KRT/ko1.jpeg",
                        title: "Khopra Ridge Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "9 Days",
                        price: "60,000",
                        description: "An alternative to the Ghorepani trek, offering stunning panoramic views of the Annapurna and Dhaulagiri ranges.",
                        difficulty: "medium",
                        tags: ["scenic", "less crowded"]
                    },
                    {
                        id: 21,
                        image: "img/DCT/dh1.jpeg",
                        title: "Dhaulagiri Circuit Trek",
                        location: "Dhaulagiri Region, Nepal",
                        duration: "17 Days",
                        price: "200,000",
                        description: "A challenging and remote trek circumnavigating the world's seventh highest mountain, Dhaulagiri.",
                        difficulty: "hard",
                        tags: ["expedition", "remote", "challenging"]
                    },
                    {
                        id: 22,
                        image: "img/NPVT/nar1.jpeg",
                        title: "Nar Phu Valley Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "13 Days",
                        price: "120,000",
                        description: "Explore hidden valleys and ancient Buddhist monasteries in this restricted area north of Annapurna.",
                        difficulty: "medium",
                        tags: ["cultural", "restricted", "hidden gem"]
                    },
                    {
                        id: 23,
                        image: "img/CNT/chi1.jpeg",
                        title: "Chisapani Nagarkot Trek",
                        location: "Kathmandu Valley Rim, Nepal",
                        duration: "3 Days",
                        price: "20,000",
                        description: "A short and easy trek near Kathmandu, perfect for a quick escape with sunrise views over the Himalayas.",
                        difficulty: "easy",
                        tags: ["short trek", "sunrise"]
                    },
                    {
                        id: 24,
                        image: "img/ABCT/api1.jpeg",
                        title: "Api Base Camp Trek",
                        location: "Far Western Nepal",
                        duration: "15 Days",
                        price: "140,000",
                        description: "A challenging trek to the base of Mt. Api, offering wilderness and unique cultural experiences in a less-explored region.",
                        difficulty: "hard",
                        tags: ["remote", "adventure", "challenging"]
                    },
                    {
                        id: 25,
                        image: "img/MDT/mo1.jpeg",
                        title: "Mohare Danda Trek",
                        location: "Annapurna Region, Nepal",
                        duration: "7 Days",
                        price: "45,000",
                        description: "An eco-friendly community lodge trek offering stunning views of Dhaulagiri and Annapurna ranges.",
                        difficulty: "easy",
                        tags: ["eco-friendly", "community", "scenic"]
                    },
                    {
                        id: 26,
                        image: "img/LDSGT/ld1.jpeg",
                        title: "Lower Dolpo (Shey Gompa) Trek",
                        location: "Dolpo Region, Nepal",
                        duration: "18 Days",
                        price: "230,000",
                        description: "A captivating journey into the mystical Lower Dolpo, visiting ancient monasteries like Shey Gompa and pristine landscapes.",
                        difficulty: "hard",
                        tags: ["cultural", "remote", "spiritual"]
                    },
                    {
                        id: 27,
                        image: "img/ALPT/am1.jpeg",
                        title: "Amphu Lapcha Pass Trek",
                        location: "Khumbu Region, Nepal",
                        duration: "21 Days",
                        price: "250,000",
                        description: "A highly challenging and technical pass linking the Khumbu and Hinku valleys, for experienced trekkers.",
                        difficulty: "hard",
                        tags: ["expedition", "technical", "challenging"]
                    },
                    {
                        id: 28,
                        image: "img/LCT/lc1.jpeg",
                        title: "Limbu Cultural Trail",
                        location: "Eastern Nepal",
                        duration: "10 Days",
                        price: "70,000",
                        description: "Discover the unique culture and traditions of the Limbu ethnic group in the hills of Eastern Nepal.",
                        difficulty: "medium",
                        tags: ["cultural", "ethnic"]
                    },
                    {
                        id: 29,
                        image: "img/RTLPT/ro1.jpeg",
                        title: "Rolwaling Tashi Lapcha Pass Trek",
                        location: "Rolwaling Region, Nepal",
                        duration: "19 Days",
                        price: "220,000",
                        description: "A remote and adventurous trek through the Rolwaling Valley, crossing the challenging Tashi Lapcha Pass.",
                        difficulty: "hard",
                        tags: ["remote", "adventure", "challenging"]
                    },
                    {
                        id: 30,
                        image: "img/CHT/ch1.jpeg",
                        title: "Chepang Hill Trail",
                        location: "Chitwan District, Nepal",
                        duration: "4 Days",
                        price: "25,000",
                        description: "Experience the unique lifestyle and culture of the indigenous Chepang people with stunning views of the plains and Himalayas.",
                        difficulty: "easy",
                        tags: ["cultural", "village trek", "short trek"]
                    }
                ];
            };

            // Render a single trek card
           // Render a single trek card
            const createTrekCard = (trek) => {
                const card = document.createElement('div');
                card.className = 'trek-card';
                card.innerHTML = `
                    <img src="${trek.image}" alt="${trek.title}" class="trek-card-image">
                    <div class="trek-card-content">
                        <h3 class="trek-card-title">${trek.title}</h3>
                        <div class="trek-card-info">
                            <i class="fas fa-map-marker-alt"></i> ${trek.location}
                        </div>
                        <div class="trek-card-description">
                            ${trek.description}
                        </div>
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

            // Display treks for the current page with animation
            const displayPage = (page) => {
                currentPage = page;
                treksGrid.innerHTML = ''; // Clear existing treks
                noResultsMessage.style.display = 'none';

                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;
                const treksToDisplay = currentFilteredTreks.slice(startIndex, endIndex);

                if (treksToDisplay.length === 0 && currentFilteredTreks.length > 0) {
                    // If no treks on current page but there are filtered treks, go to last page
                    currentPage = Math.ceil(currentFilteredTreks.length / itemsPerPage);
                    if (currentPage > 0) { // Ensure current page is not 0 if no results
                         displayPage(currentPage);
                    } else { // No results at all
                        noResultsMessage.style.display = 'block';
                        updatePaginationControls(0);
                    }
                    return;
                } else if (treksToDisplay.length === 0 && currentFilteredTreks.length === 0) {
                    noResultsMessage.style.display = 'block';
                }

                treksToDisplay.forEach((trek, index) => {
                    const card = createTrekCard(trek);
                    card.style.animationDelay = `${index * 0.08}s`; // Staggered fade-in
                    treksGrid.appendChild(card);
                });

                updatePaginationControls(currentFilteredTreks.length);
            };

            // Update pagination buttons and info
            const updatePaginationControls = (totalItems) => {
                const totalPages = Math.ceil(totalItems / itemsPerPage);

                prevButton.disabled = currentPage === 1;
                nextButton.disabled = currentPage === totalPages || totalPages === 0;

                pageNumbersContainer.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const pageSpan = document.createElement('span');
                    pageSpan.textContent = i;
                    pageSpan.classList.add('page-number');
                    if (i === currentPage) {
                        pageSpan.classList.add('active');
                    }
                    pageSpan.addEventListener('click', () => displayPage(i));
                    pageNumbersContainer.appendChild(pageSpan);
                }

                const displayedStart = totalItems === 0 ? 0 : (currentPage - 1) * itemsPerPage + 1;
                const displayedEnd = Math.min(currentPage * itemsPerPage, totalItems);
                paginationInfo.textContent = `${displayedStart} - ${displayedEnd} of ${totalItems}`;

                // Show/hide pagination controls based on total items
                if (totalItems > 0) {
                    prevButton.style.display = 'inline-block';
                    nextButton.style.display = 'inline-block';
                    pageNumbersContainer.style.display = 'flex';
                    paginationInfo.style.display = 'block';
                } else {
                    prevButton.style.display = 'none';
                    nextButton.style.display = 'none';
                    pageNumbersContainer.style.display = 'none';
                    paginationInfo.style.display = 'none';
                }
            };

            // Apply search and filters
            const applySearchAndFilters = () => {
                const searchTerm = searchInput.value.toLowerCase().trim();
                const selectedDifficulty = difficultyFilter.value;
                const selectedDuration = durationFilter.value;

                currentFilteredTreks = allOriginalTrekCards.filter(trek => {
                    const matchesSearch = searchTerm === '' ||
                                          trek.title.toLowerCase().includes(searchTerm) ||
                                          trek.location.toLowerCase().includes(searchTerm) ||
                                          trek.tags.some(tag => tag.toLowerCase().includes(searchTerm));

                    const matchesDifficulty = selectedDifficulty === '' || trek.difficulty === selectedDifficulty;

                    const trekDurationDays = parseInt(trek.duration.split(' ')[0]);
                    const matchesDuration = selectedDuration === '' ||
                                            (selectedDuration === '1-7' && trekDurationDays >= 1 && trekDurationDays <= 7) ||
                                            (selectedDuration === '8-14' && trekDurationDays >= 8 && trekDurationDays <= 14) ||
                                            (selectedDuration === '15+' && trekDurationDays >= 15);

                    return matchesSearch && matchesDifficulty && matchesDuration;
                });

                currentPage = 1; // Reset to first page after filtering
                displayPage(currentPage);
            };

            // Event listeners for Prev/Next buttons
            prevButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    displayPage(currentPage - 1);
                }
            });

            nextButton.addEventListener('click', () => {
                const totalPages = Math.ceil(currentFilteredTreks.length / itemsPerPage);
                if (currentPage < totalPages) {
                    displayPage(currentPage + 1);
                }
            });

            // Event listeners for search and filter
            searchInput.addEventListener('input', applySearchAndFilters);
            applyFiltersButton.addEventListener('click', applySearchAndFilters);
            difficultyFilter.addEventListener('change', applySearchAndFilters); // Apply on change
            durationFilter.addEventListener('change', applySearchAndFilters); // Apply on change

            // Initial load
            allOriginalTrekCards = fetchTrekData();
            currentFilteredTreks = [...allOriginalTrekCards]; // Initially all treks are filtered treks
            displayPage(1);
        });
    </script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
         <?php
    include 'inc/footer.php';
    ?>
</body>
</html>