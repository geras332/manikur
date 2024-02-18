<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);

        Category::create($data);

        return redirect()->route('admin.category.index');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);

        $category->update($data);

        return redirect()->route('admin.category.index');
    }

    public function delete(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index');
    }

    public function data()
    {
        $categories = Category::all();
        return DataTables::of($categories)
            ->editColumn('created_at', function ($category) {
                return date('Y-m-d H:i:s', strtotime($category->created_at));
            })
            ->addColumn('actions', function ($category) {
                $edit = '<a href="' . route('admin.category.edit', $category->id) . '" class="btn btn-primary mr-2">Изменить</a>';
                $delete = '<form style="display:inline-block;" action="' . route('admin.category.delete', $category->id) . '" method="post">' . csrf_field() . method_field('DELETE') . '<input type="submit" class="btn btn-danger" value="Удалить"></form>';

                return $edit . $delete;
            })->rawColumns(['actions'])->make(true);
    }
}
