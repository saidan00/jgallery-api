<?php

namespace App\Http\Controllers;

use App\Album;
use App\Http\Traits\ArrayToObject;
use Illuminate\Http\Request;

class AlbumsController extends FirebaseController
{
    use ArrayToObject;

    public function index()
    {
        // Get albums
        $albums = $this->database->getReference('/albums')
            ->getSnapshot()
            ->getValue();

        return view('albums.index')->with(['albums' => $albums]);
    }


    public function show(int $id)
    {
        $albums = $this->database->getReference('/albums')
            ->orderByChild("id")
            ->equalTo($id)
            ->getSnapshot()
            ->getValue();
        $album = array_pop($albums);
        // dd($album);

        return view('albums.show')->with(['album' => $album]);
    }

    public function edit($id)
    {
        $album = $this->database->getReference($id)->getSnapshot()->getValue();
        $album = $this->array_to_object($album);

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
