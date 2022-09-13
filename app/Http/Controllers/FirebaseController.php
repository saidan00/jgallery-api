<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Database;

class FirebaseController extends Controller
{
    protected $userRepository;
    /**
     * @var Database
     */
    protected $database;
    protected $firebase;

    public function __construct()
    {
        $this->database = app('firebase.database');;
    }
}
