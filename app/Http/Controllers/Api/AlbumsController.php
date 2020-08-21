<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Album;
use App\Http\Resources\Album as AlbumResource;
use App\Picture;

class AlbumsController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Get pictures
        $albums = Album::withCount('pictures')->get();

        return AlbumResource::collection($albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $album = new Album;

        $album->title = $request->title;
        $album->coverImgLink = $request->coverImgLink;
        $album->description = $request->title;

        $album->save();

        return response($album, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // Get picture
        // $album = Album::find($id);
        $album = Album::withCount('pictures')->get();
        $album = $album->find($id);

        if ($album === null) {
            return response()->json(['message' => 'Not Found!'], 404);
        }

        // Return single picture as a resource
        return new AlbumResource($album);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $album = Album::find($id);

        $album->title = $request->title;
        $album->coverImgLink = $request->coverImgLink;

        $album->save();
        return response($album, 200)->header('Content-Type', 'text/plain');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $album = Album::find($id);

        $album->delete();

        // delete all pictures in this album
        Picture::where('album_id', $id)->delete();

        return response($album, 200)->header('Content-Type', 'text/plain');
    }
}
