@extends('admin::layouts.main')

@section('content')
    <h2><a href="{{ route('aero_team.admin.team.index') }}" class="btn mr-4">@include('admin::icons.back') Back</a>
        {{ \Illuminate\Support\Str::limit($teamMember->name, 60) }}
    </h2>
    @include('admin::partials.alerts')
    <form action="{{ route('aero_team.admin.team.update', $teamMember) }}" method="post">
        @csrf
        @method('put')
        <div class="card w-full">
            <div>
                <label for="name" class="block">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    class="w-full {{ $errors->has('name') ? 'has-error' : '' }}"
                    autocomplete="off"
                    value="{{ old('name', $teamMember->name ?? '') }}"
                    required
                    v-focus
                >
            </div>

            @if($teamMember->shouldHaveSlug())
                <div class="mt-4">
                    <label for="name" class="block">Slug</label>
                    <div class="flex">
                        <input
                            type="text"
                            style="border-top-right-radius: 0;border-bottom-right-radius: 0;border-right:0"
                            readonly
                            disabled
                            value="/{{ setting('team.team_uri') }}/"
                        >
                        <input
                            type="text"
                            id="slug"
                            name="slug"
                            value="{{ old('name', $teamMember->slug->slug ?? '') }}"
                            class="flex-1 {{ $errors->has('slug') ? 'has-error' : '' }}"
                            style="border-top-left-radius: 0;border-bottom-left-radius: 0"
                            autocomplete="off"
                        >
                    </div>
                </div>
            @endif

            <div class="mt-4 w-full">
                <label class="block">Image</label>
                <div class="mt-2 w-full flex">
                    <image-upload
                        class="flex-grow fieldset-disabled-hide"
                        upload-url="{{ route('admin.image-upload', ['directory' => 'images/blogs']) }}"
                        :max="1"
                        @uploaded=""
                        :image-data="{{ json_encode(old('image', ['id' => $teamMember->image->id ?? null, 'file' => $teamMember->image->file ?? null])) }}"
                        :value="[]"
                    >
                        <template v-slot="data">
                            <input type="hidden" name="image[id]" :value="data.image && data.image.id ? data.image.id : null">
                            <input type="hidden" name="image[file]" :value="data.image && data.image.id ? data.image.file : null">
                            <div v-if="data.image && data.image.id" class="mt-4 relative border border-background">
                                <img v-if="data.image.file" class="block w-full" :src="'{{ image_factory(1000, 1000)->contain() }}/' + data.image.file" alt="">
                                <div class="absolute pin opacity-0 hover:opacity-100">
                                    <div class="absolute pin-b pin-x p-2 text-white text-xs font-bold flex items-center justify-center bg-black-50 fieldset-disabled-hide">
                                        <a href="" @click.prevent="data.removeImage" class="p-2 cursor-pointer text-white hover:text-white">
                                            <span class="h-4 inline-block">@include('admin::icons.bin')</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </template>
                    </image-upload>
                </div>
            </div>

            <page-editor
                content="{{ old('content', $teamMember->content) }}"
                gallery="{{ route('admin.image-gallery', ['file' => 'contentGallery'], false) }}"
                :advanced="{{ $advancedEditor ? 'true' : 'false' }}"
            ></page-editor>
        </div>

        <div class="form-buttons">
            <div class="card w-full">
                <button class="btn btn-secondary" type="submit">Save</button>
            </div>
        </div>
    </form>
@endsection
