<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Query\Builder;
use App\Album;

class AlbumsController extends Controller {
    public function index() {
        // Get pictures
        $albums = Album::withCount('pictures')->paginate(10);

        return view('albums.index')->with('albums', $albums);
    }

    public function create() {
        return view('albums.create');
    }

    public function store(Request $request) {
        // validate
        $this->validate($request, [
            'title' => 'required',
            'cover-img-link' => 'required',
            'description' => 'required'
        ]);

        // create post
        $album = new Album;
        $album->title = $request->input('title');
        $album->coverImgLink = $request->input('cover-img-link');
        $album->description = $request->input('description');

        $album->save();

        return redirect('/albums/' . $album->id)->with('success', 'Album Created');
    }

    public function show($id) {
        // Get album
        $albums = Album::withCount('pictures')->get();
        $album = $albums->find($id);

        // $album = Album::withCount(['pictures' => function (Builder $query) {
        //     $query->where('id', '=', $id);
        // }])->get();

        if ($album === null) {
            return abort(404);
        }

        return view('albums.show')->with('album', $album);
    }

    public function update_data(Request $request) {
        if ($request->ajax()) {
            $album = Album::find($request->id);
            $field = $request->field;

            $album->$field = $request->content;

            $album->save();

            return response($album, 200)->header('Content-Type', 'text/plain');
        }
    }
}
