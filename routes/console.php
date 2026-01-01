<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('kpi:recalculate', function () {
    $this->comment('Recalculation stub');
})->purpose('Recalculate KPI scores');
