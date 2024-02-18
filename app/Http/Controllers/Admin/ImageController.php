<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\WorkImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;

class ImageController extends Controller
{
    public function index()
    {
        return view('admin.image.index');
    }

    public function create()
    {
        return view('admin.image.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = Storage::disk('public')->put('images', $data['image']);

        WorkImage::create([
            'path' => $path,
        ]);

        return redirect()->route('admin.image.index');
    }

    public function edit(Category $image)
    {
        return view('admin.image.edit', compact('image'));
    }

    public function update(Request $request, WorkImage $image)
    {
        $data = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        Storage::delete($image->path);
        $path = Storage::disk('public')->put('images', $data['image']);

        $image->update([
            'path' => $path,
        ]);

        return redirect()->route('admin.image.index');
    }

    public function delete(WorkImage $image)
    {
        $image->delete();

        return redirect()->route('admin.image.index');
    }

    public function data()
    {
        $images = WorkImage::all();

        return DataTables::of($images)
            ->editColumn('image', function ($image) {
                return '<img width="100" height="100" src="'. Storage::url($image->path) .'">';
            })
            ->editColumn('created_at', function ($image) {
                return date('Y-m-d H:i:s', strtotime($image->created_at));
            })
            ->addColumn('actions', function ($image) {
                $edit = '<a href="' . route('admin.image.edit', $image->id) . '" class="btn btn-primary mr-2">Изменить</a>';
                $delete = '<form style="display:inline-block;" action="' . route('admin.image.delete', $image->id) . '" method="post">' . csrf_field() . method_field('DELETE') . '<input type="submit" class="btn btn-danger" value="Удалить"></form>';

                return $edit . $delete;
            })->rawColumns(['actions', 'image'])->make(true);
    }
}
