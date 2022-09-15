<?php

namespace App\Repositories;

class PictureRepository extends FirebaseRepository
{
    public function getReference()
    {
        return 'pictures';
    }

    public function getByAlbumId($albumId)
    {
        $pictures = $this->_reference
            ->orderByChild('album_id')
            ->equalTo($albumId)
            ->getSnapshot()
            ->getValue();

        $pictures = collect($pictures)->sortBy('order_number')->toArray();

        return $pictures;
    }

    public function updateOrderNumber($first, $last, $isMovedUp)
    {
        $pictures = $this->_reference
            ->orderByChild('order_number')
            ->startAt($first)
            ->endAt($last)
            ->getSnapshot()
            ->getValue();

        dd($pictures);

        $pictures = collect($items)->sortBy('order_number')->toArray();

        return $items;
    }
}
