<?php

namespace Mradwan\AeroTeam\Responses;

use Aero\Responses\ResponseBuilder;
use Mradwan\AeroTeam\Models\TeamMember;
use Illuminate\Http\Request;
use Mradwan\AeroTeam\Responses\Steps\AttachTeamMember;

class AdminTeamMemberEdit extends ResponseBuilder
{
    protected static $steps = [
        AttachTeamMember::class,
    ];
    
    protected $view = 'aero-team::admin.members.edit';

    public function __construct(Request $request, TeamMember $teamMember)
    {
        $this->setParameters(compact('request', 'teamMember'));
    }
}
