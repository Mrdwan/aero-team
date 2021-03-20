<?php

use Mradwan\AeroTeam\Http\Controllers\AdminTeamController;

Route::resource('team', [AdminTeamController::class])->name('aero_team.admin');