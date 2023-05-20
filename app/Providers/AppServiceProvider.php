<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $currentUser = Auth::user();
        Paginator::useBootstrap();
        $services = Service::all();
        $userCount = User::count();
        $orderSuccessCount = Order::where('status', Order::ORDER_STATUS_PAID)->count();

        $monthCurrent = Carbon::now()->month;
        $totalMoney = Order::select('total')
            ->where('status', Order::ORDER_STATUS_PAID)
            ->whereMonth('created_at', $monthCurrent)
            ->sum('total');

        View::share('services', $services);
        View::share('user_count', $userCount);
        View::share('order_count', $orderSuccessCount);
        View::share('total_money', $totalMoney);
    }
}
