<?php

namespace App\Providers;

use App\Repositories\ContactRepository;
use App\Repositories\ContactRepositoryInterface;
use App\Services\Contact\SearchContactByNameStrategy;
use App\Services\Contact\SearchContactByPhoneStrategy;
use App\Services\Contact\SearchContactFactory;
use App\Services\ContactService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();
        $this->registerServices();
    }

    /**
     * Register all of our repositories
     *
     * @return void
     */
    private function registerRepositories(): void {
        $this->app->singleton(ContactRepositoryInterface::class, function () {
            return new ContactRepository();
        });
    }

    /**
     * Register all of our services
     *
     * @return void
     */
    private function registerServices(): void {
        $this->app->singleton(SearchContactByPhoneStrategy::class, function () {
            return new SearchContactByPhoneStrategy($this->app->get(ContactRepositoryInterface::class));
        });
        $this->app->singleton(SearchContactByNameStrategy::class, function () {
            return new SearchContactByNameStrategy($this->app->get(ContactRepositoryInterface::class));
        });

        $this->app->singleton(SearchContactFactory::class, function () {
            return new SearchContactFactory(
                $this->app->get(SearchContactByPhoneStrategy::class),
                $this->app->get(SearchContactByNameStrategy::class)
            );
        });

        $this->app->singleton(ContactService::class, function () {
            /** @var SearchContactFactory $searchContactFactory */
            $searchContactFactory = $this->app->get(SearchContactFactory::class);

            return new ContactService($searchContactFactory);
        });
    }
}
