<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 1 - Game Ular Piksel</title>
    <!-- Google Fonts untuk gaya retro/pixel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        /* Gaya dasar halaman */
        body {
            background-color: #1a1a1a; /* Latar belakang gelap */
            color: #ffffff;
            font-family: 'Press Start 2P', cursive;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            text-align: center;
        }

        /* Kontainer utama game */
        .game-container {
            border: 4px solid #4a4a4a;
            border-radius: 8px;
            padding: 20px;
            background-color: #000;
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.3);
        }

        /* Judul */
        h1 {
            color: #00ff00; /* Hijau neon */
            text-shadow: 2px 2px #ff00ff; /* Bayangan magenta */
            font-size: 2rem;
            margin-bottom: 10px;
        }

        /* Tampilan Skor */
        .score-display {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }
        
        /* Kanvas tempat game berjalan */
        #gameCanvas {
            background-color: #000000;
            border: 2px solid #00ff00;
            box-shadow: inset 0 0 10px #00ff00;
        }

        /* Pesan Game Over */
        #gameOverText {
            display: none; /* Sembunyikan secara default */
            position: absolute;
            color: #ff0000;
            font-size: 2rem;
            text-shadow: 2px 2px #fff;
            z-index: 10;
        }

        /* Tombol */
        button {
            font-family: 'Press Start 2P', cursive;
            background-color: #4a4a4a;
            color: #ffffff;
            border: 2px solid #ffffff;
            padding: 10px 20px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 20px;
            transition: all 0.2s ease;
        }

        button:hover {
            background-color: #00ff00;
            color: #000;
            border-color: #00ff00;
            box-shadow: 0 0 15px #00ff00;
        }

        /* Petunjuk */
        .instructions {
            margin-top: 20px;
            font-size: 0.8rem;
            color: #aaaaaa;
        }
    </style>
</head>
<body>

    <div class="game-container">
        <h1>Ular Piksel</h1>
        <div class="score-display">SKOR: <span id="score">0</span></div>
        <div style="position: relative; display: inline-block;">
            <div id="gameOverText">GAME OVER</div>
            <canvas id="gameCanvas" width="400" height="400"></canvas>
        </div>
        <button id="restartButton">Mulai Ulang</button>
        <p class="instructions">Gunakan tombol panah untuk bergerak!</p>
    </div>

    <script>
        // Mengakses elemen dari HTML
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');
        const scoreElement = document.getElementById('score');
        const restartButton = document.getElementById('restartButton');
        const gameOverText = document.getElementById('gameOverText');

        // Pengaturan Game
        const gridSize = 20; // Ukuran setiap kotak di grid
        const tileCount = canvas.width / gridSize;
        let speed = 7; // Kecepatan game (frame per detik)

        // Variabel Game
        let snake = [{ x: 10, y: 10 }];
        let food = { x: 15, y: 15 };
        let velocity = { x: 0, y: 0 };
        let score = 0;
        let isGameOver = false;

        // Fungsi utama game loop
        function gameLoop() {
            if (isGameOver) return;

            // Pindahkan ular
            changeSnakePosition();

            // Cek tabrakan
            let result = checkCollisions();
            if (result) {
                gameOver();
                return;
            }

            // Cek makan
            checkEatFood();

            // Gambar ulang semua elemen
            draw();

            // Atur loop berikutnya
            setTimeout(gameLoop, 1000 / speed);
        }

        // Fungsi untuk mengakhiri game
        function gameOver() {
            isGameOver = true;
            gameOverText.style.display = 'block';
            // Posisikan teks "GAME OVER" di tengah canvas
            const canvasRect = canvas.getBoundingClientRect();
            gameOverText.style.left = canvasRect.left + (canvas.width - gameOverText.offsetWidth) / 2 + 'px';
            gameOverText.style.top = canvasRect.top + (canvas.height - gameOverText.offsetHeight) / 2 + 'px';
        }

        // Fungsi untuk menggambar semua elemen di kanvas
        function draw() {
            // Latar belakang
            ctx.fillStyle = '#000';
            ctx.fillRect(0, 0, canvas.width, canvas.height);

            // Ular
            ctx.fillStyle = '#00ff00'; // Warna hijau neon
            snake.forEach(part => {
                ctx.fillRect(part.x * gridSize, part.y * gridSize, gridSize - 2, gridSize - 2);
            });

            // Makanan
            ctx.fillStyle = '#ff0000'; // Warna merah
            ctx.fillRect(food.x * gridSize, food.y * gridSize, gridSize, gridSize);
            ctx.fillStyle = '#ff6666'; // Highlight makanan
            ctx.fillRect(food.x * gridSize + 4, food.y * gridSize + 4, gridSize - 8, gridSize - 8);
        }

        // Memperbarui posisi ular
        function changeSnakePosition() {
            // Buat kepala baru berdasarkan kecepatan
            const head = { x: snake[0].x + velocity.x, y: snake[0].y + velocity.y };
            // Tambahkan kepala baru di depan
            snake.unshift(head);
            // Hapus ekor
            snake.pop();
        }

        // Cek tabrakan dengan dinding atau diri sendiri
        function checkCollisions() {
            const head = snake[0];

            // Tabrakan dinding
            if (head.x < 0 || head.x >= tileCount || head.y < 0 || head.y >= tileCount) {
                return true;
            }

            // Tabrakan diri sendiri
            for (let i = 1; i < snake.length; i++) {
                if (head.x === snake[i].x && head.y === snake[i].y) {
                    return true;
                }
            }

            return false;
        }

        // Cek apakah ular memakan makanan
        function checkEatFood() {
            if (snake[0].x === food.x && snake[0].y === food.y) {
                // Tambah skor dan perbarui tampilan
                score++;
                scoreElement.textContent = score;

                // Tambah kecepatan setiap 5 poin
                if(score % 5 === 0) {
                    speed++;
                }

                // Tumbuhkan ular dengan menambahkan kembali ekor yang tadi dihapus
                snake.push({ ...snake[snake.length - 1] });

                // Pindahkan makanan ke posisi acak baru
                generateFood();
            }
        }

        // Membuat makanan di posisi acak
        function generateFood() {
            food.x = Math.floor(Math.random() * tileCount);
            food.y = Math.floor(Math.random() * tileCount);

            // Pastikan makanan tidak muncul di atas badan ular
            snake.forEach(part => {
                if (part.x === food.x && part.y === food.y) {
                    generateFood(); // Coba lagi jika bertumpuk
                }
            });
        }

        // Event listener untuk input keyboard
        document.addEventListener('keydown', e => {
            switch (e.key) {
                case 'ArrowUp':
                    if (velocity.y === 0) velocity = { x: 0, y: -1 };
                    break;
                case 'ArrowDown':
                    if (velocity.y === 0) velocity = { x: 0, y: 1 };
                    break;
                case 'ArrowLeft':
                    if (velocity.x === 0) velocity = { x: -1, y: 0 };
                    break;
                case 'ArrowRight':
                    if (velocity.x === 0) velocity = { x: 1, y: 0 };
                    break;
            }
        });

        // Event listener untuk tombol restart
        restartButton.addEventListener('click', () => {
            // Reset semua variabel ke kondisi awal
            snake = [{ x: 10, y: 10 }];
            food = { x: 15, y: 15 };
            velocity = { x: 0, y: 0 };
            score = 0;
            speed = 7;
            scoreElement.textContent = 0;
            isGameOver = false;
            gameOverText.style.display = 'none';

            // Mulai lagi game loop
            gameLoop();
        });
        
        // Memulai game untuk pertama kali
        gameLoop();
    </script>

</body>
</html>
