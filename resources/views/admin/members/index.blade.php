@extends('admin::layouts.main')

@section('content')
    <h2>
        <span class="flex-1">Team members</span>
        <a href="{{ route('aero_team.admin.team.create') }}" class="btn btn-secondary">
            @include('admin::icons.add') New Team member
        </a>
    </h2>
    @include('admin::partials.alerts')
    <table>
        <tr class="header" v-else>
            <th class="w-12">
                <label class="checkbox">
                    <input id="select-all" type="checkbox" @change="bulk.selectAll" autocomplete="off">
                    <span></span>
                </label>
            </th>
            <th>&nbsp;</th>
            <th>Name</th>
            <th>Url</th>
        </tr>
        @forelse($teamMembers as $teamMember)
            <tr>
                <td class="w-12">
                    <label class="checkbox">
                        <input type="checkbox" @change="bulk.toggleSelect(@json($teamMember->id))"
                                autocomplete="off"
                                :checked="bulk.isSelected(@json($teamMember->id))">
                        <span></span>
                    </label>
                </td>
                <td class="py-1 pr-0 pl-4">
                    <a href="{{ route('aero_team.admin.edit', ['teamMember' => $teamMember]) }}" class="block relative text-xs">
                        @if($teamMember->hasImage)
                            <img
                                src="{{ $teamMember->image ? image_factory(30, 43, $teamMember->image->file)->contain()  : '' }}"
                                alt="Team member Image Thumbnail"
                                class="block w-full rounded-sm mx-auto"
                            >
                        @else
                            <span class="ml-3">&mdash;</span>
                        @endif
                    </a>
                </td>
                <td>
                    <a href="{{ route('aero_team.admin.edit', ['teamMember' => $teamMember]) }}">
                        {{ \Illuminate\Support\Str::limit($teamMember->name, 50) }}
                    </a>
                </td>
                <td class="whitespace-no-wrap">
                    @if($teamMember->slug)
                        <a href="{{ $teamMember->uri }}" target="_blank">{{ \Illuminate\Support\Str::limit($teamMember->url, 50) }}</a>
                    @else
                        <span class="text-grey px-1">&mdash;</span>
                    @endif
                </td>
                <td class="flex items-center justify-end">
                    <a class="mr-2" href="{{ route('aero_team.admin.edit', ['teamMember' => $teamMember]) }}">
                        @include('admin::icons.manage')
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No Team members</td>
            </tr>
        @endforelse
    </table>
    {{ $teamMembers->appends(request()->except('team'))->links() }}
@endsection
