<?php

namespace App\Modules\Courts;

use App\Modules\ModuleServiceProvider;

final class CourtsServiceProvider extends ModuleServiceProvider
{
    public function register(): void
    {
        // Binding container untuk modul Courts
    }

    protected function moduleAlias(): string
    {
        return 'courts'; // Alias view: courts:: dan Livewire:
    }
}
