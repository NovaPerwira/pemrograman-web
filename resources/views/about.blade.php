<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About The Arc</title>
    <!-- Importing Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Importing Inter font from Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700;900&display=swap" rel="stylesheet">
    <style>
        /* Custom style for the font */
        body {
            font-family: 'Inter', sans-serif;
        }
        /* A subtle glow effect for the card */
        .neon-glow {
            box-shadow: 0 0 10px rgba(6, 182, 212, 0.3), 0 0 20px rgba(6, 182, 212, 0.2);
        }
    </style>
</head>
<body class="bg-gray-900 text-gray-200 antialiased min-h-screen flex items-center justify-center p-4">

    <!-- About Section Container -->
    <section class="w-full max-w-4xl">
        <div class="bg-gray-800/70 backdrop-blur-sm border border-cyan-500/30 rounded-xl overflow-hidden neon-glow">
            <div class="p-8 md:p-12">
                
                <!-- Header -->
                <h2 class="text-4xl md:text-5xl font-black text-center mb-4">
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">
                        About The Arc
                    </span>
                </h2>
                <p class="text-lg text-gray-400 text-center max-w-2xl mx-auto mb-10">
                    We are a bridge between timeless classics and next-generation technology.
                </p>

                <!-- Content Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    
                    <!-- Column 1: Our Vision -->
                    <div class="bg-gray-900/50 p-6 rounded-lg border border-gray-700/50">
                        <h3 class="text-2xl font-bold text-cyan-300 mb-3">
                            Our Vision
                        </h3>
                        <p class="text-gray-300 leading-relaxed">
                            Our mission is to preserve and enhance the most iconic games ever created. We're rebuilding beloved classics like Tetris, Snake, and Minecraft from the ground up, infusing them with stunning new visuals and seamless cross-platform play.
                        </p>
                    </div>

                    <!-- Column 2: The Technology -->
                    <div class="bg-gray-900/50 p-6 rounded-lg border border-gray-700/50">
                        <h3 class="text-2xl font-bold text-cyan-300 mb-3">
                            Future-Proof Tech
                        </h3>
                        <p class="text-gray-300 leading-relaxed">
                            Built on a lightweight, next-gen web architecture, The Arc delivers lightning-fast load times and a silky-smooth experience on any device. Your next game is just a click away—no downloads, no friction.
                        </p>
                    </div>
                </div>

                <!-- Call to Action / Closing Statement -->
                <div class="mt-12 text-center">
                    <p class="text-xl text-gray-200 font-medium">
                        Welcome to the evolution of retro gaming.
                    </p>
                </div>

            </div>
        </div>
    </section>

</body>
</html>
