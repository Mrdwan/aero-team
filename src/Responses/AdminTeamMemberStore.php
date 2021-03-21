<?php

namespace Mradwan\AeroTeam\Responses;

use Aero\Responses\ResponseBuilder;
use Mradwan\AeroTeam\Models\TeamMember;
use Mradwan\AeroTeam\Responses\Steps\UpdateTeamMember;
use Mradwan\AeroTeam\Responses\Steps\UpdateTeamMemberAdditionalAttributes;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminTeamMemberStore extends ResponseBuilder
{
    protected static $steps = [
        UpdateTeamMember::class,
        UpdateTeamMemberAdditionalAttributes::class,
    ];

    public function __construct(Request $request, TeamMember $teamMember)
    {
        $this->setParameters(compact('request', 'teamMember'));
    }

    public function getRedirect(): ?RedirectResponse
    {
        return parent::getRedirect() ?: redirect()
            ->route('aero_team.admin.team.index', $this->getParameter('teamMember'))
            ->with([
                'message' => __('A new Team member has been created.'),
            ]);
    }

    protected function formatContent(array $data): string
    {
        $content = $data['content'];

        if (isset($data['content_type']) && $data['content_type'] === 'advanced'
            && ! Str::startsWith($content, '<!-- advanced -->')) {
            $content = '<!-- advanced -->'.$content;
        }

        return $content ?: '';
    }
}
