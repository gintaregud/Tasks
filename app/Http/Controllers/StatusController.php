<?php

namespace App\Http\Controllers;

use App\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function index()
    {
        return view('status.index', ['statuses' => Status::orderBy('name')->get()]);
    }
    public function create()
    {
        return view('status.create');
    }
    public function store(Request $request)
    {
        $status = new Status();
        // can be used for seeing the insides of the incoming request
        // var_dump($request->all()); die();
        $status->fill($request->all());
        $status->save();
        return redirect()->route('statuses.index');
    }
    public function edit(Status $status)
    {
        return view('status.edit', ['status' => $status]);
    }

    public function update(Request $request, Status $status)
    {
        $status->fill($request->all());
        $status->save();
        return redirect()->route('statuses.index');
    }

    public function destroy(Status $status)
    {
        $status->delete();
        return redirect()->route('statuses.index');
    }
}
