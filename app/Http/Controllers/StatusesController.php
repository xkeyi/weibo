<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'content' => 'required|min:4|max:140',
        ]);

        \Auth::user()->statuses()->create([
            'content' => $request->content,
        ]);

        session()->flash('success', '发布成功！');

        return redirect()->back();
    }
}
