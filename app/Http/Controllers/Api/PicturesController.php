<?php

namespace App\Http\Controllers\Api;

use App\Album;
use App\Http\Controllers\Controller;
use App\Http\Resources\Album as AlbumResource;
use App\Http\Resources\Picture as PictureResource;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PicturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
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
        $picture = new Picture;

        $picture->title = $request->title;
        $picture->img_link = $request->img_link;
        $picture->album_id = $request->album_id;

        $picture->save();

        return new PictureResource($picture);
    }

    public function createMany(Request $request)
    {
        $album = Album::find($request->album_id);

        foreach ($request->img_links as $img_link) {
            $picture = new Picture;

            $picture->title = $album->title;
            $picture->img_link = $img_link;
            $picture->album_id = $album->id;

            $picture->save();
        }

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
        $picture = Picture::find($id);

        $picture->title = $request->title;
        $picture->imgLink = $request->imgLink;

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
        $picture = Picture::find($id);

        $picture->delete();

        Picture::where([['album_id', $picture->album_id], ['order_number', '>', $picture->orderNumber]])->update(['orderNumber' => DB::raw('orderNumber - 1')]);

        return new PictureResource($picture);
    }
}
