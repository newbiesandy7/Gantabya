<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Status</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom CSS for the modal overlay and content */
        .modal-overlay {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgba(0,0,0,0.6); /* Black w/ opacity */
            justify-content: center; /* Center horizontally */
            align-items: center; /* Center vertically */
        }

        .modal-content {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            text-align: center;
            max-width: 400px; /* Max width for the modal */
            width: 90%; /* Responsive width */
            transform: translateY(-50px); /* Initial slight lift for animation */
            opacity: 0; /* Hidden for animation */
            animation: fadeInScale 0.3s ease-out forwards; /* Animation for appearance */
        }

        /* Animation for the modal */
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: translateY(-50px) scale(0.9);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
    </style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <?php
    $post_creation_successful = true; // Set this based on your PHP logic (e.g., after an INSERT query)
    $home_url = "../../index.php"; // Correct relative path to main site index
    ?>

    <!-- The Modal Pop-up -->
    <div id="successModal" class="modal-overlay">
        <div class="modal-content">
            <svg class="mx-auto mb-4 text-green-500" xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                <polyline points="22 4 12 14.01 9 11.01"></polyline>
            </svg>
            <h3 class="text-2xl font-bold text-gray-800 mb-3">Success!</h3>
            <p class="text-gray-600 mb-6">Post successfully created.</p>
            <button id="goHomeBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg shadow-md transition duration-300 ease-in-out transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75">
                Go back to home
            </button>
        </div>
    </div>

    <script>
        // Get the modal element
        const successModal = document.getElementById('successModal');
        // Get the "Go back to home" button
        const goHomeBtn = document.getElementById('goHomeBtn');

        // PHP variable to determine if the modal should show on page load
        const postCreationSuccessful = <?php echo json_encode($post_creation_successful); ?>;
        const homeURL = <?php echo json_encode($home_url); ?>;

        // Function to show the modal
        function showModal() {
            successModal.style.display = 'flex'; // Use 'flex' to enable centering via flexbox
        }

        // Function to hide the modal (though for "go home" it will redirect)
        function hideModal() {
            successModal.style.display = 'none';
        }

        // Event listener for the "Go back to home" button
        goHomeBtn.addEventListener('click', () => {
            window.location.href = homeURL; // Redirect to the home page
        });

        // Show the modal if post creation was successful (based on PHP variable)
        window.onload = function() {
            if (postCreationSuccessful) {
                showModal();
            }
        };

    
    </script>

</body>
</html>
