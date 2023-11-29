<?php

namespace App\Repositories\Listing;

use App\Models\Listing;
use App\Repositories\BaseRepository;


interface listingRepository extends BaseRepository
{
   // public function saveImage($file, $path, $request);
    public function create($request);
    public function updateDate($request, $listing);
}
