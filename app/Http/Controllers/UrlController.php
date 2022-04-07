<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UrlController extends Controller
{
    public function show(Request $request, string $code)
    {
        $url = DB::table('urls')->where('code', $code)->first();

        if ($url) {
            // ...

            return redirect()->away($url->url);
        } else {
            abort(404);
        }
    }

    public function store(Request $request, Url $url)
    {
        $validated = $request->validate([
            'long_url' => 'required|url',
        ]);

        $code = $url->short_url($validated['long_url']);

        return response()->json([
            'short_url' => url('/') . '/' . $code,
        ]);
    }
}
