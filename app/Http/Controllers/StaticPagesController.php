<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home(Request $request)
    {
        $feed_items = [];

        if (\Auth::check()) {
            $feed_items = \Auth::user()->feed()->paginate(30);
        }

        // $feed_items = Status::with('user')->orderBy('created_at', 'desc')->paginate(30);

        return view('static_pages.home', compact('feed_items'));
    }

    public function help(Request $request)
    {
        return view('static_pages.help');
    }

    public function about(Request $request)
    {
        return view('static_pages.about');
    }
}
