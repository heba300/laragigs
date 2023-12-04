<?php

namespace App\Repositories\Listing;

use App\Http\Requests\listing\ListingRequest;
use App\Http\Requests\listing\UpdateListingRequest;
use App\Models\Listing;
use App\Repositories\BaseRepository;


interface listingRepository extends BaseRepository
{
    public function createListing(ListingRequest $request);

    public function updateListing(UpdateListingRequest $request, Listing $listing);

    public function destroy(Listing $listing);
}
