<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    public function index()
    {
        // Get albums
        $albums = Album::withCount('pictures')->get();

        return view('albums.index')->with(['albums' => $albums]);
    }


    public function show($id)
    {
        $album = Album::withCount('pictures')->find($id);

        return view('albums.show')->with(['album' => $album]);
    }

    public function edit($id)
    {
        $album = Album::find($id);

        return view('albums.edit')->with(['album' => $album]);
    }

    public function update(Request $request, $id)
    {
        $album = Album::find($id);

        $album->title = $request->title;
        $album->cover_img_link = $request->cover_img_link;

        $album->save();

        return redirect()->route('albums-edit', $album->id);
    }
}
