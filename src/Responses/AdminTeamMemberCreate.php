<?php

namespace Mradwan\AeroTeam\Responses;

use Aero\Responses\ResponseBuilder;
use Mradwan\AeroTeam\Models\TeamMember;
// use Mradwan\AeroTeam\Responses\Steps\AttachPost;
use Illuminate\Http\Request;

class AdminTeamMemberCreate extends ResponseBuilder
{
    // protected static $steps = [
    //     AttachPost::class,
    // ];

    protected $view = 'aero-team::admin.members.create';

    public function __construct(Request $request, TeamMember $teamMember)
    {
        $this->setParameters(compact('request', 'teamMember'));
    }
}
