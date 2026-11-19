<?php

namespace App\Providers;

use App\Models\Court;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        View::composer('layouts.tenant', function ($view) {
            $sidebarCourts = collect();

            if (Auth::check() && Auth::user()->role === 'tenant') {
                $tenantId = DB::table('user_tenant_roles')
                    ->where('user_id', Auth::id())
                    ->value('tenant_id');

                if ($tenantId) {
                    $sidebarCourts = Court::where('tenant_id', $tenantId)
                        ->orderBy('name')
                        ->get();
                }
            }

            $view->with('sidebarCourts', $sidebarCourts);
        });
    }
}