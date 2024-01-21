<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Urls;

class UrlShortener extends Controller
{
    // Show all urls

    public function index() {

        $urls_list = Urls::orderBy("created_at", "DESC")->get();

        return $urls_list;
    }

    // Store New Url

    public function store(Request $request) {

        $long_url = $request->getContent();

        // check if url already exists in database

        $db_url = Urls::where('longUrl', $long_url)->first();

        if ($db_url) {
            return response()->json([
                'error' => 'The url already exists, try a different url'
            ]);
        }
        
        else {
            // generate short url

            $baseUrl = "squaHR";

            $unique_id = Str::uuid();

            $short_unique_id = substr($unique_id, 0, 5);

            $generated_short_url = $baseUrl . "/" . $short_unique_id;

            // save url to the database

            $url = new Urls; 

            $url->urlCode = $short_unique_id;

            $url->longUrl = $long_url;

            $url->shortUrl = $generated_short_url;

            $url->save();
        
            return $url;
        }
    }

    // Update url count visits

    public function update(Request $request, $id) {

        $url= Urls::find($id);

        $url->increment('visits_count', 1);

        return $url;
    }
}
