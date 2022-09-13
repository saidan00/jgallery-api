<?php

namespace App\Http\Controllers;

use App\Album;
use App\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PicturesController extends Controller
{
    public function createMany(Request $request)
    {
        $album = Album::withCount('pictures')->find($request->album_id);

        $img_links = preg_split("/\r\n|\n|\r/", $request->img_links);

        foreach ($img_links as $img_link) {
            $exists = Picture::where('img_link', $img_link)->where('album_id', $album->id)->exists();

            if (!$exists) {
                $picture = new Picture;

                $picture->title = $album->title;
                $picture->img_link = $img_link;
                $picture->album_id = $album->id;

                $picture->order_number = Picture::where('album_id', $album->id)->max('order_number') + 1;

                $picture->save();
            }
        }

        return redirect()->route('albums-show', $album->id);
    }

    public function edit($id)
    {
        $picture = Picture::find($id);

        return view('pictures.edit')->with(['picture' => $picture]);
    }

    public function update(Request $request, $id)
    {
        $picture = Picture::find($id);

        $picture->img_link = $request->img_link;

        $picture->save();

        return redirect()->route('pictures-edit', $picture->id);
    }

    public function updatePictureOrderNumber(Request $request, $id)
    {
        // get picture
        $picture = Picture::find($id);
        $maxOrderNumber = Picture::where('album_id', $picture->album_id)->max('order_number');

        $oldIndex = $picture->order_number;
        $newIndex = $request->new_index;

        if ($newIndex > 0 && $newIndex < $maxOrderNumber + 1) {
            // update new order number for the rest
            if ($newIndex > $oldIndex) {
                Picture::where('album_id', $picture->album_id)->whereBetween('order_number', [$oldIndex + 1, $newIndex])->update(['order_number' => DB::raw('order_number - 1')]);
            } elseif ($newIndex < $oldIndex) {
                Picture::where('album_id', $picture->album_id)->whereBetween('order_number', [$newIndex, $oldIndex - 1])->update(['order_number' => DB::raw('order_number + 1')]);
            }
        }

        // update order number
        $picture->order_number = $newIndex;
        $picture->save();

        return redirect()->route('albums-show', [$picture->album_id, '#' . $picture->order_number]);
    }

    public function destroy($id)
    {
        $picture = Picture::find($id);

        $picture->delete();

        Picture::where([['album_id', $picture->album_id], ['order_number', '>', $picture->order_number]])->update(['orderNumber' => DB::raw('orderNumber - 1')]);

        $album = Album::withCount('pictures')->find($picture->album_id);

        return view('albums.show')->with(['album' => $album]);
    }
}
