<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Picture;
use App\Http\Resources\Picture as PictureResource;
use Faker\Generator as Faker;

class PicturesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // Get pictures
        $pictures = Picture::all();

        return PictureResource::collection($pictures);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // Get picture
        $picture = Picture::findOrFail($id);

        // Return single picture as a resource
        return new PictureResource($picture);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function add_data(Request $request, Faker $faker) {
        if ($request->ajax()) {
            $picture = new Picture;

            $picture->title = $request->title;
            $picture->imgLink = $request->imgLink;
            $picture->description = $faker->text(200);
            $picture->album_id = $request->album_id;

            $picture->save();

            return response($picture, 200)->header('Content-Type', 'text/plain');
        }
    }

    public function update_data(Request $request) {
        if ($request->ajax()) {
            $picture = Picture::find($request->id);
            $field = $request->field;

            $picture->$field = $request->content;

            $picture->save();

            return response($picture, 200)->header('Content-Type', 'text/plain');
        }
    }

    public function delete_data(Request $request) {
        if ($request->ajax()) {
            $picture = Picture::find($request->id);

            $picture->delete();

            return response($picture, 200)->header('Content-Type', 'text/plain');
        }
    }
}
