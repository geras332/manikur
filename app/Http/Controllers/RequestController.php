<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function add(Request $request)
    {
        $data = $request->validate([
            'date' => 'required',
            'service_id' => 'required',
            'time' => 'required',
            'name' => 'nullable',
            'phone_number' => 'nullable',
        ]);

        $data['date'] = strtotime($data['date']);

        \App\Models\Request::create($data);
    }
}
