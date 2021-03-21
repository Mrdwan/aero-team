<?php

namespace Mradwan\AeroTeam\Http\Requests\TeamMembers;

use Aero\Admin\Http\Requests\SeoFormRequest;

class UpdateTeamMemberRequest extends SeoFormRequest
{
    protected $validated;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'content' => 'nullable|string',
            'content_type' => 'required|string',
            'image' => 'sometimes|array',
            'image.id' => 'nullable|exists:images,id',
        ];
    }
}
