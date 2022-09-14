<?php

namespace App\Repositories;

class PictureRepository extends FirebaseRepository
{
    public function getReference()
    {
        return 'pictures-test';
    }

    public function getByAlbumId($albumId)
    {
        $items = $this->_reference
            ->orderByChild('album_id')
            ->equalTo($albumId)
            ->getSnapshot()
            ->getValue();

        $items = collect($items)->sortBy('order_number')->toArray();

        return $items;
    }
}
