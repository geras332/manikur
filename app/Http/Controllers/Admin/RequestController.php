<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RequestController extends Controller
{
    public function index()
    {
        return view('admin.request.index');
    }

    public function delete(\App\Models\Request $request)
    {
        $request->delete();

        return redirect()->route('admin.request.index');
    }

    public function data()
    {
        $requests = \App\Models\Request::all();

        return DataTables::of($requests)
            ->editColumn('service.title', function ($request) {
                return $request->service->title;
            })
            ->editColumn('date', function ($request) {
                return date('Y-m-d', strtotime($request->created_at));
            })
            ->editColumn('created_at', function ($request) {
                return date('Y-m-d H:i:s', strtotime($request->created_at));
            })
            ->addColumn('actions', function ($request) {
                return '<form style="display:inline-block;" action="' . route('admin.request.delete', $request->id) . '" method="post">' . csrf_field() . method_field('DELETE') . '<input type="submit" class="btn btn-danger" value="Удалить"></form>';
            })->rawColumns(['actions'])->make(true);
    }
}
