<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Newsletter;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{

    public function newsletterArchive(){
    $newsletters = Newsletter::latest()->get(); // get all newsletters
    return view('newsroom.news', compact('newsletters'));
    }
}
