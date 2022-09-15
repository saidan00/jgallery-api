<?php

namespace App\Repositories;

class AlbumRepository extends FirebaseRepository
{
    public function getReference() {
        return 'albums';
    }
}
