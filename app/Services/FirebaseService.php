<?php

namespace App\Services;

use Kreait\Firebase\Factory;

class FirebaseService
{
    protected $database;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(storage_path('firebase_credentials.json'));
        $this->database = $factory->createDatabase();
    }

    public function getDatabase()
    {
        return $this->database;
    }
}
