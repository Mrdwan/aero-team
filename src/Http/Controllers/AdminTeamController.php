<?php

namespace Mradwan\AeroTeam\Http\Controllers;

use Aero\Routing\Controller;
use Illuminate\Http\Request;
use Mradwan\AeroTeam\Models\TeamMember;
use Mradwan\AeroTeam\Responses\AdminTeamMemberCreate;
use Mradwan\AeroTeam\Responses\AdminTeamMemberStore;
use Mradwan\AeroTeam\Responses\AdminTeamMemberUpdate;
use Mradwan\AeroTeam\Responses\AdminTeamMemberEdit;
use Mradwan\AeroTeam\Http\Requests\TeamMembers\CreateTeamMemberRequest;
use Mradwan\AeroTeam\Http\Requests\TeamMembers\UpdateTeamMemberRequest;

class AdminTeamController extends Controller
{
    public function index()
    {
        return view('aero-team::admin.members.index', [
            'teamMembers' => TeamMember::paginate(15)
        ]);
    }
    
    public function show(Request $request, TeamMember $teamMember)
    {
        return $this->process(AdminTeamMemberEdit::class, compact('request', 'teamMember'));
    }

    public function create(Request $request)
    {
        return $this->process(AdminTeamMemberCreate::class, [
            'request' => $request,
            'teamMember' => new TeamMember()
        ]);
    }

    public function store(CreateTeamMEmberRequest $request)
    {
        return $this->process(AdminTeamMemberStore::class, [
            'request' => $request,
            'teamMember' => TeamMember::create($request->validated())
        ]);
    }

    public function edit(Request $request, TeamMember $teamMember)
    {
        return $this->process(AdminTeamMemberEdit::class, compact('request', 'teamMember'));
    }
    
    public function update(UpdateTeamMemberRequest $request, TeamMember $teamMember)
    {
        return $this->process(AdminTeamMemberUpdate::class, compact('request', 'teamMember'));
    }
    
    public function destroy(TeamMember $teamMember) {
        $teamMember->delete();
        return redirect()->route('aero_team.admin.team.index');
    }
}
