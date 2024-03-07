<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Request as UserRequest;
use App\Models\Service;
use App\Models\WorkImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $userNotes = UserRequest::where('phone_number', '123')->get();
        }

        $images = WorkImage::take(9)->get();

        return view('index', compact('services', 'categories', 'userNotes', 'images'));
    }
}
