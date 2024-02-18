<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rest;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class RestController extends Controller
{
    public function index()
    {
        return view('admin.rest.index');
    }

    public function create()
    {
        return view('admin.rest.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'date' => 'required',
        ]);

        $data['date'] = strtotime($data['date']);

        Rest::create($data);

        return redirect()->route('admin.rest.index');
    }

    public function edit(Rest $rest)
    {
        return view('admin.rest.edit', compact('rest'));
    }

    public function update(Request $request, Rest $rest)
    {
        $data = $request->validate([
            'date' => 'required',
        ]);

        $data['date'] = strtotime($data['date']);

        $rest->update($data);

        return redirect()->route('admin.rest.index');
    }

    public function delete(Rest $rest)
    {
        $rest->delete();

        return redirect()->route('admin.rest.index');
    }

    public function data()
    {
        $rests = Rest::all();

        return DataTables::of($rests)
            ->editColumn('date', function ($rest) {
                return date('Y-m-d', $rest->date);
            })
            ->editColumn('created_at', function ($rest) {
                return date('Y-m-d H:i:s', strtotime($rest->created_at));
            })
            ->addColumn('actions', function ($rest) {
                $edit = '<a href="' . route('admin.rest.edit', $rest->id) . '" class="btn btn-primary mr-2">Изменить</a>';
                $delete = '<form style="display:inline-block;" action="' . route('admin.rest.delete', $rest->id) . '" method="post">' . csrf_field() . method_field('DELETE') . '<input type="submit" class="btn btn-danger" value="Удалить"></form>';

                return $edit . $delete;
            })->rawColumns(['actions'])->make(true);
    }
}
