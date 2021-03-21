<?php

use Mradwan\AeroTeam\Http\Controllers\AdminTeamController;

Route::resource('team', AdminTeamController::class, [
    'as' => 'aero_team.admin'    
])->parameters([
    'team' => 'teamMember'
]);