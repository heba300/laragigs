<?php

namespace App\Repositories\Listing\Elqouent;

use App\Http\Requests\listing\ListingRequest;
use App\Http\Requests\listing\UpdateListingRequest;
use App\Models\Listing;

use Illuminate\Support\Facades\Storage;
use App\Repositories\BaseElqouentRepository;
use App\Repositories\Listing\listingRepository;


class ElqouentListingRepository extends BaseElqouentRepository implements listingRepository
{


    public function createListing(ListingRequest $request)
    {
        $formFields = $request->except('_token');


        if ($this->requestFileExists('logo')) {
            $formFields['logo'] = $this->saveImage('logo', 'logos');
        }



        $formFields['user_id'] = auth()->id();
        return $this->create($formFields);
    }


    public function updateListing(UpdateListingRequest $request, Listing $listing)
    {

        $formFields = $request->except('_token', '_method');
        if ($request->hasFile('logo')) {
            $this->deleteImage($listing->logo);
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        return $this->update($listing, $formFields);
    }


    public function destroy(Listing $listing)
    {
        if ($listing->logo) {
            // Storage::disk('public')->delete($listing->logo);
            $this->deleteImage($listing->logo);
        }
        return $this->delete($listing);
    }
}
