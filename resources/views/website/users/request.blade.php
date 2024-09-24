@extends("website.layouts.website")


@section("content")


    <div class="central-meta">
        <div class="frnds">
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="" href="{{ route('website.friend.requests') }}"
                        data-toggle="tab">Friend Requests</a><span>@php echo $total @endphp</span>
                    </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                    <ul class="nearby-contct">

                        {{-- @dd($data); --}}
                        @foreach ($data as $request)

                        {{-- {{ $request->from_user }}
                        {{ $request->id }} --}}
                        <li>
                            <div class="nearly-pepls">
                                <figure>
                                    <a href="time-line.html" title=""><img
                                            src="images/resources/nearly5.jpg"
                                            alt=""></a>
                                </figure>

                                <div class="pepl-info">
                                    <h4>  <a href = "{{ route("website.profile.timeline", ['userId'=> $request->incomingRequest->id ]) }}"> {{ $request->incomingRequest->name }} </a>
                                    </h4>
                                    <span>ftv model</span>
                                    <form action="{{ route('website.friends.deleteRequest', ['id' => $request->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary"> Delete</button>
                                    </form>

                                    <form action="{{ route('website.friends.acceptRequest', $request->id) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary"> Confirm </button>
                                    </form>

                                </div>
                            </div>
                        </li>
                        @endforeach

                    </ul>
                    <button class="btn-view btn-load-more"></button>

            </div>
        </div>

</div><!-- centerl meta -->








@endsection
