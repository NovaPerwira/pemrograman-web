<!DOCTYPE html>
<html lang="id">
<head>
    <title>Pertemuan 1 - Dunia Balok 3D</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            overflow: hidden;
            font-family: 'Press Start 2P', cursive;
            background-color: #000;
        }
        canvas {
            display: block;
        }
        #blocker {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            cursor: pointer;
        }
        #instructions {
            width: 80%;
            max-width: 600px;
        }
        #instructions h1 {
             color: #00BFFF;
             text-shadow: 2px 2px #ff00ff;
        }
        .key {
            background: #333;
            border: 2px solid #555;
            padding: 5px 10px;
            border-radius: 5px;
            display: inline-block;
            margin: 2px;
        }
        #crosshair {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 4px;
            height: 4px;
            background-color: white;
            border: 1px solid black;
            border-radius: 50%;
            transform: translate(-50%, -50%);
            display: none; /* Initially hidden */
        }
    </style>
</head>
<body>
    <div id="blocker">
        <div id="instructions">
            <h1>Dunia Balok 3D</h1>
            <p>
                <span class="key">W</span> <span class="key">A</span> <span class="key">S</span> <span class="key">D</span> untuk Bergerak<br>
                <span class="key">SPACE</span> untuk Lompat<br>
                <span class="key">MOUSE</span> untuk Melihat Sekitar<br>
                <span class="key">KLIK KIRI</span> untuk Hapus Balok<br>
                <span class="key">KLIK KANAN</span> untuk Tambah Balok<br><br>
                <strong>KLIK UNTUK MEMULAI</strong>
            </p>
        </div>
    </div>

    <div id="crosshair"></div>

    <script type="importmap">
        {
            "imports": {
                "three": "https://cdn.jsdelivr.net/npm/three@0.160.0/build/three.module.js",
                "three/addons/": "https://cdn.jsdelivr.net/npm/three@0.160.0/examples/jsm/"
            }
        }
    </script>
    <script type="module">
        import * as THREE from 'three';
        import { PointerLockControls } from 'three/addons/controls/PointerLockControls.js';

        let camera, scene, renderer, controls;
        const objects = [];
        let raycaster;

        let moveForward = false;
        let moveBackward = false;
        let moveLeft = false;
        let moveRight = false;
        let canJump = false;

        let prevTime = performance.now();
        const velocity = new THREE.Vector3();
        const direction = new THREE.Vector3();

        const blocker = document.getElementById('blocker');
        const instructions = document.getElementById('instructions');
        const crosshair = document.getElementById('crosshair');

        init();
        animate();

        function init() {
            camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
            camera.position.y = 10;

            scene = new THREE.Scene();
            scene.background = new THREE.Color(0x87ceeb); // Sky blue background
            scene.fog = new THREE.Fog(0x87ceeb, 0, 150);

            const light = new THREE.HemisphereLight(0xeeeeff, 0x777788, 0.75);
            light.position.set(0.5, 1, 0.75);
            scene.add(light);

            const dirLight = new THREE.DirectionalLight(0xffffff, 0.5);
            dirLight.position.set( -10, 15, -10 );
            dirLight.castShadow = true;
            scene.add(dirLight);

            controls = new PointerLockControls(camera, document.body);

            blocker.addEventListener('click', function () {
                controls.lock();
            });

            controls.addEventListener('lock', function () {
                instructions.style.display = 'none';
                blocker.style.display = 'none';
                crosshair.style.display = 'block';
            });

            controls.addEventListener('unlock', function () {
                blocker.style.display = 'flex';
                instructions.style.display = '';
                crosshair.style.display = 'none';
            });
            
            scene.add(controls.getObject());
            
            // Event Listeners for movement
            const onKeyDown = function (event) {
                switch (event.code) {
                    case 'ArrowUp':
                    case 'KeyW': moveForward = true; break;
                    case 'ArrowLeft':
                    case 'KeyA': moveLeft = true; break;
                    case 'ArrowDown':
                    case 'KeyS': moveBackward = true; break;
                    case 'ArrowRight':
                    case 'KeyD': moveRight = true; break;
                    case 'Space': if (canJump === true) velocity.y += 25; canJump = false; break;
                }
            };

            const onKeyUp = function (event) {
                switch (event.code) {
                    case 'ArrowUp':
                    case 'KeyW': moveForward = false; break;
                    case 'ArrowLeft':
                    case 'KeyA': moveLeft = false; break;
                    case 'ArrowDown':
                    case 'KeyS': moveBackward = false; break;
                    case 'ArrowRight':
                    case 'KeyD': moveRight = false; break;
                }
            };

            document.addEventListener('keydown', onKeyDown);
            document.addEventListener('keyup', onKeyUp);

            // Raycaster for block interaction
            raycaster = new THREE.Raycaster(new THREE.Vector3(), new THREE.Vector3(0, -1, 0), 0, 10);

            // Ground
            const floorGeometry = new THREE.PlaneGeometry(200, 200, 100, 100);
            floorGeometry.rotateX(-Math.PI / 2);
            const floorMaterial = new THREE.MeshLambertMaterial({ color: 0x228B22 }); // Forest green
            const floor = new THREE.Mesh(floorGeometry, floorMaterial);
            scene.add(floor);

            // Initial Cubes
            const boxGeometry = new THREE.BoxGeometry(2, 2, 2);
            for (let i = 0; i < 150; i++) {
                const boxMaterial = new THREE.MeshLambertMaterial({ color: Math.random() * 0xffffff });
                const cube = new THREE.Mesh(boxGeometry, boxMaterial);
                cube.position.x = Math.floor(Math.random() * 20 - 10) * 2;
                cube.position.z = Math.floor(Math.random() * 20 - 10) * 2;
                cube.position.y = 1;
                cube.castShadow = true;
                scene.add(cube);
                objects.push(cube);
            }
            
            // Add/Remove block logic
            window.addEventListener('mousedown', (event) => {
                 if (!controls.isLocked) return;

                 // We use a different raycaster for picking, pointing from the camera
                 const pickRaycaster = new THREE.Raycaster();
                 pickRaycaster.setFromCamera({x: 0, y: 0}, camera);
                 const intersects = pickRaycaster.intersectObjects(objects);

                 if (intersects.length > 0) {
                     const intersected = intersects[0];
                     
                     if (event.button === 2) { // Right click to add
                         const newCubeMaterial = new THREE.MeshLambertMaterial({ color: 0xffa500 }); // Orange
                         const newCube = new THREE.Mesh(boxGeometry, newCubeMaterial);
                         
                         // Position the new cube on the face of the clicked cube
                         newCube.position.copy(intersected.object.position).add(intersected.face.normal);
                         scene.add(newCube);
                         objects.push(newCube);

                     } else if (event.button === 0) { // Left click to remove
                         if (intersected.object !== floor) {
                             scene.remove(intersected.object);
                             objects.splice(objects.indexOf(intersected.object), 1);
                         }
                     }
                 }
            });
            // Prevent context menu on right click
            document.addEventListener('contextmenu', event => event.preventDefault());

            renderer = new THREE.WebGLRenderer({ antialias: true });
            renderer.setPixelRatio(window.devicePixelRatio);
            renderer.setSize(window.innerWidth, window.innerHeight);
            renderer.shadowMap.enabled = true;
            document.body.appendChild(renderer.domElement);

            window.addEventListener('resize', onWindowResize);
        }

        function onWindowResize() {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        }

        function animate() {
            requestAnimationFrame(animate);

            const time = performance.now();

            if (controls.isLocked === true) {
                raycaster.ray.origin.copy(controls.getObject().position);
                raycaster.ray.origin.y -= 1; // Start raycast from player's feet

                const intersections = raycaster.intersectObjects(objects, false);
                const onObject = intersections.length > 0;
                const delta = (time - prevTime) / 1000;

                velocity.x -= velocity.x * 10.0 * delta;
                velocity.z -= velocity.z * 10.0 * delta;
                velocity.y -= 9.8 * 20.0 * delta; // gravity

                direction.z = Number(moveForward) - Number(moveBackward);
                direction.x = Number(moveRight) - Number(moveLeft);
                direction.normalize();

                if (moveForward || moveBackward) velocity.z -= direction.z * 200.0 * delta;
                if (moveLeft || moveRight) velocity.x -= direction.x * 200.0 * delta;

                if (onObject === true) {
                    velocity.y = Math.max(0, velocity.y);
                    canJump = true;
                }

                controls.moveRight(-velocity.x * delta);
                controls.moveForward(-velocity.z * delta);
                controls.getObject().position.y += (velocity.y * delta);

                if (controls.getObject().position.y < 2) {
                    velocity.y = 0;
                    controls.getObject().position.y = 2;
                    canJump = true;
                }
            }

            prevTime = time;
            renderer.render(scene, camera);
        }
    </script>
</body>
</html>
