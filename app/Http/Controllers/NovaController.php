<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class NovaController extends Controller
{
    public function index(string $name): View
    {
        // Formatting nama huruf awal kapital
        $formattedName = ucwords(str_replace('-', ' ', $name));

        $data = [
            'app_name'  => 'Nova Space',
            'user_name' => $formattedName,
            'role'      => 'Fullstack Developer',
            'project'   => 'Web Framework Assignment',
            'date'      => Carbon::now()->isoFormat('dddd, D MMMM Y'),
            'status'    => 'Online',
            'stats'     => [
                'tasks' => 12,
                'completed' => 95, // persen
                'hours' => 120
            ]
        ];

        // Mengirim data ke view 
        return view('nova.dashboard', compact('data'));
    }
}