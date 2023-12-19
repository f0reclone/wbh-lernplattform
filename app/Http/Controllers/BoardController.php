<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Inertia\Inertia;

class BoardController extends Controller
{
    public function index() {
        return Inertia::render('Board');
    }


}
