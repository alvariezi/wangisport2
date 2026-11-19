# Jalankan dari root proyek Laravel, sesudah menyalin file patch.
$ErrorActionPreference = 'Stop'
$path = Join-Path (Get-Location) 'routes\web.php'
if (-not (Test-Path $path)) { throw 'routes/web.php tidak ditemukan. Jalankan dari folder proyek Laravel.' }
$src = Get-Content -LiteralPath $path -Raw
if ($src.Contains("->name('customer.courts.show')")) {
    Write-Host 'Route customer.courts.show sudah ada; tidak perlu mengubah routes/web.php.'
    exit 0
}
$needle = "Route::get('/sewa-lapangan', [VenueCatalogController::class, 'index'])"
if (-not $src.Contains($needle)) { throw 'Route /sewa-lapangan tidak ditemukan. Ikuti ROUTE_MANUAL.txt.' }
$backup = "$path.bak_detail_courts"
Copy-Item -LiteralPath $path -Destination $backup -Force
$addition = @'
// Detail lapangan publik - dapat diklik dari katalog
Route::get('/lapangan/{court}', [VenueCatalogController::class, 'showCourt'])
    ->whereNumber('court')
    ->name('customer.courts.show');

'@
$src = $src.Replace($needle, $addition + $needle)
[System.IO.File]::WriteAllText($path, $src, (New-Object System.Text.UTF8Encoding($false)))
Write-Host 'Route detail courts ditambahkan. Backup tersedia pada routes/web.php.bak_detail_courts'
