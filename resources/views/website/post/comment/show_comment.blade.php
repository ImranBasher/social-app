{{-- <li> --}}
    <div class="comet-avatar">
        <img src = "{{ asset('frontend') }}/images/resources/comet-1.jpg" alt="">
    </div>
    <div class="we-Comment">
        <div class="coment-head">

            <h5> <a href = "{{ route("website.profile.timeline", ['userId'=> $comment->post_comment_user->id ]) }}">{{ $comment->post_comment_user->name }}</a></h5>
            <span>{{ $comment->created_at }}</span>
            <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
        </div>
        <p>{{ $comment->comment_body }}</p>
    </div>

 @include("website.post.reply_comment.reply_comment")

{{-- </li> --}}
