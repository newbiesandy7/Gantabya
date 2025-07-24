<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results - Gantabya</title>
    	
    	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Merienda:wght@700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/nav.css">
        <link rel="stylesheet" href="css/navbar_custom.css">
    <style>
        
        :root {
            --color-main-green: #6D9773;
            --color-deep-green: #0C3B2E;
            --color-mustard-yellow: #BB8A52;
            --color-bright-gold: #FFBA00;
            --color-neutral-bg: #F8FAF7;
            --color-primary-text: #333333;
            --color-secondary-text: #6B7280;
            --color-white: #ffffff;

            --color-orange-tag: #f97316; 
        }


        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-neutral-bg);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: var(--color-primary-text);
        }

        
        .container {
            max-width: 1280px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .justify-center { justify-content: center; }
        .flex-col { flex-direction: column; }
        .flex-none { flex-shrink: 0; }
        .flex-grow { flex-grow: 1; }
        .relative { position: relative; }
        .absolute { position: absolute; }
        .inset-0 { top: 0; right: 0; bottom: 0; left: 0; }
        .z-10 { z-index: 10; }
        .z-30 { z-index: 30; }
        .z-50 { z-index: 50; }
        .text-center { text-align: center; }
        .overflow-hidden { overflow: hidden; }
        .object-cover { object-fit: cover; }
        .w-full { width: 100%; }
        .h-48 { height: 12rem; }
        .rounded-lg { border-radius: 0.5rem; }
        .rounded-full { border-radius: 9999px; }
        .shadow-sm { box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); }
        .shadow-md { box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); }
        .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); }
        .transition-transform { transition-property: transform; transition-duration: 0.3s; transition-timing-function: ease; }

        /* Colors */
        .bg-white { background-color: var(--color-white); }
        .bg-gray-50 { background-color: var(--color-neutral-bg); }
        .bg-gray-800 { background-color: var(--color-deep-green); }
        .bg-yellow-400 { background-color: var(--color-bright-gold); }
        .bg-green-500 { background-color: var(--color-main-green); }
        .bg-red-500 { background-color: var(--color-red-tag); }
        .bg-orange-500 { background-color: var(--color-orange-tag); }
        .text-white { color: var(--color-white); }
        .text-gray-900 { color: var(--color-primary-text); }
        .text-gray-800 { color: var(--color-deep-green); }
        .text-gray-700 { color: var(--color-primary-text); }
        .text-gray-600 { color: var(--color-secondary-text); }
        .text-gray-500 { color: var(--color-secondary-text); }
        .text-yellow-400 { color: var(--color-bright-gold); }
        .text-green-500 { color: var(--color-main-green); }
        .text-D9ED5E { color: var(--color-bright-gold); }

        /* Typography */
        .text-xs { font-size: 0.75rem; line-height: 1rem; }
        .text-sm { font-size: 0.875rem; line-height: 1.25rem; }
        .text-base { font-size: 1rem; line-height: 1.5rem; }
        .text-lg { font-size: 1.125rem; line-height: 1.75rem; }
        .text-xl { font-size: 1.25rem; line-height: 1.75rem; }
        .text-2xl { font-size: 1.5rem; line-height: 2rem; }
        .text-3xl { font-size: 1.875rem; line-height: 2.25rem; }
        .text-4xl { font-size: 2.25rem; line-height: 2.5rem; }
        .text-5xl { font-size: 3rem; line-height: 1; }
        .font-extrabold { font-weight: 800; }
        .font-bold { font-weight: 700; }
        .font-semibold { font-weight: 600; }
        .font-medium { font-weight: 500; }
        .leading-tight { line-height: 1.25; }
        .drop-shadow-lg { filter: drop-shadow(0 10px 8px rgba(0,0,0,0.04)) drop-shadow(0 4px 3px rgba(0,0,0,0.1)); }
        .uppercase { text-transform: uppercase; }
        .line-through { text-decoration-line: line-through; }

        /* Spacing */
        .px-4 { padding-left: 1rem; padding-right: 1rem; }
        .py-4 { padding-top: 1rem; padding-bottom: 1rem; }
        .py-8 { padding-top: 2rem; padding-bottom: 2rem; }
        .py-12 { padding-top: 3rem; padding-bottom: 3rem; }
        .pb-4 { padding-bottom: 1rem; }
        .pl-4 { padding-left: 1rem; }
        .pr-4 { padding-right: 1rem; }
        .mt-4 { margin-top: 1rem; }
        .mt-8 { margin-top: 2rem; }
        .mb-2 { margin-bottom: 0.5rem; }
        .mb-3 { margin-bottom: 0.75rem; }
        .mb-4 { margin-bottom: 1rem; }
        .mb-6 { margin-bottom: 1.5rem; }
        .ml-4 { margin-left: 1rem; }
        .mr-4 { margin-right: 1rem; }

        
        .search-results-section {
            padding-top: 3rem;
            padding-bottom: 3rem;
            background-color: var(--color-neutral-bg);
            flex-grow: 1;
        }
        .search-results-header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }
        .search-results-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--color-deep-green);
            text-align: center;
            width: 100%;
            margin-bottom: 0.5rem;
        }
        .search-criteria-text {
            font-size: 1.125rem;
            color: var(--color-secondary-text);
            text-align: center;
            width: 100%;
        }

        .trek-cards-grid {
            display: grid;
            grid-template-columns: repeat(1, 1fr); 
            gap: 1.5rem;
            padding-bottom: 1rem;
        }

        .trip-card {
            background-color: var(--color-white);
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        .trip-card-image-container {
            position: relative;
        }
        .trip-card-image {
            width: 100%;
            height: 12rem;
            object-fit: cover;
        }
        .trip-tag {
            position: absolute;
            top: 0.75rem;
            right: 0.75rem;
            background-color: var(--color-red-tag);
            color: var(--color-white);
            font-size: 0.75rem;
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
        }
        .trip-tag.orange {
            background-color: var(--color-orange-tag);
        }
        .trip-card-content {
            padding: 1rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        .trip-rating {
            color: var(--color-bright-gold);
            font-size: 0.875rem;
            margin-bottom: 0.5rem;
        }
        .trip-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--color-deep-green);
            margin-bottom: 0.5rem;
        }
        .trip-details {
            color: var(--color-secondary-text);
            font-size: 0.875rem;
            margin-bottom: 0.75rem;
        }
        .trip-description {
            color: var(--color-primary-text);
            font-size: 0.875rem;
            margin-bottom: 1rem;
            flex-grow: 1;
        }
        .trip-price-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: auto;
        }
        
        .trip-price {
            color: var(--color-deep-green);
            font-weight: 700;
            font-size: 1.125rem;
        }
        .trip-old-price {
            color: var(--color-secondary-text);
            text-decoration-line: line-through;
        }
        .trip-view-button {
            background-color: var(--color-main-green);
            color: var(--color-white);
            font-family: "Poppins", sans-serif;
            font-weight: 700;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            transition: background-color 0.2s, transform 0.2s;
            border: none;
            cursor: pointer;
            width: 100%;
            margin-top: 1rem;
            font-size: 1rem;
        }
        .trip-view-button:hover {
            background-color: #55795C;
            transform: translateY(-2px);
        }
        .pagination-controls {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
        }
        .pagination-button {
            background-color: var(--color-white);
            color: var(--color-secondary-text);
            border: 1px solid #d1d5db;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            cursor: pointer;
            transition: background-color 0.2s, border-color 0.2s;
        }
        .pagination-button:hover:not(:disabled) {
            background-color: #E6F0E8;
            border-color: var(--color-main-green);
        }
        .pagination-button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }
        .pagination-button.active {
            background-color: var(--color-main-green);
            color: var(--color-white);
            border-color: var(--color-main-green);
            font-weight: 600;
        }
        .pagination-info {
            font-size: 0.9rem;
            color: var(--color-secondary-text);
            width: 100%;
            text-align: center;
            margin-top: 1rem;
        }
        .no-results-message {
            text-align: center;
            font-size: 1.2rem;
            color: var(--color-secondary-text);
            margin-top: 2rem;
            padding: 1rem;
            border: 1px dashed #d1d5db;
            border-radius: 0.5rem;
            display: none;
        }
        .footer {
            background-color: var(--color-deep-green);
            color: var(--color-white);
            padding-top: 2rem;
            padding-bottom: 2rem;
            margin-top: auto;
        }
        @media (min-width: 640px) { 
            .trek-cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }
        @media (min-width: 768px) { 
            .trek-cards-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        @media (min-width: 1024px) { 
            .trek-cards-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
    </style>
</head>
<body>
    <?php 
        include 'inc/NavBar.php';
	 ?>
    
        <!-- Search Results Section -->
        <section class="search-results-section">
            <div class="container">
                <div class="search-results-header">
                    <h2 class="search-results-title">Found Treks</h2>
                    <p id="search-criteria-display" class="search-criteria-text">Displaying results for: </p>
                </div>

                <div id="trek-cards-grid" class="trek-cards-grid">
                    <!-- Trek cards will be dynamically loaded and filtered here -->
                    <!-- Example cards (these will be filtered by JS) -->
                    <div class="trip-card" data-place="Koshi Province" data-style="High Altitude,Adventure">
                        <div class="trip-card-image-container">
                            <img src="img/ev bc.jpg" alt="Everest Base Camp Trek" class="trip-card-image">
                            <span class="trip-tag">Iconic Trek</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.9</div>
                            <h3 class="trip-title">Everest Base Camp Trek</h3>
                            <div class="trip-details">
                                <span>14 Days</span> • <span>Khumbu Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Trek to the base of the world's highest peak, an unforgettable high-altitude adventure.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 75,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Mountains,Scenic">
                        <div class="trip-card-image-container">
                            <img src="img/Annapurna/cd.jpeg" alt="Annapurna Base Camp Trek" class="trip-card-image">
                            <span class="trip-tag orange">Popular</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.7</div>
                            <h3 class="trip-title">Annapurna Base Camp Trek</h3>
                            <div class="trip-details">
                                <span>10 Days</span> • <span>Annapurna Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Journey through diverse landscapes to the stunning Annapurna Sanctuary.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 45,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Bagmati Province" data-style="Cultural,Nature">
                        <div class="trip-card-image-container">
                            <img src="img/Lang/la3.jpeg" alt="Langtang Valley Trek" class="trip-card-image">
                            <span class="trip-tag">Hidden Gem</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.5</div>
                            <h3 class="trip-title">Langtang Valley Trek</h3>
                            <div class="trip-details">
                                <span>8 Days</span> • <span>Langtang Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Experience Tamang culture and beautiful glaciers in a serene valley.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 35,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Short Trek,Scenic">
                        <div class="trip-card-image-container">
                            <img src="img/GPH/po2.jpeg" alt="Ghorepani Poon Hill Trek" class="trip-card-image">
                            <span class="trip-tag">Sunrise View</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.8</div>
                            <h3 class="trip-title">Ghorepani Poon Hill Trek</h3>
                            <div class="trip-details">
                                <span>5 Days</span> • <span>Annapurna Foothills</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">A short and scenic trek famous for its panoramic sunrise views over the Himalayas.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 22,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Remote,Adventure,High Altitude">
                        <div class="trip-card-image-container">
                            <img src="img/MANA/man2.jpeg" alt="Manaslu Circuit Trek" class="trip-card-image">
                            <span class="trip-tag orange">Challenging</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.6</div>
                            <h3 class="trip-title">Manaslu Circuit Trek</h3>
                            <div class="trip-details">
                                <span>17 Days</span> • <span>Manaslu Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">A challenging yet rewarding trek circling the world's eighth highest mountain, diverse culture and scenery.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 85,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Cultural,Remote,Unique">
                        <div class="trip-card-image-container">
                            <img src="img/UPM/mus (1).jpeg" alt="Upper Mustang Trek" class="trip-card-image">
                            <span class="trip-tag">Forbidden Kingdom</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.7</div>
                            <h3 class="trip-title">Upper Mustang Trek</h3>
                            <div class="trip-details">
                                <span>12 Days</span> • <span>Mustang Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Explore the ancient walled city of Lo Manthang and the unique desert landscapes of Upper Mustang.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 110,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                     <div class="trip-card" data-place="Karnali Province" data-style="Wilderness,Lake,Scenic">
                        <div class="trip-card-image-container">
                            <img src="img/RARA/ra3 (1).jpeg" alt="Rara Lake Trek" class="trip-card-image">
                            <span class="trip-tag">Serene</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.5</div>
                            <h3 class="trip-title">Rara Lake Trek</h3>
                            <div class="trip-details">
                                <span>10 Days</span> • <span>Rara National Park</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Discover Nepal's largest lake, a remote and pristine alpine beauty.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 60,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Eco-trek,Community,Hills">
                        <div class="trip-card-image-container">
                            <img src="img/MDT/mo3.jpeg" alt="Mohare Danda Trek" class="trip-card-image">
                            <span class="trip-tag orange">Eco-Friendly</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.6</div>
                            <h3 class="trip-title">Mohare Danda Trek</h3>
                            <div class="trip-details">
                                <span>7 Days</span> • <span>Annapurna Foothills</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">A sustainable community lodge trek offering stunning views and local interactions.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 32,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Koshi Province" data-style="High Altitude,Challenging,Expedition">
                        <div class="trip-card-image-container">
                            <img src="img/ETP/eve3.jpeg" alt="Everest Three Passes Trek" class="trip-card-image">
                            <span class="trip-tag">Advanced</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.8</div>
                            <h3 class="trip-title">Everest Three Passes Trek</h3>
                            <div class="trip-details">
                                <span>18 Days</span> • <span>Everest Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">A demanding circuit crossing three high passes with breathtaking views of Everest.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 120,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Karnali Province" data-style="Remote,Cultural,Wilderness">
                        <div class="trip-card-image-container">
                            <img src="img/UDT/ud2.jpeg" alt="Upper Dolpo Trek" class="trip-card-image">
                            <span class="trip-tag orange">Untouched</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.9</div>
                            <h3 class="trip-title">Upper Dolpo Trek</h3>
                            <div class="trip-details">
                                <span>25 Days</span> • <span>Dolpo Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">A truly remote and challenging trek into the ancient Bon-Po Buddhist region.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 150,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Koshi Province" data-style="High Altitude,Remote,Wilderness">
                        <div class="trip-card-image-container">
                            <img src="img/KAN/ka4.jpeg" alt="Kanchenjunga Base Camp Trek" class="trip-card-image">
                            <span class="trip-tag">Grand Circuit</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.7</div>
                            <h3 class="trip-title">Kanchenjunga Base Camp Trek</h3>
                            <div class="trip-details">
                                <span>20 Days</span> • <span>Kanchenjunga Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Explore the remote eastern Himalayas to the base camps of the world's third highest peak.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 130,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Short Trek,Scenic,Hills">
                        <div class="trip-card-image-container">
                            <img src="img/MHBC/mar5.jpeg" alt="Mardi Himal Trek" class="trip-card-image">
                            <span class="trip-tag orange">Emerging</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.6</div>
                            <h3 class="trip-title">Mardi Himal Trek</h3>
                            <div class="trip-details">
                                <span>7 Days</span> • <span>Annapurna Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">A relatively new trek offering stunning views of Mardi Himal, Machhapuchhre and Annapurna.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 28,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Eco-trek,Community,Hills">
                        <div class="trip-card-image-container">
                            <img src="img/KRT/ko3.jpeg" alt="Khopra Danda Trek" class="trip-card-image">
                            <span class="trip-tag">Community Lodge</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.7</div>
                            <h3 class="trip-title">Khopra Danda Trek</h3>
                            <div class="trip-details">
                                <span>9 Days</span> • <span>Annapurna Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">An off-the-beaten-path trek with incredible views and support for local communities.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 40,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Lumbini Province" data-style="Cultural,Historical,Sightseeing">
                        <div class="trip-card-image-container">
                            <img src="img/LCT/lc1.jpeg" alt="Lumbini Cultural Tour" class="trip-card-image">
                            <span class="trip-tag">Pilgrimage</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.4</div>
                            <h3 class="trip-title">Lumbini Cultural Tour</h3>
                            <div class="trip-details">
                                <span>3 Days</span> • <span>Lumbini Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Visit the birthplace of Buddha, a UNESCO World Heritage site of immense spiritual significance.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 18,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Sudurpashchim Province" data-style="Wildlife,Jungle,Safari">
                        <div class="trip-card-image-container">
                            <img src="img/BNP/BNP2.jpeg" alt="Bardiya National Park Safari" class="trip-card-image">
                            <span class="trip-tag orange">Wildlife</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.6</div>
                            <h3 class="trip-title">Bardiya National Park Safari</h3>
                            <div class="trip-details">
                                <span>4 Days</span> • <span>Terai Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Experience thrilling wildlife safaris, home to tigers and rhinos in a remote setting.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 28,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Scenic,City Tour,Lake">
                        <div class="trip-card-image-container">
                            <img src="img/PADT/PADT3.jpeg" alt="Pokhara Valley Sightseeing" class="trip-card-image">
                            <span class="trip-tag">Lakeside</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.7</div>
                            <h3 class="trip-title">Pokhara Valley Sightseeing</h3>
                            <div class="trip-details">
                                <span>2 Days</span> • <span>Pokhara</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Discover the beautiful city of Pokhara, famous for its lakes, caves, and mountain views.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 10,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Bagmati Province" data-style="Short Trek,Nature,Day Hike">
                        <div class="trip-card-image-container">
                            <img src="img/SNNT/snn.jpeg" alt="Shivapuri Nagarjun Hike" class="trip-card-image">
                            <span class="trip-tag">Day Trip</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.3</div>
                            <h3 class="trip-title">Shivapuri Nagarjun National Park Hike</h3>
                            <div class="trip-details">
                                <span>1 Day</span> • <span>Kathmandu Valley</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">A refreshing day hike near Kathmandu with lush forests and panoramic views.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 3,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Koshi Province" data-style="High Altitude,Lake,Scenic">
                        <div class="trip-card-image-container">
                            <img src="img/GLT/go2.jpeg" alt="Gokyo Lakes Trek" class="trip-card-image">
                            <span class="trip-tag orange">Alpine Lakes</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.8</div>
                            <h3 class="trip-title">Gokyo Lakes Trek</h3>
                            <div class="trip-details">
                                <span>12 Days</span> • <span>Everest Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Explore the stunning turquoise lakes and Ngozumpa Glacier in the Everest region.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 80,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Eco-trek,Short Trek,Scenic">
                        <div class="trip-card-image-container">
                            <img src="img/PT/pt.jpeg" alt="Panchase Trek" class="trip-card-image">
                            <span class="trip-tag">Panoramic</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.5</div>
                            <h3 class="trip-title">Panchase Trek</h3>
                            <div class="trip-details">
                                <span>3 Days</span> • <span>Pokhara Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">A short and relatively easy trek offering spectacular sunrise and mountain views.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 15,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Koshi Province" data-style="Short Trek,Scenic,Everest View">
                        <div class="trip-card-image-container">
                            <img src="img/ev bc.jpg" alt="Everest View Trek" class="trip-card-image">
                            <span class="trip-tag orange">Quick View</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.6</div>
                            <h3 class="trip-title">Everest View Trek</h3>
                            <div class="trip-details">
                                <span>7 Days</span> • <span>Everest Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">A shorter alternative for stunning panoramic views of Everest without going to base camp.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 40,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Bagmati Province" data-style="Cultural,Historical,Sightseeing">
                        <div class="trip-card-image-container">
                            <img src="img/BDS/BDS2.jpeg" alt="Bhaktapur Durbar Square Tour" class="trip-card-image">
                            <span class="trip-tag">Ancient City</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.7</div>
                            <h3 class="trip-title">Bhaktapur Durbar Square Tour</h3>
                            <div class="trip-details">
                                <span>1 Day</span> • <span>Bhaktapur</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Explore the medieval charms and rich cultural heritage of Bhaktapur Durbar Square.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 4,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Bagmati Province" data-style="Cultural,Historical,Sightseeing">
                        <div class="trip-card-image-container">
                            <img src="img/PDS/PDS1.jpeg" alt="Patan Durbar Square Tour" class="trip-card-image">
                            <span class="trip-tag">Art & Architecture</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.6</div>
                            <h3 class="trip-title">Patan Durbar Square Tour</h3>
                            <div class="trip-details">
                                <span>1 Day</span> • <span>Lalitpur</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Discover the ancient Newari city of Patan, known for its exquisite arts and crafts.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 3,500</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Bagmati Province" data-style="Cultural,Historical,Sightseeing,Spiritual">
                        <div class="trip-card-image-container">
                            <img src="img/BST/BST1.jpeg" alt="Boudhanath Stupa Tour" class="trip-card-image">
                            <span class="trip-tag">Spiritual</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.9</div>
                            <h3 class="trip-title">Boudhanath Stupa Tour</h3>
                            <div class="trip-details">
                                <span>0.5 Day</span> • <span>Kathmandu</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Experience the serenity of one of the largest stupas in the world, a UNESCO World Heritage site.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 2,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Adventure,Paragliding,Boating">
                        <div class="trip-card-image-container">
                            <img src="img/PADT/PADT1.jpeg" alt="Pokhara Adventure Activities" class="trip-card-image">
                            <span class="trip-tag orange">Adventure Hub</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.7</div>
                            <h3 class="trip-title">Pokhara Adventure Activities</h3>
                            <div class="trip-details">
                                <span>1-2 Days</span> • <span>Pokhara</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Enjoy paragliding, zip-lining, boating, and ultra-light flights in Nepal's adventure capital.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 8,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Bagmati Province" data-style="Nature,Relaxation,Hill Station">
                        <div class="trip-card-image-container">
                            <img src="img/NSP/NSP1.jpeg" alt="Nagarkot+Sunrise" class="trip-card-image">
                            <span class="trip-tag">Himalayan View</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.5</div>
                            <h3 class="trip-title">Nagarkot Sunrise View Tour</h3>
                            <div class="trip-details">
                                <span>1 Day</span> • <span>Nagarkot</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Witness a spectacular sunrise over the Himalayas from the scenic hill station of Nagarkot.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 2,500</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Madhesh Province" data-style="Cultural,Historical,Religious">
                        <div class="trip-card-image-container">
                            <img src="img/JPD/JDP1.jpeg" alt="Janakpur+Dham" class="trip-card-image">
                            <span class="trip-tag">Religious Site</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.3</div>
                            <h3 class="trip-title">Janakpur Dham Pilgrimage</h3>
                            <div class="trip-details">
                                <span>2 Days</span> • <span>Janakpur</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Visit the ancient city of Janakpur, the birthplace of Sita and a significant Hindu pilgrimage site.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 12,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Koshi Province" data-style="Nature,Wildlife,Jungle Safari">
                        <div class="trip-card-image-container">
                            <img src="img/CNP/CNP2.jpeg" alt="Chitwan+Safari" class="trip-card-image">
                            <span class="trip-tag orange">Jungle Safari</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.7</div>
                            <h3 class="trip-title">Chitwan National Park Safari</h3>
                            <div class="trip-details">
                                <span>3 Days</span> • <span>Chitwan</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Explore dense jungles, spot rhinos and tigers, and enjoy elephant safaris in Chitwan National Park.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 15,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Remote,Cultural,Wilderness">
                        <div class="trip-card-image-container">
                            <img src="img/NPVT/nar2.jpeg" alt="Nar Phu Valley Trek" class="trip-card-image">
                            <span class="trip-tag">Off-The-Beaten-Path</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.6</div>
                            <h3 class="trip-title">Nar Phu Valley Trek</h3>
                            <div class="trip-details">
                                <span>14 Days</span> • <span>Annapurna Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Explore the hidden valleys of Nar and Phu, rich in ancient Tibetan culture and stunning landscapes.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 70,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Bagmati Province" data-style="Cultural,Short Trek,Village">
                        <div class="trip-card-image-container">
                            <img src="img/THT/tam2.jpeg" alt="Tamang Heritage Trail" class="trip-card-image">
                            <span class="trip-tag orange">Cultural Immersion</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.4</div>
                            <h3 class="trip-title">Tamang Heritage Trail</h3>
                            <div class="trip-details">
                                <span>7 Days</span> • <span>Langtang Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Discover traditional Tamang villages, hot springs, and panoramic mountain views.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 30,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Gandaki Province" data-style="Cultural,Spiritual,Remote">
                        <div class="trip-card-image-container">
                            <img src="img/TVT/tv4.jpeg" alt="Upper Tsum Valley Trek" class="trip-card-image">
                            <span class="trip-tag">Sacred Valley</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.7</div>
                            <h3 class="trip-title">Upper Tsum Valley Trek</h3>
                            <div class="trip-details">
                                <span>18 Days</span> • <span>Manaslu Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Journey into a sacred Himalayan pilgrimage valley with ancient monasteries and unique culture.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 90,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Bagmati Province" data-style="Short Trek,Scenic,Hills">
                        <div class="trip-card-image-container">
                            <img src="img/HET/hel1.jpeg" alt="Helambu Trek" class="trip-card-image">
                            <span class="trip-tag orange">Near Kathmandu</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.3</div>
                            <h3 class="trip-title">Helambu Trek</h3>
                            <div class="trip-details">
                                <span>7 Days</span> • <span>Langtang Region</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">A short and culturally rich trek through traditional Sherpa and Tamang villages.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 25,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                    <div class="trip-card" data-place="Koshi Province" data-style="Everest View,Short Trek,Panoramic">
                        <div class="trip-card-image-container">
                            <img src="img/PPT/pp2.jpeg" alt="Pikey Peak Trek" class="trip-card-image">
                            <span class="trip-tag">Best Everest View</span>
                        </div>
                        <div class="trip-card-content">
                            <div class="trip-rating">★★★★★ 4.8</div>
                            <h3 class="trip-title">Pikey Peak Trek</h3>
                            <div class="trip-details">
                                <span>5 Days</span> • <span>Solu-Khumbu</span> • <span>Nepal</span>
                            </div>
                            <p class="trip-description">Enjoy the best panoramic view of Mount Everest and other Himalayan peaks.</p>
                            <div class="trip-price-section">
                                <span class="trip-price">From NPR 20,000</span>
                            </div>
                            <button class="trip-view-button">LEARN MORE</button>
                        </div>
                    </div>

                </div>
                <div id="no-filter-results" class="no-results-message">No trekking destinations found matching your criteria. Please try different selections.</div>
            </div>
        </section>

        <!-- Pagination Controls -->
        <div class="pagination-controls">
            <button id="prev-page" class="pagination-button">← Previous</button>
            <div id="page-numbers" class="flex gap-2">
                <!-- Page numbers will be dynamically inserted here -->
            </div>
            <button id="next-page" class="pagination-button">Next →</button>
            <p id="pagination-info" class="pagination-info"></p>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container text-center">
                <p>&copy; 2025 Gantabya. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const allTrekCards = Array.from(document.querySelectorAll('.trek-cards-grid .trip-card'));
            const trekCardsGrid = document.getElementById('trek-cards-grid');
            const noResultsMessage = document.getElementById('no-filter-results');

            const prevButton = document.getElementById('prev-page');
            const nextButton = document.getElementById('next-page');
            const pageNumbersContainer = document.getElementById('page-numbers');
            const paginationInfo = document.getElementById('pagination-info');

            const itemsPerPage = 8;
            let currentPage = 1;
            let filteredTrekCards = []; // This will hold the cards after filtering

            // Function to get query parameters
            const urlParams = new URLSearchParams(window.location.search);
            const initialPlace = urlParams.get('place') || 'All Provinces';
            const initialStyle = urlParams.get('style') || 'Any Style';

            // Function to display current search criteria
            const searchCriteriaDisplay = document.getElementById('search-criteria-display');
            searchCriteriaDisplay.textContent = `Displaying results for: Place - ${initialPlace}, Style - ${initialStyle}`;


            function applyFilteringAndPagination() {
                // Use initialPlace and initialStyle from URL parameters for filtering
                const selectedPlace = initialPlace.toLowerCase();
                const selectedStyle = initialStyle.toLowerCase();

                filteredTrekCards = []; // Reset filtered cards for new filtering

                allTrekCards.forEach(card => {
                    const cardPlace = card.dataset.place ? card.dataset.place.toLowerCase() : '';
                    const cardStyles = card.dataset.style ? card.dataset.style.toLowerCase().split(',').map(s => s.trim()) : [];

                    const matchesPlace = (selectedPlace === 'all provinces' || cardPlace === selectedPlace);
                    // Check if any of the card's styles match the selected style OR if selected style is 'any style'
                    const matchesStyle = (selectedStyle === 'any style' || cardStyles.some(s => s === selectedStyle));

                    if (matchesPlace && matchesStyle) {
                        filteredTrekCards.push(card);
                    }
                });

                // Display results based on filtering and pagination
                if (filteredTrekCards.length > 0) {
                    noResultsMessage.style.display = 'none';
                    trekCardsGrid.style.display = 'grid'; // Ensure grid is visible
                    displayPage(1); // Always start at page 1 after new filtering
                } else {
                    noResultsMessage.style.display = 'block';
                    trekCardsGrid.style.display = 'none'; // Hide grid if no results
                    // Hide pagination controls if no results
                    prevButton.style.display = 'none';
                    nextButton.style.display = 'none';
                    pageNumbersContainer.style.display = 'none';
                    paginationInfo.style.display = 'none';
                }
            }


            function displayPage(page) {
                currentPage = page;
                const totalFilteredItems = filteredTrekCards.length;
                const totalPages = Math.ceil(totalFilteredItems / itemsPerPage);
                const startIndex = (currentPage - 1) * itemsPerPage;
                const endIndex = startIndex + itemsPerPage;

                // First, hide all cards that were potentially visible from previous state
                allTrekCards.forEach(card => {
                    card.style.display = 'none';
                });

                // Then, append only the cards for the current page from the filtered list
                // To avoid re-appending existing children, we can clear and append, or manage existing nodes.
                // Clearing and re-appending is simpler here given dynamic filtering.
                trekCardsGrid.innerHTML = ''; // Clear previous content

                for (let i = startIndex; i < endIndex && i < totalFilteredItems; i++) {
                    const card = filteredTrekCards[i];
                    card.style.display = 'flex'; // Ensure card is visible
                    trekCardsGrid.appendChild(card); // Append to the visible grid
                }

                // Update pagination buttons state
                prevButton.disabled = currentPage === 1;
                nextButton.disabled = currentPage === totalPages || totalFilteredItems === 0;

                // Dynamically create/update page number buttons
                pageNumbersContainer.innerHTML = '';
                for (let i = 1; i <= totalPages; i++) {
                    const pageButton = document.createElement('button');
                    pageButton.textContent = i;
                    pageButton.classList.add('pagination-button');
                    if (i === currentPage) {
                        pageButton.classList.add('active');
                    }
                    if (i !== currentPage) {
                        pageButton.addEventListener('click', () => displayPage(i));
                    }
                    pageNumbersContainer.appendChild(pageButton);
                }

                // Update pagination info text
                const currentStart = totalFilteredItems === 0 ? 0 : startIndex + 1;
                const currentEnd = Math.min(endIndex, totalFilteredItems);
                paginationInfo.textContent = `${currentStart} - ${currentEnd} of ${totalFilteredItems}`;

                // Show pagination controls if there are any results
                if (totalFilteredItems > 0) {
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
            }

            // Event listeners for Prev/Next buttons
            prevButton.addEventListener('click', () => {
                if (currentPage > 1) {
                    displayPage(currentPage - 1);
                }
            });

            nextButton.addEventListener('click', () => {
                const totalPages = Math.ceil(filteredTrekCards.length / itemsPerPage);
                if (currentPage < totalPages) {
                    displayPage(currentPage + 1);
                }
            });

            // Initial filtering and display when the page loads
            applyFilteringAndPagination();
        });
    </script>
     <?php
    include 'inc/footer.php';
    ?> 
</body>
</html>
