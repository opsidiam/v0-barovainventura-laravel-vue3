<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Modules\License\Models\License;
use Modules\Notification\Models\Notification;
use Modules\Product\Models\Product;
use Modules\Stocktake\Models\Stocktake;
use Modules\User\Models\Discount;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['welcome', 'about', 'tutorial', 'gdpr', 'vop', 'support'], function ($view) {
            $view->with([
                'prices' => License::where('category', 3)->get(),
                'products' => Product::get()
            ]);
        });

        View::composer('*', function ($view) {
            if (Auth::check()) {
                $view->with($this->getAppData());
            }
        });

        $this->app['router']->pushMiddlewareToGroup('web', \App\Http\Middleware\CheckBarSelected::class);
    }

    protected function getAppData(): array
    {
        $userId = Auth::id();
        $barId = Session::get('bar');

        $data = [
            'open_stocktake_count' => 0,
            'discounts' => collect(),
            'discounts_active' => collect(),
            'discount' => 0,
            'discount_count' => 0,
            'notification_count' => 0,
            'notifications' => [],
            'unread_notification_ids' => [],
        ];

        // Load discounts data
        $this->loadDiscountData($userId, $data);

        // Load stocktake data if bar is selected
        if ($barId) {
            $data['open_stocktake_count'] = Stocktake::where([
                ['user_id', $userId],
                ['open', 1],
                ['bar_id', $barId]
            ])->count();
        }

        // Load notifications
        $this->loadNotificationData($userId, $barId, $data);

        return $data;
    }

    protected function loadDiscountData($userId, &$data)
    {
        $data['discounts'] = Discount::where('user_id', $userId)->get();
        $data['discounts_active'] = Discount::where('user_id', $userId)
            ->where('active', '>=', 1)
            ->get();
        $data['discount'] = $data['discounts_active']->sum('percent');
        $data['discount_count'] = Discount::where('user_id', $userId)
            ->where('active', '>=', 0)
            ->count();
    }

    protected function loadNotificationData($userId, $barId, &$data)
    {
        $query = Notification::forUserContext($userId, $barId)
            ->withReadStatus($userId)
            ->select(['id', 'type', 'scope', 'message', 'url', 'created_at', 'user_id', 'bar_id']);

        $data['notifications'] = $query->limit(5)->get();
        $data['notification_count'] = $query->unreadForUser($userId)->count();
        $data['unread_notification_ids'] = $data['notifications']->pluck('id')->toArray();
    }
}
