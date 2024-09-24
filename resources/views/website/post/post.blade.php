<div class="central-meta item">
    <div class="user-post">

        @include("website.post.show_post")  {{-- show posts --}}
        <ul>
        @include("website.post.comment.comment") {{-- Comment bar--}}

        @include("website.post.comment.comment_form")
        </ul>
    </div>
</div>
