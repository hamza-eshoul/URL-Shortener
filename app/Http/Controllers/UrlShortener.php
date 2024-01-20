<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Urls;

class UrlShortener extends Controller
{

    // Show all urls

    public function index() {

        $urls_list = Urls::all();

        return $urls_list;
    }

    // Store New Url

    public function store(Request $request) {
        // generate short url

        $long_url = $request->getContent();

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
     
        return 'the url was succesfully added';
    }

    // Update url count visits

    public function update(Request $request, $id) {

        $url= Urls::find($id);

        $url->increment('visits_count', 1);

        return $url;
    }
}
