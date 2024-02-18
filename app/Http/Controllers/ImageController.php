<?php

namespace App\Http\Controllers;

use App\Models\WorkImage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function __invoke()
    {
        $images = WorkImage::all();

        return view('works', compact('images'));
    }
}
