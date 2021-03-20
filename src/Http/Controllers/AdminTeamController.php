<?php

namespace Mradwan\AeroTeam\Http\Controllers;

use Aero\Routing\Controller;
use Illuminate\Http\Request;
use Mradwan\AeroTeam\Models\TeamMember;

class AdminTeamController extends Controller
{
    public function index()
    {
        return view('aero-team::admin.members.twig', [
            'teamMembers' => TeamMember::paginate(15)
        ]);
    }

    public function create()
    {
        return null;
    }
}
