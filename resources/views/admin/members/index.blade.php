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
        <tr class="header">
            <th class="w-12 p-2">&nbsp;</th>
            <th>Name</th>
            <th>Url</th>
            <th>&nbsp;</th>
        </tr>
        @forelse($teamMembers as $teamMember)
            <tr>
                <td class="py-1 pr-0 pl-4">
                    <a href="{{ route('aero_team.admin.team.edit', ['teamMember' => $teamMember]) }}" class="block relative text-xs">
                        @if($teamMember->hasImage)
                            <img
                                src="{{ $teamMember->image ? image_factory(30, 43, $teamMember->image->file)->contain()  : '' }}"
                                alt="Team member Image Thumbnail"
                                class="block rounded-sm mx-auto w-full"
                            >
                        @else
                            <span class="ml-3">&mdash;</span>
                        @endif
                    </a>
                </td>
                <td>
                    <a href="{{ route('aero_team.admin.team.edit', ['teamMember' => $teamMember]) }}">
                        {{ \Illuminate\Support\Str::limit($teamMember->name, 50) }}
                    </a>
                </td>
                <td class="whitespace-no-wrap">
                    @if($teamMember->slug)
                        <a href="{{ $teamMember->uri }}" target="_blank">{{ \Illuminate\Support\Str::limit($teamMember->uri, 50) }}</a>
                    @else
                        <span class="text-grey px-1">&mdash;</span>
                    @endif
                </td>
                <td class="flex items-center justify-end">
                    <a class="mr-2" href="{{ route('aero_team.admin.team.edit', ['teamMember' => $teamMember]) }}">
                        @include('admin::icons.manage')
                    </a>
                    <form
                        action="{{ route('aero_team.admin.team.destroy', ['teamMember' => $teamMember]) }}" 
                        method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="mr-2">
                            @include('admin::icons.bin')
                        </button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">No Team members</td>
            </tr>
        @endforelse
    </table>
    {{ $teamMembers->appends(request()->except('page'))->links() }}
@endsection
