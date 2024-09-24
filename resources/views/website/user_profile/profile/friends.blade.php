@extends("website.layouts.website")

@section("profile-content")
    @include("website.user_profile.pages.cover_photo_section")
@endsection

@section("content")

    <div class="central-meta">
        <div class="frnds">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="active" href="#frends"
                                        data-toggle="tab">My Friends</a> <span>@php echo $total @endphp </span></li>

            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active fade show " id="frends">
                    <ul class="nearby-contct">

                        {{-- @dd($friendData); --}}
                        @foreach ($friends as $friend)
                            <li>
                                <div class="nearly-pepls">
                                    <figure>
                                        <a href="time-line.html" title=""><img
                                                src="images/resources/friend-avatar9.jpg"
                                                alt=""></a>
                                    </figure>
                                    <div class="pepl-info">

                                        <h4> <a href = "{{ route("website.profile.timeline", ['userId'=> $friend->user->id ]) }}">{{ $friend->user->name }}</a> </h4>
                                        <span>ftv model</span>

                                        <form action="{{route('website.friend.unfriend', ['id' => $friend->user->id])}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button type = "submit" class="btn btn-primary">Unfriend</button>
                                        </form>

                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <div class="lodmore"><button
                            class="btn-view btn-load-more"></button>
                    </div>
                </div>
            </div>
        </div>

@endsection
