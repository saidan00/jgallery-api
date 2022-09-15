<?php

namespace App\Http\Controllers;

use App\Repositories\AlbumRepository;
use App\Repositories\PictureRepository;
use Illuminate\Http\Request;

class AlbumsController extends Controller
{
    protected $albumRepo;
    protected $pictureRepo;

    public function __construct(AlbumRepository $albumRepository, PictureRepository $pictureRepository)
    {
        $this->albumRepo = $albumRepository;
        $this->pictureRepo = $pictureRepository;
    }

    public function index()
    {
        // Get albums
        $albums = $this->albumRepo->getAll();

        return view('albums.index')->with(['albums' => $albums]);
    }

    public function show($id)
    {
        $album = $this->albumRepo->find($id);
        $album['pictures'] = $this->pictureRepo->getByAlbumId($id);

        return view('albums.show')->with(['album' => $album]);
    }

    public function create()
    {
        return view('albums.create');
    }

    public function store(Request $request)
    {
        $album = [
            'title' => $request->title,
            'cover_img_link' => $request->cover_img_link,
            'pictures_count' => 0
        ];
        $album = $this->albumRepo->create($album);

        return redirect()->route('albums-edit', $album['id']);
    }

    public function edit($id)
    {
        $album = $this->albumRepo->find($id);

        return view('albums.edit')->with(['album' => $album]);
    }

    public function update(Request $request, $id)
    {
        $album = [
            'title' => $request->title,
            'cover_img_link' => $request->cover_img_link
        ];

        $this->albumRepo->update($id, $album);

        return redirect()->route('albums-edit', $id);
    }

    public function destroy($id)
    {
        $pictures = $this->pictureRepo->getByAlbumId($id);
        foreach ($pictures as $key => $pic) {
            $this->pictureRepo->delete($key);
        }

        $this->albumRepo->delete($id);

        return redirect()->route('albums');
    }
}
