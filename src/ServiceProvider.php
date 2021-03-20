<?php

namespace Mradwan\AeroTeam;

use Aero\Admin\AdminModule;
use Aero\Common\Providers\ModuleServiceProvider;

class ServiceProvider extends ModuleServiceProvider
{
    public function register(): void 
    {
        AdminModule::create('team_profiles')
            ->title('Team Profiles')
            ->summary('Manage Team members Profiles')
            ->routes(__DIR__.'/routes/admin.php')
            ->route('admin.modules.team');

        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
}