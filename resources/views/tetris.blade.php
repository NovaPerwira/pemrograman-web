<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pertemuan 1 - Game Tetris Piksel</title>
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
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            text-align: center;
        }

        /* Kontainer utama game */
        .main-container {
            display: flex;
            gap: 30px;
            align-items: flex-start;
        }
        
        .game-container {
            border: 4px solid #4a4a4a;
            border-radius: 8px;
            padding: 20px;
            background-color: #000;
            box-shadow: 0 0 20px rgba(0, 191, 255, 0.3);
        }

        /* Judul */
        h1 {
            color: #00BFFF; /* Deep sky blue */
            text-shadow: 2px 2px #ff00ff; /* Bayangan magenta */
            font-size: 2rem;
            margin-bottom: 20px;
        }

        /* Kanvas utama game */
        #gameCanvas {
            background-color: #000000;
            border: 2px solid #00BFFF;
            box-shadow: inset 0 0 10px #00BFFF;
        }

        /* Info Panel (Skor, Level, Berikutnya) */
        .info-panel {
            width: 200px;
            text-align: left;
        }

        .info-box {
            background: #000;
            border: 2px solid #4a4a4a;
            padding: 15px;
            margin-bottom: 20px;
            font-size: 1rem;
        }

        .info-box h2 {
            margin: 0 0 10px 0;
            font-size: 1.2rem;
            color: #00BFFF;
        }
        
        #nextPieceCanvas {
             background-color: #000;
             display: block;
             margin: 0 auto;
        }

        /* Pesan Game Over */
        #gameOverText {
            display: none; /* Sembunyikan secara default */
            position: absolute;
            color: #ff0000;
            font-size: 2.5rem;
            text-shadow: 2px 2px #fff;
            z-index: 10;
            text-align: center;
        }

        /* Tombol */
        button {
            font-family: 'Press Start 2P', cursive;
            background-color: #4a4a4a;
            color: #ffffff;
            border: 2px solid #ffffff;
            padding: 15px 25px;
            font-size: 1rem;
            cursor: pointer;
            margin-top: 10px;
            width: 100%;
            transition: all 0.2s ease;
        }

        button:hover {
            background-color: #00BFFF;
            color: #000;
            border-color: #00BFFF;
            box-shadow: 0 0 15px #00BFFF;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <!-- Panel Info di Kanan -->
        <div class="info-panel">
            <h1>TETRIS</h1>
            <div class="info-box">
                <h2>SKOR</h2>
                <span id="score">0</span>
            </div>
            <div class="info-box">
                <h2>BARIS</h2>
                <span id="lines">0</span>
            </div>
             <div class="info-box">
                <h2>LEVEL</h2>
                <span id="level">1</span>
            </div>
            <div class="info-box">
                <h2>BERIKUTNYA</h2>
                <canvas id="nextPieceCanvas" width="80" height="80"></canvas>
            </div>
            <button id="restartButton">Mulai Ulang</button>
        </div>

        <!-- Game Container di Kiri -->
        <div class="game-container">
             <div style="position: relative; display: inline-block;">
                <div id="gameOverText">GAME<br>OVER</div>
                <canvas id="gameCanvas" width="240" height="480"></canvas>
            </div>
        </div>
    </div>


    <script>
        const canvas = document.getElementById('gameCanvas');
        const ctx = canvas.getContext('2d');
        const nextCanvas = document.getElementById('nextPieceCanvas');
        const nextCtx = nextCanvas.getContext('2d');

        const scoreEl = document.getElementById('score');
        const linesEl = document.getElementById('lines');
        const levelEl = document.getElementById('level');
        const restartButton = document.getElementById('restartButton');
        const gameOverText = document.getElementById('gameOverText');

        const COLS = 12;
        const ROWS = 24;
        const BLOCK_SIZE = 20;

        ctx.canvas.width = COLS * BLOCK_SIZE;
        ctx.canvas.height = ROWS * BLOCK_SIZE;

        const SHAPES = [
            [[1,1,1,1]], // I
            [[1,1],[1,1]], // O
            [[0,1,0],[1,1,1]], // T
            [[1,0,0],[1,1,1]], // L
            [[0,0,1],[1,1,1]], // J
            [[0,1,1],[1,1,0]], // S
            [[1,1,0],[0,1,1]] // Z
        ];
        const COLORS = ['#00BFFF', '#FFFF00', '#EE82EE', '#FFA500', '#0000FF', '#00FF00', '#FF0000'];

        let board = Array.from({ length: ROWS }, () => Array(COLS).fill(0));
        let currentPiece, nextPiece;
        let score = 0, lines = 0, level = 1;
        let isGameOver = false;

        let lastTime = 0;
        let dropCounter = 0;
        let dropInterval = 1000;

        function createPiece() {
            const index = Math.floor(Math.random() * SHAPES.length);
            return {
                shape: SHAPES[index],
                color: COLORS[index],
                x: Math.floor(COLS / 2) - 1,
                y: 0
            };
        }

        function drawBlock(ctx, x, y, color) {
            ctx.fillStyle = color;
            ctx.fillRect(x * BLOCK_SIZE, y * BLOCK_SIZE, BLOCK_SIZE, BLOCK_SIZE);
            ctx.strokeStyle = '#000';
            ctx.strokeRect(x * BLOCK_SIZE, y * BLOCK_SIZE, BLOCK_SIZE, BLOCK_SIZE);
        }

        function draw() {
            // Gambar board utama
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            board.forEach((row, y) => {
                row.forEach((value, x) => {
                    if (value > 0) {
                        drawBlock(ctx, x, y, COLORS[value - 1]);
                    }
                });
            });

            // Gambar piece yang sedang jatuh
            currentPiece.shape.forEach((row, y) => {
                row.forEach((value, x) => {
                    if (value) {
                        drawBlock(ctx, currentPiece.x + x, currentPiece.y + y, currentPiece.color);
                    }
                });
            });
            
            // Gambar piece berikutnya
            nextCtx.clearRect(0,0, nextCanvas.width, nextCanvas.height);
            const previewSize = nextPiece.shape.length;
            nextPiece.shape.forEach((row, y) => {
                row.forEach((value, x) => {
                    if (value) {
                       nextCtx.fillStyle = nextPiece.color;
                       nextCtx.fillRect(
                           (x + (4-previewSize)/2) * (BLOCK_SIZE/2), 
                           (y + (4-previewSize)/2) * (BLOCK_SIZE/2), 
                           BLOCK_SIZE/2, 
                           BLOCK_SIZE/2
                        );
                    }
                });
            });
        }
        
        function collision(piece, offsetX, offsetY) {
            for (let y = 0; y < piece.shape.length; y++) {
                for (let x = 0; x < piece.shape[y].length; x++) {
                    if (piece.shape[y][x]) {
                        let newX = piece.x + x + offsetX;
                        let newY = piece.y + y + offsetY;
                        if (newX < 0 || newX >= COLS || newY >= ROWS || (board[newY] && board[newY][newX])) {
                            return true;
                        }
                    }
                }
            }
            return false;
        }

        function lockPiece() {
            currentPiece.shape.forEach((row, y) => {
                row.forEach((value, x) => {
                    if (value) {
                        board[currentPiece.y + y][currentPiece.x + x] = COLORS.indexOf(currentPiece.color) + 1;
                    }
                });
            });
        }

        function clearLines() {
            let linesCleared = 0;
            outer: for (let y = ROWS - 1; y > 0; --y) {
                for (let x = 0; x < COLS; ++x) {
                    if (board[y][x] === 0) {
                        continue outer;
                    }
                }
                const row = board.splice(y, 1)[0].fill(0);
                board.unshift(row);
                ++y;
                linesCleared++;
            }
            
            if (linesCleared > 0) {
                lines += linesCleared;
                score += (linesCleared * 10) * linesCleared * level;
                if (lines >= level * 10) {
                    level++;
                    dropInterval = Math.max(200, 1000 - (level * 100));
                }
            }
        }
        
        function resetPiece() {
            currentPiece = nextPiece;
            nextPiece = createPiece();
            if (collision(currentPiece, 0, 0)) {
                isGameOver = true;
                gameOverText.style.display = 'block';
                const canvasRect = canvas.getBoundingClientRect();
                gameOverText.style.left = canvasRect.left + 'px';
                gameOverText.style.top = canvasRect.top + (canvas.height / 2) - 50 + 'px';
                gameOverText.style.width = canvas.width + 'px';
            }
        }

        function update(time = 0) {
            if (isGameOver) return;
            
            const deltaTime = time - lastTime;
            lastTime = time;
            dropCounter += deltaTime;

            if (dropCounter > dropInterval) {
                movePiece(0, 1);
                dropCounter = 0;
            }
            
            scoreEl.innerText = score;
            linesEl.innerText = lines;
            levelEl.innerText = level;

            draw();
            requestAnimationFrame(update);
        }

        function movePiece(offsetX, offsetY) {
            if (!collision(currentPiece, offsetX, offsetY)) {
                currentPiece.x += offsetX;
                currentPiece.y += offsetY;
            } else if (offsetY > 0) {
                lockPiece();
                clearLines();
                resetPiece();
            }
        }

        function rotatePiece() {
            const shape = currentPiece.shape;
            const newShape = shape[0].map((_, colIndex) => shape.map(row => row[colIndex]).reverse());
            
            // Wall kick
            const originalX = currentPiece.x;
            let offset = 1;
            while(collision({ ...currentPiece, shape: newShape }, 0, 0)) {
                currentPiece.x += offset;
                offset = -(offset + (offset > 0 ? 1 : -1));
                if (offset > newShape[0].length) {
                    currentPiece.x = originalX; // Can't rotate, revert
                    return;
                }
            }
            currentPiece.shape = newShape;
        }

        document.addEventListener('keydown', e => {
            if(isGameOver) return;
            if (e.key === 'ArrowLeft') movePiece(-1, 0);
            else if (e.key === 'ArrowRight') movePiece(1, 0);
            else if (e.key === 'ArrowDown') movePiece(0, 1);
            else if (e.key === 'ArrowUp') rotatePiece();
        });

        function startGame() {
            board.forEach(row => row.fill(0));
            score = 0;
            lines = 0;
            level = 1;
            dropInterval = 1000;
            isGameOver = false;
            gameOverText.style.display = 'none';
            nextPiece = createPiece();
            resetPiece();
            update();
        }
        
        restartButton.addEventListener('click', startGame);

        startGame();
    </script>
</body>
</html>
