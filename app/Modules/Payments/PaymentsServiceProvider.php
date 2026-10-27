<?php

namespace App\Modules\Payments;

use App\Modules\ModuleServiceProvider;

final class PaymentsServiceProvider extends ModuleServiceProvider
{
    public function register(): void
    {
        // Tempat mendaftarkan binding container / singleton untuk modul Payments
    }

    protected function moduleAlias(): string
    {
        return 'payments';
    }
}
