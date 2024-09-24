
{{-- @foreach ($users as $user)<br><br>
{{ $user->name }}<br><br>
@endforeach --}}

@extends("website.layouts.website")

@section("content")
<div class="tab-content">
    <div class="tab-pane active fade show" id="frends">
        <ul class="nearby-contct">

            @foreach ($users as $user)
{{--
            <h4>{{ $user->name }}</h4>
            @endforeach --}}
            <li>
                <div class="nearly-pepls">
                    {{-- <figure>
                        <a href="time-line.html" title=""><img src="images/resources/friend-avatar9.jpg" alt=""></a>
                    </figure> --}}
                    <div class="pepl-info">

                        <h4><a href = "{{ route("website.profile.timeline", ['userId'=> $user->id ]) }}">{{ $user->name }}</a> </h4>
                        <span>ftv model</span>

                        <form action="{{ route('website.friends.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="to_user" value="{{ $user->id }}">
                            <button type="submit" class="add-butn">Add Friend</button>
                        </form>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
