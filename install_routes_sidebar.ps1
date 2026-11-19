# Jalankan dari root proyek Laravel setelah menyalin file-file patch.
$ErrorActionPreference = 'Stop'
$web = Join-Path (Get-Location) 'routes\web.php'
$layout = Join-Path (Get-Location) 'resources\views\layouts\tenant.blade.php'
if (-not (Test-Path $web)) { throw 'Jalankan script dari root Laravel (routes/web.php tidak ditemukan)' }
if (-not (Test-Path $layout)) { throw 'Layout tenant tidak ditemukan' }
Copy-Item $web "$web.bak" -Force
Copy-Item $layout "$layout.bak" -Force
$src = Get-Content $web -Raw
$import = 'use App\Http\Controllers\Tenant\TenantCourtScheduleController;'
if (-not $src.Contains($import)) {
    $needle = 'use App\Http\Controllers\Tenant\TenantCourtController;'
    if (-not $src.Contains($needle)) { throw 'Import TenantCourtController tidak ditemukan; pasang routes manual dari ROUTES_TENANT_TAMBAHAN.txt' }
    $src = $src.Replace($needle, "$needle`r`n$import")
}
if (-not $src.Contains("->name('courts.schedule');")) {
    $needle = "->name('courts.manage.destroy');"
    if (-not $src.Contains($needle)) { throw 'Grup route tenant tidak ditemukan; pasang routes manual' }
    $addition = @'

            // Pengaturan jadwal dan harga per lapangan
            Route::get('/courts/{court}/schedule', [TenantCourtScheduleController::class, 'index'])->name('courts.schedule');
            Route::post('/courts/{court}/schedule', [TenantCourtScheduleController::class, 'store'])->name('courts.schedule.store');
            Route::put('/courts/{court}/schedule/{timeslot}', [TenantCourtScheduleController::class, 'update'])->name('courts.schedule.update');
            Route::delete('/courts/{court}/schedule/{timeslot}', [TenantCourtScheduleController::class, 'destroy'])->name('courts.schedule.destroy');
'@
    $src = $src.Replace($needle, $needle + $addition)
}
[System.IO.File]::WriteAllText($web, $src, (New-Object System.Text.UTF8Encoding($false)))
$src = Get-Content $layout -Raw
$include = "@include('tenant.partials.sidebar-courts')"
if (-not $src.Contains($include)) {
    $needle = '</nav>'
    if (-not $src.Contains($needle)) { throw 'Tag nav di layout tidak ditemukan; tambahkan include secara manual' }
    $src = $src.Replace($needle, $needle + "`r`n" + $include)
}
[System.IO.File]::WriteAllText($layout, $src, (New-Object System.Text.UTF8Encoding($false)))
Write-Host 'Selesai. Backup: routes/web.php.bak dan resources/views/layouts/tenant.blade.php.bak'
