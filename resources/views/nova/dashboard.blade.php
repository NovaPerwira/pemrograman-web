<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data['app_name'] }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style> body { font-family: 'Outfit', sans-serif; } </style>
</head>
<body class="bg-[#0f172a] text-slate-200 min-h-screen">

    <div class="fixed top-0 left-0 w-[500px] h-[500px] bg-cyan-500/20 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2 pointer-events-none"></div>
    <div class="fixed bottom-0 right-0 w-[500px] h-[500px] bg-blue-600/20 rounded-full blur-[100px] translate-x-1/2 translate-y-1/2 pointer-events-none"></div>

    @include('nova.partials.sidebar')

    <main class="md:ml-64 p-8 relative z-10">
        
        <header class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 gap-4">
            <div>
                <h2 class="text-3xl font-bold text-white">
                    Hello, <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-400 to-blue-500">{{ $data['user_name'] }}</span> 👋
                </h2>
                <p class="text-slate-400 mt-1">Welcome back to your workspace.</p>
            </div>
            <div class="bg-slate-800/50 backdrop-blur border border-white/10 px-4 py-2 rounded-full text-sm text-cyan-400">
                {{ $data['date'] }}
            </div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-slate-800/40 backdrop-blur border border-white/5 p-6 rounded-2xl hover:border-cyan-500/30 transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-cyan-500/10 rounded-lg text-cyan-400 group-hover:bg-cyan-500 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                    </div>
                    <span class="bg-green-500/20 text-green-400 text-xs px-2 py-1 rounded-full">{{ $data['status'] }}</span>
                </div>
                <h3 class="text-slate-400 text-sm">Current Project</h3>
                <p class="text-xl font-semibold text-white mt-1">{{ $data['project'] }}</p>
            </div>

            <div class="bg-slate-800/40 backdrop-blur border border-white/5 p-6 rounded-2xl hover:border-blue-500/30 transition-all group">
                <div class="flex justify-between items-start mb-4">
                    <div class="p-3 bg-blue-500/10 rounded-lg text-blue-400 group-hover:bg-blue-500 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                </div>
                <h3 class="text-slate-400 text-sm">Completion Rate</h3>
                <div class="flex items-baseline gap-2 mt-1">
                    <p class="text-3xl font-bold text-white">{{ $data['stats']['completed'] }}%</p>
                    <span class="text-xs text-green-400">↑ 12% vs last week</span>
                </div>
            </div>

            <div class="bg-gradient-to-br from-cyan-600 to-blue-700 p-6 rounded-2xl text-white shadow-lg shadow-cyan-900/20 relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-cyan-100 text-sm mb-1">User Role</h3>
                    <p class="text-2xl font-bold">{{ $data['role'] }}</p>
                    <p class="mt-4 text-xs bg-white/20 inline-block px-2 py-1 rounded">M - TI Class</p>
                </div>
                <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-white/10 rounded-full blur-xl"></div>
            </div>
        </div>

        <div class="bg-slate-800/30 border border-white/5 rounded-2xl p-8 min-h-[300px] flex items-center justify-center text-slate-500 dashed-border">
            <p>Select a module from the sidebar to view details.</p>
        </div>

    </main>

</body>
</html>