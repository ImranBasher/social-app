
<div class="friend-info">
    <figure>
        <img src = "{{ asset('frontend') }}/images/resources/friend-avatar10.jpg" alt="">
    </figure>

    <div class="friend-name" class="row">

        <div class="col-sm-10">
            <ins> <a href = "{{ route("website.profile.timeline", ['userId'=> $post->post_user->id ]) }}"> @isset ($post->post_user) {{ $post->post_user->name }} @endisset</a></ins>

            <span>published: {{ $post->created_at }}</span>
        </div>
        <div class="col-sm-2">
            <form action="{{ route("website.delete-post",['postId'=> $post->id]) }}" method = "post">
                @csrf
                @method('DELETE')
                <button type="submit" > Delete</button>
            </form>


            {{-- <form action="{{route('website.friend.unfriend', ['id' => $friend->id])}}" method="post">
                @csrf
                @method('DELETE')
                <button type = "submit" class="btn btn-primary">Unfriend</button>
            </form> --}}


            {{-- <a href="{{ route("website.delete-post",['postId'=> $post->id]) }}"> Delete</a> --}}
        </div>
    </div>

    <div class="post-meta">
        @foreach ($post->post_pictures as $picture )
            <img alt="" height="200" width="100" src = "{{ asset('storage/post_pictures/'.$picture->pic_name) }}" >
        @endforeach
{{--like/comments/share bar--}}
        @include("website.post.post_bar", ['post' => $post->id])

        <div class="description">
            <p> {{ $post->post_body }} </p>
        </div>
    </div>

</div>


