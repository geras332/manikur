<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ServiceController extends Controller
{
    public function index()
    {
        return view('admin.service.index');
    }

    public function create()
    {
        $categories = Category::all();

        return view('admin.service.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'price' => 'numeric',
            'category_id' => 'required|numeric',
        ]);

        Service::create($data);

        return redirect()->route('admin.service.index');
    }

    public function edit(Service $service)
    {
        $categories = Category::all();

        return view('admin.service.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'title' => 'required',
            'price' => 'numeric',
            'category_id' => 'required|numeric',
        ]);

        $service->update($data);

        return redirect()->route('admin.service.index');
    }

    public function delete(Service $service)
    {
        $service->delete();

        return redirect()->route('admin.service.index');
    }

    public function data()
    {
        $services = Service::all();
        return DataTables::of($services)
            ->editColumn('category.title', function ($service) {
                return $service->category->title;
            })
            ->editColumn('created_at', function ($service) {
                return date('Y-m-d H:i:s', strtotime($service->created_at));
            })
            ->addColumn('actions', function ($service) {
                $edit = '<a href="' . route('admin.service.edit', $service->id) . '" class="btn btn-primary mr-2">Изменить</a>';
                $delete = '<form style="display:inline-block;" action="' . route('admin.service.delete', $service->id) . '" method="post">' . csrf_field() . method_field('DELETE') . '<input type="submit" class="btn btn-danger" value="Удалить"></form>';

                return $edit . $delete;
            })->rawColumns(['actions'])->make(true);
    }
}
