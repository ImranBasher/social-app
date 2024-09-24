@extends("website.layouts.website")

@section("profile-content")
    @include("website.user_profile.pages.cover_photo_section")
@endsection

@section("content")

    <div id = "timeline section">
        @include("website.post.post_box")
         add posts here
        <div class="loadMore">
            @isset($posts)
                @foreach ($posts as $post)
                    @include("website.post.post")
                @endforeach
            @endisset
        </div>
    </div>



@endsection
