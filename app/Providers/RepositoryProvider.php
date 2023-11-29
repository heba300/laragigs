<?php

namespace App\Providers;

use App\Models\Listing;
use App\Repositories\BaseElqouentRepository;
use App\Repositories\BaseRepository;
use App\Repositories\Listing\Elqouent\ElqouentListingRepository;
use App\Repositories\Listing\listingRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
  /**
   * Register services.
   */
  public function register(): void
  {
    // $this->app->bind(listingRepository::class,ElqouentListingRepository::class);
    $this->app->bind(listingRepository::class, function () {
      return new ElqouentListingRepository(new Listing());
    });
  }

  /**
   * Bootstrap services.
   */
  public function boot(): void
  {
    //
  }
}
