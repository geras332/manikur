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
        $data['date'] = strtotime('+1 day', $data['date']);
        if (\App\Models\Request::where('date', $data['date'])->where('time', $data['time'])->exists()) {
            return response('error', 422);
        }


        \App\Models\Request::create($data);

        return response('ok');
    }
}
