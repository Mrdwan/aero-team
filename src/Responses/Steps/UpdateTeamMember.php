<?php

namespace Mradwan\AeroTeam\Responses\Steps;

use Aero\Admin\Utils\SlugHelpers;
use Aero\Responses\ResponseBuilder;
use Aero\Responses\ResponseStep;
use Closure;
use Illuminate\Support\Str;

class UpdateTeamMember implements ResponseStep
{
    public function handle(ResponseBuilder $builder, Closure $next)
    {
        $data = $builder->request->validated();
        $data['content'] = $this->formatContent($data);

        $builder->teamMember->image_id = $data['image']['id'];

        SlugHelpers::overrideSlug($builder->request, $builder->teamMember);

        $builder->teamMember->update($data);

        return $next($builder);
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
