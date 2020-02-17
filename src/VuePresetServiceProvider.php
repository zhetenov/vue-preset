<?php

namespace Zhetenov\VuePreset;

use Illuminate\Foundation\Console\PresetCommand;
use Illuminate\Support\ServiceProvider;

class VuePresetServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        PresetCommand::macro('vuezh', function($command) {
            Preset::install();
        });
    }
}
