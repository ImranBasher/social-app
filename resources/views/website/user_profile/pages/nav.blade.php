<!-- 2nd nav bar start -->
<div class="col-lg-10 col-sm-9">
    <div class="timeline-info">
        <ul>
            @isset($posts)
                @foreach ($posts as $post)
                    <li class="admin-name">
                      <h5>
                          <a href = "{{ route("website.profile.timeline", ['userId'=> $post->post_user->id ]) }}"> @isset ($post->post_user) {{ $post->post_user->name }} @endisset</a>
                      </h5>
                      <span>Group Admin</span>
                    </li>
                @endforeach
            @endisset


                <li>
                    <a class="active" href="{{ route('website.profile.timeline', ['userId' => $userId]) }}" title="" data-ripple="">Timeline</a>
                    <a class="" href="{{ route('website.profile.photos', ['userId' => $userId]) }}" title="" data-ripple="">Photos</a>
                    <a class="" href="{{ route('website.profile.friends', ['userId' => $userId]) }}" title="" data-ripple="">Friends</a>
                </li>
{{--                <li>--}}
{{--                <a class="" href="timeline-groups.html" title="" data-ripple="">Groups</a>--}}
{{--                <a class="" href="about.html" title="" data-ripple="">about</a>--}}
{{--                <a class="" href="#" title="" data-ripple="">more</a>--}}
{{--</li>--}}
        </ul>
    </div>
</div><!-- 2nd nav bar end -->





