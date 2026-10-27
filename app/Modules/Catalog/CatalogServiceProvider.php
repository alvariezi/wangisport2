<?php

use App\Modules\Catalog\Http\Controllers\TenantCourtController;
use App\Support\Routing\PortalRoutes;
use Illuminate\Support\Facades\Route;

PortalRoutes::tenant(function (): void {
    Route::get('/courts', [TenantCourtController::class, 'index'])->name('courts.index');
    Route::get('/courts/{court}', [TenantCourtController::class, 'show'])->name('courts.show');
    Route::patch('/courts/{court}', [TenantCourtController::class, 'update'])->name('courts.update');
});
