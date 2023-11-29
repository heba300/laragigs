<?php

namespace App\Repositories\Listing\Elqouent;

use App\Models\Listing;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use App\Repositories\BaseElqouentRepository;
use App\Repositories\Listing\listingRepository;


class ElqouentListingRepository extends BaseElqouentRepository implements listingRepository
{


    public function create($request)
    {
        $formFields = $request->validated();


        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);
    }


    public function updateDate($request, $listing)
    {

        $formFields = $request->validated();
        if ($request->hasFile('logo')) {
            Storage::disk('public')->delete($listing->logo);
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }
        $listing->update($formFields);
    }
}
