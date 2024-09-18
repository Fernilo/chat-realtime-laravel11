<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\View\View;

class ServiceController extends Controller
{
    /**
     * Show the service for a given slug.
     * 
     * @param string $slug
     * @return View
     */
    public function show(string $slug): View
    {
        // TODO: manejar la excepcion
        return view('services.show', [
            'service' => Service::where('slug', $slug)->firstOrFail()
        ]);
    }
}
