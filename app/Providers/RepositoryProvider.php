<?php

namespace App\Providers;

use App\Models\Listing;
use App\Models\User;
use App\Repositories\Auth\ForgetPasswordInterface;
use App\Repositories\Auth\GoogleRepositoryInterface;
use App\Repositories\Auth\UserRepository\ElqouentForgetRepository;
use App\Repositories\Auth\UserRepository\ElqouentGoogleRepository;
use App\Repositories\Auth\UserRepository\ElqouentUserRepository;
use App\Repositories\Auth\UserRepositoryInterface;
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

    $this->app->bind(UserRepositoryInterface::class, function () {
      return new ElqouentUserRepository(new User());
    });

    $this->app->bind(GoogleRepositoryInterface::class, function () {
      return new ElqouentGoogleRepository(new User());
    });

    $this->app->bind(ForgetPasswordInterface::class, function () {
      return new ElqouentForgetRepository(new User());
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
