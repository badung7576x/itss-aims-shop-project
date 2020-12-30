<?php

namespace App\Providers;

use App\Repositories\ActionHistory\ActionHistoryInterface;
use App\Repositories\ActionHistory\ActionHistoryRepository;
use App\Repositories\Cart\CartInterface;
use App\Repositories\Cart\CartRepository;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Category\CategoryRepository;
use App\Repositories\Product\AdminProductInterface;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\WebProductInterface;
use App\Repositories\Promotion\PromotionInterface;
use App\Repositories\Promotion\PromotionRepository;
use App\Repositories\Property\PropertyInterface;
use App\Repositories\Property\PropertyRepository;
use App\Repositories\PropertyType\PropertyTypeInterface;
use App\Repositories\PropertyType\PropertyTypeRepository;
use App\Repositories\ShipInfo\ShipInfoInterface;
use App\Repositories\ShipInfo\ShipInfoRepository;
use App\Repositories\Order\OrderInterface;
use App\Repositories\Order\OrderRepository;
use App\Repositories\User\UserInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\Warehouse\WarehouseInterface;
use App\Repositories\Warehouse\WarehouseRepository;
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
        $this->app->singleton(WebProductInterface::class, ProductRepository::class);
        $this->app->singleton(AdminProductInterface::class, ProductRepository::class);
        $this->app->singleton(PropertyTypeInterface::class, PropertyTypeRepository::class);
        $this->app->singleton(PropertyInterface::class, PropertyRepository::class);
        $this->app->singleton(WarehouseInterface::class, WarehouseRepository::class);
        $this->app->singleton(CategoryInterface::class, CategoryRepository::class);
        $this->app->singleton(CartInterface::class, CartRepository::class);
        $this->app->singleton(UserInterface::class, UserRepository::class);
        $this->app->singleton(PromotionInterface::class, PromotionRepository::class);
        $this->app->singleton(ShipInfoInterface::class, ShipInfoRepository::class);
        $this->app->singleton(OrderInterface::class, OrderRepository::class);
        $this->app->singleton(ActionHistoryInterface::class, ActionHistoryRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }
    }
}
