<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Games</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Font: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;700;900&display=swap" rel="stylesheet">

    <style>
        /* Base styles */
        body {
            font-family: 'Inter', sans-serif;
            /* Starry night background effect */
            background-color: #0a0a0f;
            background-image: radial-gradient(circle, #1a1a2e 1px, transparent 1px);
            background-size: 20px 20px;
        }

        /* Custom class for the "active" nav link */
        .nav-active {
            color: #22d3ee; /* Tailwind's cyan-400 */
            text-shadow: 0 0 10px #22d3ee;
        }

        /* Subtle glow effect for cards */
        .game-card:hover {
            box-shadow: 0 0 25px rgba(34, 211, 238, 0.2);
            transform: scale(1.03);
        }
    </style>
</head>
<body class="text-gray-300">

    <!-- Header & Navigation -->
    <header class="fixed top-0 left-0 right-0 z-50 backdrop-blur-md bg-black/30 border-b border-gray-800">
        <nav class="container mx-auto max-w-5xl px-6 py-4 flex justify-between items-center">
            <!-- Logo/Brand Name -->
            <a href="#home" class="text-2xl font-bold text-white tracking-wider">
                NOVA<span class="text-cyan-400">GAMES</span>
            </a>
            
            <!-- Navigation Links -->
            <ul class="flex space-x-6 md:space-x-10">
                <li><a href="#home" class="nav-link text-gray-300 hover:text-cyan-400 transition duration-300">Home</a></li>
                <li><a href="#product" class="nav-link text-gray-300 hover:text-cyan-400 transition duration-300">Product</a></li>
                <li><a href="#about" class="nav-link text-gray-300 hover:text-cyan-400 transition duration-300">About</a></li>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto max-w-5xl px-6">

        <!-- Home Section (Hero) -->
        <section id="home" class="min-h-screen flex flex-col justify-center items-center text-center pt-20">
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-black text-white uppercase tracking-tighter">
                Classics
                <span class="block bg-clip-text text-transparent bg-gradient-to-r from-cyan-400 to-pink-500">Reimagined</span>
            </h1>
            <p class="mt-6 text-lg md:text-xl text-gray-400 max-w-2xl">
                Rediscover the pixel-perfect joy of gaming's golden age. Simple, addictive, and timeless.
            </p>
            <a href="#product" class="mt-10 px-6 py-3 bg-cyan-500 text-black font-bold rounded-lg shadow-lg shadow-cyan-500/30 hover:bg-cyan-400 hover:shadow-cyan-400/40 transition-all duration-300">
                Explore Games
            </a>
        </section>

        <!-- Product Section -->
        <section id="product" class="min-h-screen py-24">
            <h2 class="text-4xl font-bold text-center text-white mb-4">The Icons</h2>
            <p class="text-center text-gray-400 mb-16 max-w-xl mx-auto">These aren't just games. They're the foundation. Simple mechanics, infinite challenge.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                <!-- Game Card: Tetris -->
                <div class="game-card bg-gray-900/70 border border-gray-800 rounded-xl overflow-hidden shadow-xl transition-all duration-300">
                    <div class="p-8">
                        <!-- Simple SVG icon for Tetris -->
                        <div class="w-16 h-16 flex items-center justify-center rounded-lg bg-gradient-to-br from-purple-500 to-pink-500 mb-6 shadow-lg shadow-purple-500/20">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4 4l4-4M4 8l4-4l4 4m6 0l4 4l-4 4M18 8l4-4l-4-4"></path></svg>
                        </div>
                        <h3 class="text-3xl font-bold text-white mb-3">Tetris</h3>
                        <p class="text-gray-400">
                            The perfect puzzle. Fit the falling blocks, clear the lines, and chase the high score. A masterpiece of elegant design and escalating tension.
                        </p>
                    </div>
                </div>

                <!-- Game Card: Snake -->
                <div class="game-card bg-gray-900/70 border border-gray-800 rounded-xl overflow-hidden shadow-xl transition-all duration-300">
                    <div class="p-8">
                        <!-- Simple SVG icon for Snake -->
                        <div class="w-16 h-16 flex items-center justify-center rounded-lg bg-gradient-to-br from-green-500 to-cyan-500 mb-6 shadow-lg shadow-green-500/20">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a8 8 0 11-12.856-12.856M14 10l-4 4m0 0l-4-4m4 4V6"></path></svg>
                        </div>
                        <h3 class="text-3xl font-bold text-white mb-3">Snake</h3>
                        <p class="text-gray-400">
                            The ultimate test of growth and risk. Guide your snake to eat and grow, but don't run into yourself or the wall. Deceptively simple, endlessly addictive.
                        </p>
                    </div>
                </div>
                
            </div>
        </section>

        <!-- About Section -->
        <section id="about" class="min-h-screen flex items-center justify-center py-24">
            <div class="text-center max-w-3xl">
                <h2 class="text-4xl font-bold text-white mb-6">About This Project</h2>
                <div class="space-y-6 text-lg text-gray-400">
                    <p>
                        This is a tribute to the pioneers of play. In an era of hyper-realistic graphics and complex narratives, there's a unique beauty in the games that started it all.
                    </p>
                    <p>
                        Our mission is to celebrate this legacy. We believe that great design is timeless, and these games are a testament to that. This project explores futuristic UI concepts applied to the foundations of interactive entertainment.
                    </p>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-800 mt-20">
        <div class="container mx-auto max-w-5xl px-6 py-8 text-center text-gray-500">
            <p>&copy; 2025 Nova Games. All pixels reserved.</p>
        </div>
    </footer>

    <script>
        // JavaScript for active navigation link highlighting on scroll
        document.addEventListener('DOMContentLoaded', () => {
            const sections = document.querySelectorAll('section');
            const navLinks = document.querySelectorAll('.nav-link');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Get the id of the intersecting section
                        const id = entry.target.getAttribute('id');
                        
                        // Remove 'nav-active' from all links
                        navLinks.forEach(link => {
                            link.classList.remove('nav-active');
                            // Also remove active class if href doesn't match id
                            if (!link.href.includes(id)) {
                                link.classList.remove('nav-active');
                            }
                        });

                        // Add 'nav-active' to the matching link
                        const activeLink = document.querySelector(`.nav-link[href="#${id}"]`);
                        if (activeLink) {
                            activeLink.classList.add('nav-active');
                        }
                    }
                });
            }, {
                rootMargin: '-50% 0px -50% 0px', // Triggers when section is in the middle 50% of the viewport
                threshold: 0
            });

            // Observe each section
            sections.forEach(section => {
                observer.observe(section);
            });

            // Set the 'Home' link as active by default on load
            const homeLink = document.querySelector('.nav-link[href="#home"]');
            if (homeLink) {
                homeLink.classList.add('nav-active');
            }
        });
    </script>

</body>
</html>

