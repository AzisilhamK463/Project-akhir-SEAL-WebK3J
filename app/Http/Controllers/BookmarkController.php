<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class BookmarkController extends Controller
{
    public function showByUser($id)
    {
        $bookmarks = User::find($id)->bookmarks()->with('modul')->get();
        return view('bookmark.index', compact('bookmarks'));
    }

    public function store(Request $request)
    {
        $request->user()->bookmarks()->create(['modul_id' => $request->modul_id]);
        return back();
    }

    public function destroy(Request $request)
    {
        $request->user()->bookmarks()->where('modul_id', $request->modul_id)->delete();
        return back();
    }
}
