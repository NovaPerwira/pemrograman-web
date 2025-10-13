<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Nexus</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts for a futuristic feel -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Custom styles for the futuristic theme */
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0a0a1a; /* Deep space blue */
            color: #e0e0ff;
            background-image:
                radial-gradient(circle at 10% 10%, #1a1a3a 1px, transparent 1px),
                radial-gradient(circle at 80% 90%, #1a1a3a 1px, transparent 1px);
            background-size: 50px 50px;
        }
        .font-orbitron {
            font-family: 'Orbitron', sans-serif;
        }
        .card-glow {
            border: 1px solid #2a2a5a;
            box-shadow: 0 0 15px rgba(76, 76, 255, 0.1);
            transition: all 0.3s ease-in-out;
        }
        .card-glow:hover {
            border-color: #4a4aff;
            box-shadow: 0 0 25px rgba(100, 100, 255, 0.4);
            transform: translateY(-5px);
        }
        .btn-primary {
            background: linear-gradient(90deg, #4f46e5, #c026d3);
            box-shadow: 0 0 15px rgba(139, 92, 246, 0.4);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            box-shadow: 0 0 25px rgba(139, 92, 246, 0.7);
            transform: scale(1.05);
        }
        .btn-secondary {
             background-color: rgba(42, 42, 90, 0.5);
             border: 1px solid #2a2a5a;
             transition: all 0.3s ease;
        }
        .btn-secondary:hover {
            background-color: rgba(74, 74, 255, 0.5);
            border-color: #4a4aff;
        }
        .btn-danger {
            background-color: rgba(220, 38, 38, 0.2);
            border: 1px solid #dc2626;
            transition: all 0.3s ease;
        }
        .btn-danger:hover {
            background-color: rgba(220, 38, 38, 0.5);
            border-color: #ef4444;
        }
        .glassmorphism {
            background: rgba(10, 10, 30, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }
        .pagination-link {
            background-color: rgba(42, 42, 90, 0.5);
            border: 1px solid #2a2a5a;
            transition: all 0.3s ease;
        }
        .pagination-link:hover, .pagination-link.active {
            background-color: #4a4aff;
            border-color: #8181ff;
            color: #fff;
        }
    </style>
</head>
<body class="min-h-screen p-4 sm:p-6 lg:p-8">

    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <header class="flex flex-col sm:flex-row justify-between items-center mb-8">
            <h1 class="font-orbitron text-4xl font-bold text-cyan-300 tracking-widest uppercase mb-4 sm:mb-0">
                Inventory Nexus
            </h1>
            <a href="{{route('products.create')}}" class="btn-primary text-white font-bold py-2 px-6 rounded-lg inline-flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                <span>New Asset</span>
            </a>
        </header>

        <!-- Success Message -->
        @if ($message = Session::get('success'))
            <div class="glassmorphism border border-green-500 text-green-300 px-4 py-3 rounded-lg relative mb-6 shadow-lg" role="alert">
                <strong class="font-bold">System Alert:</strong>
                <span class="block sm:inline">{{ $message }}</span>
            </div>
        @endif


        <!-- Product Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            {{-- @foreach ($products as $product) --}}
            @php
                // Dummy data for demonstration purposes. Remove this block in your Laravel project.
                $products = [
                    (object)['id' => 1, 'name' => 'Cybernetic Arm Model-7', 'price' => 12500.00],
                    (object)['id' => 2, 'name' => 'Anti-Grav Boots', 'price' => 7800.50],
                    (object)['id' => 3, 'name' => 'Holo-Projector v3', 'price' => 4200.00],
                    (object)['id' => 4, 'name' => 'Plasma Rifle X-21', 'price' => 21000.75],
                ];
            @endphp
            @foreach ($products as $product)
            <div class="card-glow glassmorphism rounded-xl overflow-hidden p-5 flex flex-col justify-between">
                <div>
                    <h2 class="text-xl font-bold text-cyan-300 truncate mb-2">{{ $product->name }}</h2>
                    <p class="text-2xl font-orbitron text-fuchsia-400 mb-4">
                        <span class="opacity-70">$</span>{{ number_format($product->price, 2) }}
                    </p>
                </div>
                <!-- Action Buttons -->
                <div class="mt-4">
                     <form action="{{-- route('products.destroy', $product->id) --}}" method="POST" class="flex items-center gap-2">
                        <a href="{{ route('products.edit', $product->id) }}" class="btn-secondary w-full text-center py-2 px-4 rounded-md text-sm font-semibold hover:text-white flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            <span>Modify</span>
                        </a>
                        {{-- @csrf --}}
                        {{-- @method('DELETE') --}}
                        <button type="submit" class="btn-danger w-full py-2 px-4 rounded-md text-sm font-semibold hover:text-white flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                            <span>Delete</span>
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12 flex justify-center">
             <nav class="flex items-center gap-2">
                {{-- Example of what Laravel's pagination might render.
                     This part should be replaced by: {{!! $products->links() !!}}
                     You may need to publish and customize Laravel's pagination views
                     to match this styling. --}}
                <a href="#" class="pagination-link rounded-md px-3 py-1">&laquo;</a>
                <a href="#" class="pagination-link rounded-md px-3 py-1">1</a>
                <a href="#" class="pagination-link active rounded-md px-3 py-1">2</a>
                <a href="#" class="pagination-link rounded-md px-3 py-1">3</a>
                <a href="#" class="pagination-link rounded-md px-3 py-1">&raquo;</a>
            </nav>
        </div>

    </div>

</body>
</html>
