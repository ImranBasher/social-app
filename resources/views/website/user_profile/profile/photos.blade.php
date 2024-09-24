@extends("website.layouts.website")

@section("profile-content")
    @include("website.user_profile.pages.cover_photo_section")
@endsection

@section("content")
    <div class="photos-container">
        @foreach($pictures as $picture)
            <div class="photo-item">
{{--                <img src="{{ asset('path/to/images/' . $picture->image) }}" alt="Photo" style="width: 200px; height: 150px; object-fit: cover;">--}}
                <img alt="" height="200" width="100" src = "{{ asset('storage/post_pictures/'.$picture->pic_name) }}" >
            </div>
        @endforeach
    </div>
@endsection
