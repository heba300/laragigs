<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\listing\ListingRequest;
use App\Http\Requests\listing\UpdateListingRequest;
use App\Repositories\Listing\listingRepository;

class ListingController extends Controller
{

    private $listingRepository;

    public function __construct(listingRepository $listingRepository)
    {
        $this->listingRepository = $listingRepository;
    }
    //show all listing
    public function index()
    {
        return view('listings.index', [
            'listings' => Listing::latest()->filter(
                request(['tag', 'search'])
            )->paginate(6)
        ]);
    }
    //show single listing
    public function show(Listing $listing)
    {

        return view('listings.show', [
            'listing' => $listing

        ]);
    }

    public function create()
    {
        return view('listings.create');
    }


    public function store(ListingRequest $request): RedirectResponse
    {

        $formFields = $this->listingRepository->create($request);
        return redirect('/')->with('message', 'Listing Created Successful');
    }

    public function edit(Listing $listing)
    {
        return view('listings.edit', ['listing' => $listing]);
    }

    public function update(UpdateListingRequest $request, Listing $listing): RedirectResponse
    {
        $formFields = $this->listingRepository->updateDate($request, $listing);
        return redirect('/')->with('message', 'Listing Update Successful');
    }

    public function destroy(Listing $listing)
    {
        // if ($listing->user_id != auth()->id()) {
        //     abort(403, 'unathorthez message');
        // }

        $this->listingRepository->delete($listing);
        return redirect('/')->with('message', 'Listing Delete Successful');
    }


    public function manage()
    {
        return view('listings.manage', ['listings' => auth()->user()->listings()->get()]);
    }
}
