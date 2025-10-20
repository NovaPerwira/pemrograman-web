<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Futuristic Floating Navbar</title>
    <!-- Google Fonts: Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        /* --- Base Styles & Body --- */
        :root {
            --navbar-height: 60px;
        }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            /* Added background image for contrast to see the floating/blur effect */
            background-image: linear-gradient(to bottom right, #6a11cb, #2575fc);
            background-attachment: fixed;
            color: #f0f0f0;
            /* Add padding to the top to prevent content from hiding behind the fixed navbar */
            padding-top: calc(var(--navbar-height) + 3rem);
        }

        /* --- Dummy Content for Scrolling Demo --- */
        .content {
            padding: 2rem;
            max-width: 800px;
            margin: 0 auto;
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 20px;
        }

        h1 {
            font-size: 3rem;
            text-align: center;
        }
        
        p {
            line-height: 1.8;
            font-size: 1.1rem;
            text-align: justify;
        }

        /* --- Navbar Container --- */
        .floating-navbar {
            position: fixed;
            top: 1.5rem; /* Distance from the top of the viewport */
            left: 50%;
            transform: translateX(-50%);
            width: 95%;
            max-width: 1100px;
            height: var(--navbar-height);
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 25px;
            border-radius: 9999px; /* Pill shape */
            z-index: 1000;

            /* --- iOS Frosted Glass Effect --- */
            background: rgba(35, 35, 45, 0.5); /* Semi-transparent background */
            -webkit-backdrop-filter: blur(20px); /* Safari */
            backdrop-filter: blur(20px); /* Standard */
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3);
            
            /* --- Smooth Transition --- */
            transition: all 0.3s ease-in-out;
        }

        /* --- Logo / Brand Name --- */
        .navbar-logo a {
            font-size: 1.5rem;
            font-weight: 700;
            color: #ffffff;
            text-decoration: none;
            letter-spacing: -1px;
        }

        /* --- Navigation Links (Desktop) --- */
        .navbar-links {
            list-style: none;
            display: flex;
            gap: 2rem;
            margin: 0;
            padding: 0;
        }

        .navbar-links li a {
            color: #d1d5db; /* Light gray for links */
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 0;
            position: relative;
            transition: color 0.3s ease;
        }
        
        /* Underline effect on hover */
        .navbar-links li a::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #ffffff;
            transition: width 0.3s ease;
        }

        .navbar-links li a:hover {
            color: #ffffff;
        }

        .navbar-links li a:hover::after {
            width: 100%;
        }

        /* --- Hamburger Menu Button (Mobile) --- */
        .mobile-menu-toggle {
            display: none; /* Hidden by default */
            background: none;
            border: none;
            cursor: pointer;
            padding: 0.5rem;
            z-index: 1001; /* Above navbar content */
        }

        .mobile-menu-toggle .icon {
            stroke: #ffffff;
            width: 28px;
            height: 28px;
            transition: transform 0.3s ease-in-out;
        }

        /* --- Responsive Styles (Mobile View) --- */
        @media (max-width: 768px) {
            .navbar-links {
                /* Transform nav links into a vertical dropdown menu */
                position: absolute;
                top: calc(var(--navbar-height) + 1rem);
                left: 0;
                right: 0;
                width: 95%;
                margin: 0 auto;
                flex-direction: column;
                align-items: center;
                gap: 0;
                padding: 1rem 0;
                
                /* Use the same glass effect */
                background: rgba(50, 50, 60, 0.7);
                -webkit-backdrop-filter: blur(15px);
                backdrop-filter: blur(15px);
                border: 1px solid rgba(255, 255, 255, 0.1);
                border-radius: 20px;
                box-shadow: 0 8px 20px rgba(0,0,0,0.25);
                
                /* Hide menu by default */
                opacity: 0;
                visibility: hidden;
                transform: translateY(-10px);
                transition: opacity 0.3s ease, transform 0.3s ease, visibility 0.3s;
            }

            .navbar-links.active {
                /* Show menu when active */
                opacity: 1;
                visibility: visible;
                transform: translateY(0);
            }

            .navbar-links li {
                width: 100%;
                text-align: center;
            }

            .navbar-links li a {
                display: block;
                padding: 1rem 0;
                width: 100%;
            }

            .mobile-menu-toggle {
                display: block; /* Show the hamburger button on mobile */
            }
        }
    </style>
</head>
<body>

    <!-- 
      NAVBAR COMPONENT 
      You can copy this <nav> block into your Laravel layout file.
    -->
    <nav class="floating-navbar">
        <div class="navbar-logo">
            <!-- Replace with your Laravel route or URL -->
            <a href="#">Futura</a>
        </div>
        
        <ul class="navbar-links" id="navbar-links">
         
            <li><a href="{{ url('/tetris') }}">Tetris</a></li>
            <li><a href="{{ url('/minecraft') }}">minecraft</a></li>
            <li><a href="{{ url('/yoyok') }}">yoyok</a></li>
          
          
        </ul>

        <button class="mobile-menu-toggle" id="mobile-menu-toggle" aria-label="Toggle menu">
            <!-- Hamburger Icon -->
            <svg id="icon-hamburger" class="icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
            <!-- Close (X) Icon - Initially hidden -->
            <svg id="icon-close" class="icon" style="display: none;" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
        </button>
    </nav>

    <!-- Dummy Content to demonstrate scrolling -->
    <div class="content">
        <h1>Floating Navbar Demo</h1>
        <p>Scroll down to see the navbar stay fixed at the top. The design uses a "frosted glass" effect, common in iOS and other modern user interfaces. It's fully responsive and will collapse into a hamburger menu on smaller screens.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Aliquam nibh.</p>
        <p>Maecenas fermentum, sem in pharetra pellentesque, velit turpis volutpat ante, in pharetra metus odio a lectus. Curabitur vitae diam non enim vestibulum interdum. Nulla quis diam. Ut ac elit. Quisque ut nisi. Integer id magna. Cras pede libero, dapibus nec, pretium sit amet, tempor quis. Etiam neque. Nulla facilisi. Duis sit amet quam. Donec ipsum massa, ullamcorper in, auctor et, scelerisque sed, est. Sed vel lectus. Donec odio tempus molestie, porttitor ut, iaculis quis, sem. Phasellus rhoncus. Aenean id metus id velit ullamcorper pulvinar. Vestibulum fermentum tortor id mi. Pellentesque ipsum. Nulla ac enim. In tempor, turpis nec euismod scelerisque, quam turpis adipiscing lorem, vitae mattis nibh ligula nec sem.</p>
        <p>Duis aliquam convallis nunc. Proin at turpis a pede posuere nonummy. Integer non velit. Donec diam neque, vestibulum eget, vulputate ut, ultrices vel, augue. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec pharetra, magna vestibulum aliquet ultrices, erat tortor sollicitudin mi, sit amet lobortis sapien sapien non mi. Integer ac neque. Duis bibendum. Morbi non quam nec dui luctus rutrum. Nulla tellus. In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus. Suspendisse potenti. In eleifend quam a odio. In hac habitasse platea dictumst.</p>
    </div>

    <script>
        // --- JavaScript for Mobile Menu Toggle ---
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('mobile-menu-toggle');
            const navbarLinks = document.getElementById('navbar-links');
            const iconHamburger = document.getElementById('icon-hamburger');
            const iconClose = document.getElementById('icon-close');

            menuToggle.addEventListener('click', function() {
                // Toggle the 'active' class on the navigation links container
                navbarLinks.classList.toggle('active');

                // Toggle the visibility of the hamburger and close icons
                const isActive = navbarLinks.classList.contains('active');
                iconHamburger.style.display = isActive ? 'none' : 'block';
                iconClose.style.display = isActive ? 'block' : 'none';
            });
        });
    </script>

</body>
</html>
