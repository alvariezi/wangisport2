<?php

namespace App\Modules\Reporting;

use App\Modules\ModuleServiceProvider;

final class ReportingServiceProvider extends ModuleServiceProvider
{
    public function register(): void
    {
        // Tempat mendaftarkan binding container / singleton untuk modul Reporting
    }

    protected function moduleAlias(): string
    {
        return 'reporting';
    }
}
