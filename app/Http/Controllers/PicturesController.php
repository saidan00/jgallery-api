<?php

namespace App\Http\Controllers;

use App\Repositories\AlbumRepository;
use App\Repositories\PictureRepository;
use Illuminate\Http\Request;

class PicturesController extends Controller
{
    protected $albumRepo;
    protected $pictureRepo;

    public function __construct(AlbumRepository $albumRepository, PictureRepository $pictureRepository)
    {
        $this->albumRepo = $albumRepository;
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

        // update album pictures_count
        $this->albumRepo->update($albumId, ['pictures_count' => $picturesCount]);

        return redirect()->route('albums-show', $albumId);
    }

    public function edit($pictureId)
    {
        $picture = $this->pictureRepo->find($pictureId);
        $album = $this->albumRepo->find($picture['album_id']);
        return view('pictures.edit')->with(['picture' => $picture, 'album' => $album]);
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
        $picture = $this->pictureRepo->find($id);
        $pictures = $this->pictureRepo->getByAlbumId($picture['album_id']);
        $album = $this->albumRepo->find($picture['album_id']);

        $oldIndex = $picture['order_number'];
        $newIndex = $request->new_index;

        if ($newIndex > 0 && $newIndex < $album['pictures_count'] + 1) {
            // update new order number for the rest
            if ($newIndex > $oldIndex) {
                $pictures = collect($pictures)->filter(function ($value, $key) use ($newIndex, $oldIndex) {
                    return ($oldIndex + 1 <= $value["order_number"] && $value["order_number"] <= $newIndex);
                });

                foreach ($pictures as $key => $pic) {
                    $this->pictureRepo->update($key, ['order_number' => $pic['order_number'] - 1]);
                }
            } elseif ($newIndex < $oldIndex) {
                $pictures = collect($pictures)->filter(function ($value, $key) use ($newIndex, $oldIndex) {
                    return ($newIndex <= $value["order_number"] && $value["order_number"] <= $oldIndex - 1);
                });

                foreach ($pictures as $key => $pic) {
                    $this->pictureRepo->update($key, ['order_number' => $pic['order_number'] + 1]);
                }
            }
        }

        // update order number
        $this->pictureRepo->update($id, ['order_number' => $newIndex]);

        return redirect()->route('albums-show', [$picture['album_id'], '#' . $newIndex]);
    }

    public function destroy($id)
    {
        // update album pictures_count
        $picture = $this->pictureRepo->find($id);
        $album = $this->albumRepo->find($picture['album_id']);
        $this->albumRepo->update($album['id'], ['pictures_count' => $album['pictures_count'] - 1]);

        $this->pictureRepo->delete($id);

        return redirect()->back();
    }
}
