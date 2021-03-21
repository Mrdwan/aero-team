<?php

namespace Mradwan\AeroTeam\Responses\Steps;

use Aero\Admin\Models\Admin;
use Aero\Responses\ResponseBuilder;
use Aero\Responses\ResponseStep;
use Closure;
use Illuminate\Support\Str;

class AttachTeamMember implements ResponseStep
{
    public function handle(ResponseBuilder $builder, Closure $next)
    {
        $teamMember = $builder->teamMember;

        $advancedEditor = Str::startsWith($teamMember->content, '<!-- advanced -->');

        if ($advancedEditor) {
            $teamMember->content = substr($teamMember->content, strlen('<!-- advanced -->'));
        }

        $builder->setData('teamMember', $teamMember);
        $builder->setData('advancedEditor', $advancedEditor);
        
        
        // $builder->setData('listingUri', url(setting('blog.blog_uri')));

        return $next($builder);
    }
}
