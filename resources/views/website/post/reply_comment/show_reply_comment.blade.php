<ul>
    @isset($comment->comment_replies)
    {{-- @dd($comment->comment_replies) --}}
        @foreach($comment->comment_replies as $comment_reply)
            <li>
                <div class="comet-avatar">
                    <img src="images/resources/comet-2.jpg" alt="">
                </div>
                <div class="we-Comment">
                    <div class="coment-head">
                        <h5><a href = "{{ route("website.profile.timeline", ['userId'=> $comment_reply->comment_reply_user->id ]) }}">{{ $comment_reply->comment_reply_user->name }}</a></h5>
                        <span>{{ $comment_reply->created_at }}</span>
                        <a class="we-reply" href="#" title="Reply"><i class="fa fa-reply"></i></a>
                    </div>
                    <p>{{ $comment_reply->comment_reply_body }}</p>
                </div>
            </li>
        @endforeach
    @endisset
</ul>
