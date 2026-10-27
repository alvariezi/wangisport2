<?php

namespace App\Modules\Ordering;

use App\Modules\ModuleServiceProvider;

final class OrderingServiceProvider extends ModuleServiceProvider
{
    public function register(): void
    {
        // Tempat mendaftarkan binding container / singleton untuk modul Ordering
    }

    protected function moduleAlias(): string
    {
        return 'ordering';
    }
}
