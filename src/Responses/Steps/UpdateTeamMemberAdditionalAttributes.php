<?php

namespace Mradwan\AeroTeam\Responses\Steps;

use Aero\Responses\ResponseBuilder;
use Aero\Responses\ResponseStep;
use Closure;

class UpdateTeamMemberAdditionalAttributes implements ResponseStep
{
    public function handle(ResponseBuilder $builder, Closure $next)
    {
        $teamMember = $builder->teamMember;

        collect($teamMember->additionals)->mapWithKeys(function ($additional) {
            return [$additional->key => ['key' => $additional->key, 'value' => null]];
        })->replace(collect($builder->request->validated()['additional_attributes'] ?? [])->mapWithKeys(function ($additional) {
            return [
                $additional['key'] => ['key' => $additional['key'], 'value' => $additional['value']],
            ];
        }))->each(static function ($attribute) use ($teamMember) {
            $teamMember->additional($attribute['key'], $attribute['value']);
        });

        return $next($builder);
    }
}
