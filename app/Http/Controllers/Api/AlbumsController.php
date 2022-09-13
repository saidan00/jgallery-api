<?php

namespace App\Http\Controllers\Api;

use App\Album;
use App\Http\Controllers\FirebaseController;
use App\Http\Resources\Album as AlbumResource;
use App\Http\Resources\Picture as PictureResource;
use App\Picture;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AlbumsController extends FirebaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get pictures
        $albums = $this->database->getReference()->getSnapshot()->getValue();

        return json_encode($albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $album = new Album;

        $album->title = $request->title;
        $album->cover_img_link = $request->cover_img_link;

        $album->save();

        return new AlbumResource($album);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Get picture
        $album = Album::withCount('pictures')->find($id);
        $album->pictures = $album->pictures->sortBy('order_number');

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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $album = Album::find($id);

        $album->title = $request->title;
        $album->coverImgLink = $request->coverImgLink;

        $album->save();
        return new AlbumResource($album);
    }

    public function updatePicturesOrderNumber(Request $request, $id)
    {
        // get picture
        $picture = Picture::where([['album_id', $id], ['order_number', $request->oldIndex]])->first();

        // update new order number for the rest
        if ($request->newIndex > $request->oldIndex) {
            Picture::where('album_id', $id)->whereBetween('order_number', [$request->oldIndex + 1, $request->newIndex])->update(['order_number' => DB::raw('order_number - 1')]);
        } else {
            Picture::where('album_id', $id)->whereBetween('order_number', [$request->newIndex, $request->oldIndex - 1])->update(['order_number' => DB::raw('order_number + 1')]);
        }

        // update order number
        $picture->orderNumber = $request->newIndex;
        $picture->save();

        return new PictureResource($picture);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);

        $album->delete();

        // delete all pictures in this album
        Picture::where('album_id', $id)->delete();

        return new AlbumResource($album);
    }
}
