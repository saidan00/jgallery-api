<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Picture;

class PicturesController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $picture = new Picture;

    $picture->title = $request->title;
    $picture->imgLink = $request->imgLink;
    $picture->description = $request->title;
    $picture->album_id = $request->album_id;

    $picture->save();

    return response($picture, 200)->header('Content-Type', 'text/plain');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
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
    $picture = Picture::find($id);

    $picture->title = $request->title;
    $picture->imgLink = $request->imgLink;

    $picture->save();
    return response($picture, 200)->header('Content-Type', 'text/plain');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $picture = Picture::find($id);

    $picture->delete();

    return response($picture, 200)->header('Content-Type', 'text/plain');
  }
}
