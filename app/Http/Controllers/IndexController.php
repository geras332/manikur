<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Request as UserRequest;
use App\Models\Service;
use App\Models\WorkImage;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    // Возвращаем главную страницу
    public function __invoke(Request $request)
    {
        $categories = Category::all();
        $category_id = $request->get('id', $categories->first()->id) ?? $categories->first()->id;

        $services = Service::where('category_id', $category_id)->get();

        $userNotes = [];
        if (auth()->check()) {
            $userNotes = UserRequest::where('phone_number', auth()->user()->phone_number)->where('name', auth()->user()->name)->get();
        }

        $images = WorkImage::take(6)->get();

        return view('index', compact('services', 'categories', 'userNotes', 'images'));
    }
}
