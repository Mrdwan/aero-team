<?php

namespace Mradwan\AeroTeam;

use Aero\Admin\AdminModule;
use Aero\Common\Providers\ModuleServiceProvider;

class ServiceProvider extends ModuleServiceProvider
{
    public function setup() 
    {
        AdminModule::create('team_profiles')
            ->title('Team Profiles')
            ->summary('Manage Team members Profiles')
            ->routes(__DIR__.'/../routes/admin.php')
            ->route('aero_team.admin.team.index');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'aero-team');
    }
}