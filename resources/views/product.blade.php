<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuristic Game Launcher</title>
    <!-- Load Tailwind CSS --><script src="https://cdn.tailwindcss.com"></script>
    <!-- Load Inter font --><link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
    <!-- Load Font Awesome for icons --><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom styles for a more futuristic feel */
        body {
            font-family: 'Inter', sans-serif;
            /* Add a subtle static noise background */
            background-color: #0a0a0f;
            overflow: hidden; /* Hide scrollbars for the demo */
        }

        /* Custom glow effect for the cards */
        .game-card:hover {
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.3), 0 0 25px rgba(0, 255, 255, 0.2);
            border-color: rgba(0, 255, 255, 0.7);
        }

        /* Custom glow for the main container */
        .launcher-container {
            border: 1px solid #2a2a3a;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.5), 0 0 40px rgba(0, 255, 255, 0.1);
            background: linear-gradient(145deg, rgba(16, 18, 27, 0.8), rgba(10, 10, 15, 0.9));
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Custom button style */
        .play-button {
            text-shadow: 0 0 10px rgba(0, 255, 255, 0.7);
            box-shadow: 0 0 15px rgba(0, 255, 255, 0.4), inset 0 0 5px rgba(0, 255, 255, 0.3);
        }
        .play-button:hover {
            box-shadow: 0 0 25px rgba(0, 255, 255, 0.7), inset 0 0 10px rgba(0, 255, 255, 0.5);
            transform: scale(1.05) translateY(-2px);
        }

        /* Custom modal styles */
        #message-modal {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }
        #message-modal-box {
            background: rgba(10, 10, 15, 0.9);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid #00ffff;
            box-shadow: 0 0 30px rgba(0, 255, 255, 0.5);
        }

        /* Icon styling */
        .game-icon {
            width: 80px; /* Smaller base size */
            height: 80px; /* Smaller base size */
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem; /* For Font Awesome */
            border-radius: 12px;
            margin-bottom: 1rem;
            flex-shrink: 0; /* Prevent icon from shrinking */
        }
        /* Specific colors for icons */
        .icon-tetris { color: #8B5CF6; border: 2px solid #8B5CF6; } /* Purple */
        .icon-snake { color: #10B981; border: 2px solid #10B981; } /* Emerald */
        .icon-minecraft { color: #EAB308; border: 2px solid #EAB308; } /* Amber */

        /* Responsive adjustments for icons */
        @media (min-width: 640px) { /* sm breakpoint */
            .game-icon {
                width: 96px; /* Larger on small screens */
                height: 96px;
                font-size: 5rem;
            }
        }
        @media (min-width: 768px) { /* md breakpoint */
            .game-icon {
                width: 112px; /* Even larger on medium screens */
                height: 112px;
                font-size: 6rem;
            }
        }
    </style>
</head>
<body class="text-gray-200">

    <!-- Background elements for visual flair --><div class="absolute inset-0 z-0 opacity-20">
        <div class="absolute top-0 left-0 w-1/3 h-1/3 bg-gradient-to-r from-cyan-900 to-transparent rounded-full filter blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-1/2 h-1/2 bg-gradient-to-l from-purple-900 to-transparent rounded-full filter blur-3xl"></div>
    </div>

    <!-- Main Content --><div class="relative min-h-screen flex items-center justify-center p-4 z-10">
        
        <!-- Game Launcher Section --><section class="launcher-container w-full max-w-5xl p-6 sm:p-10 rounded-2xl">
            <h1 class="text-4xl sm:text-5xl font-black text-center mb-2 text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-purple-600">
                GAME LAUNCHER
            </h1>
            <p class="text-center text-lg text-gray-400 mb-8 sm:mb-12">Select your experience</p>

            <!-- Game Selection Grid --><div class="grid grid-cols-1 md:grid-cols-3 gap-6 sm:gap-8">
                
                <!-- Tetris Card --><div class="game-card bg-gray-900/50 p-6 rounded-xl border border-gray-700 flex flex-col items-center text-center transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Tetris Icon --><div class="game-icon icon-tetris">
                        <i class="fas fa-th-large"></i> 
                    </div>
                    <h2 class="text-2xl font-bold mb-4">Tetris</h2>
                    <p class="text-gray-400 mb-6 text-sm flex-grow">Classic block-stacking puzzle. Clear lines and challenge your high score.</p>
                    <button onclick="showMessage('Tetris')" class="play-button w-full px-6 py-3 rounded-lg bg-cyan-600 text-white font-semibold shadow-lg transition-all duration-300 hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-opacity-50">
                        LAUNCH
                    </button>
                </div>

                <!-- Snake Card --><div class="game-card bg-gray-900/50 p-6 rounded-xl border border-gray-700 flex flex-col items-center text-center transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Snake Icon (SVG) --><div class="game-icon icon-snake">
                        <svg class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm-1 15v-4.5c0-.55-.45-1-1-1H7v-2h3c.55 0 1-.45 1-1V7h2v4.5c0 .55.45 1 1 1h3v2h-3c-.55 0-1 .45-1 1V17h-2z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-4">Snake</h2>
                    <p class="text-gray-400 mb-6 text-sm flex-grow">The original arcade classic. Grow your snake but don't hit the wall... or yourself.</p>
                    <button onclick="showMessage('Snake')" class="play-button w-full px-6 py-3 rounded-lg bg-cyan-600 text-white font-semibold shadow-lg transition-all duration-300 hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-opacity-50">
                        LAUNCH
                    </button>
                </div>

                <!-- Minecraft Card --><div class="game-card bg-gray-900/50 p-6 rounded-xl border border-gray-700 flex flex-col items-center text-center transition-all duration-300 transform hover:-translate-y-1">
                    <!-- Minecraft Icon (SVG) --><div class="game-icon icon-minecraft">
                        <svg class="w-20 h-20 sm:w-24 sm:h-24 md:w-28 md:h-28" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M19 3H5c-1.103 0-2 .897-2 2v14c0 1.103.897 2 2 2h14c1.103 0 2-.897 2-2V5c0-1.103-.897-2-2-2zM5 19V5h14l.002 14H5zM7 7h2v2H7V7zm4 0h2v2h-2V7zm4 0h2v2h-2V7zM7 11h2v2H7v-2zm4 0h2v2h-2v-2zm4 0h2v2h-2v-2zM7 15h2v2H7v-2zm4 0h2v2h-2v-2zm4 0h2v2h-2v-2z"/>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-4">Minecraft</h2>
                    <p class="text-gray-400 mb-6 text-sm flex-grow">An infinite world of blocks. Build, survive, explore, and create your own adventure.</p>
                    <button onclick="showMessage('Minecraft')" class="play-button w-full px-6 py-3 rounded-lg bg-cyan-600 text-white font-semibold shadow-lg transition-all duration-300 hover:bg-cyan-500 focus:outline-none focus:ring-2 focus:ring-cyan-400 focus:ring-opacity-50">
                        LAUNCH
                    </button>
                </div>

            </div>
        </section>

    </div>

    <!-- Custom Message Modal (replaces alert) --><div id="message-modal" class="fixed inset-0 bg-black/80 flex items-center justify-center p-4 z-50 opacity-0 transform scale-95 pointer-events-none">
        <div id="message-modal-box" class="w-full max-w-sm p-6 rounded-xl text-center">
            <h3 class="text-2xl font-bold text-cyan-400 mb-4">Launching</h3>
            <p id="modal-message-text" class="text-lg text-gray-200 mb-6"></p>
            <button id="modal-close-btn" class="px-6 py-2 rounded-lg bg-gray-700 text-white font-semibold transition-all duration-300 hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500">
                Close
            </button>
        </div>
    </div>

    <script>
        const modal = document.getElementById('message-modal');
        const modalMessage = document.getElementById('modal-message-text');
        const modalCloseBtn = document.getElementById('modal-close-btn');

        // Function to show the modal
        function showMessage(gameName) {
            modalMessage.textContent = `Initializing launch sequence for ${gameName}...`;
            modal.classList.remove('opacity-0', 'scale-95', 'pointer-events-none');
            modal.classList.add('opacity-100', 'scale-100');
        }

        // Function to hide the modal
        function hideModal() {
            modal.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('pointer-events-none');
            }, 300); // Wait for transition to finish
        }

        // Event listener for the close button
        modalCloseBtn.addEventListener('click', hideModal);

        // Close modal if user clicks on the background overlay
        modal.addEventListener('click', function(event) {
            if (event.target === modal) {
                hideModal();
            }
        });
    </script>

</body>
</html>

