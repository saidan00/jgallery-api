<?php

namespace App\Http\Controllers;

use App\Album;
use App\Picture;
use App\Repositories\PictureRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PicturesController extends Controller
{
    protected $pictureRepo;

    public function __construct(PictureRepository $pictureRepository)
    {
        $this->pictureRepo = $pictureRepository;
    }

    public function createMany(Request $request)
    {
        $albumId = $request->album_id;
        $img_links = preg_split("/\r\n|\n|\r/", $request->img_links);

        $pictures = $this->pictureRepo->getByAlbumId($albumId);
        $picturesCount = count($pictures);

        foreach ($img_links as $img_link) {
            $exists = false;

            foreach ($pictures as $pic) {
                if ($pic['img_link'] == $img_link) {
                    $exists = true;
                }
            }

            if (!$exists) {
                $picturesCount++;
                $newPic = [
                    'img_link' => $img_link,
                    'album_id' => $albumId,
                    'order_number' => $picturesCount
                ];

                $this->pictureRepo->create($newPic);
            }
        }

        return redirect()->route('albums-show', $albumId);
    }

    public function edit($pictureId)
    {
        $picture = $this->pictureRepo->find($pictureId);
        return view('pictures.edit')->with(['picture' => $picture]);
    }

    public function update(Request $request, $albumId, $pictureId)
    {
        $picture = [
            'img_link' => $request->img_link
        ];

        $this->pictureRepo->update($pictureId, $picture);

        return redirect()->route('pictures-edit', $pictureId);
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

    public function destroy(int $albumId, int $pictureId)
    {
        $albums = $this->database->getReference($this->firebaseReference)
            ->orderByChild('id')
            ->equalTo($albumId)
            ->getSnapshot()
            ->getValue();
        $albumKey = key($albums);
        $album = array_pop($albums);

        $picture = null;
        foreach ($album['pictures'] as $key => $p) {
            if ($p != null) {
                if ($p['id'] == $pictureId) {
                    $picture = $p;
                    $pictureKey = $key;
                    $picture['album_id'] = $albumId;
                }
            }
        }

        try {
            $this->database->getReference("{$this->firebaseReference}/{$albumKey}/pictures/{$pictureKey}")->remove();
        } catch (Exception $exception) {
            dd($exception);
        }

        return redirect()->route('pictures-edit', [$albumId, $pictureId]);
    }
}
