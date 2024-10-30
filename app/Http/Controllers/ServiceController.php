<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Chat;
use Illuminate\Support\Facades\Auth;
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
        $service = Service::where('slug', $slug)->firstOrFail();
        $chat = Chat::where('created_by_id', Auth::id())->where('service_id', $service->id)->first();

        return view('services.show', [
            'service' => $service,
            'chat' => $chat
        ]);
    }
}
