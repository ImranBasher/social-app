@extends("website.layouts.website") 


@section("content")
<div class="tab-content">
    <div class="tab-pane active fade show" id="frends">
        <ul class="nearby-contct">
            @foreach ($users as $user)
            <li>
                <div class="nearly-pepls">
                    <figure>
                        <a href="time-line.html" title=""><img src="images/resources/friend-avatar9.jpg" alt=""></a>
                    </figure>
                    <div class="pepl-info">
                        <h4>{{ $user->name }}</h4>
                        <span>ftv model</span>
                        
                        @if (in_array($user->id, $friendRequests->toArray()))
                            <form action="{{ route('website.friends.cancel') }}" method="POST">
                                @csrf 
                                <input type="hidden" name="to_user" value="{{ $user->id }}">
                                <button type="submit" class="add-butn">Cancel Request</button>
                            </form>
                        
                            @elseif(in_array($user->id, $acceptRequests->toArray()))
                            <form action="{{ route('website.friends.update',$user->id) }}" method="POST">
                                @csrf 
                                @method('PUT')
                              
                                <button type="submit" class="add-butn">Accept Request</button>
                            </form>
                            
                            @elseif(in_array($user->id, $friends->toArray()))
                            <form action="{{ route('website.friends.update') }}" method="POST">
                                @csrf 
                            
                                <button type="submit" class="add-butn">Friend</button>
                            </form>
                       
                            @else
                            <form action="{{ route('website.friends.store') }}" method="POST">
                                @csrf 
                                <input type="hidden" name="to_user" value="{{ $user->id }}">
                                <button type="submit" class="add-butn">Add Friend</button>
                            </form>
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>  







@endsection 


{{-- <div class="tab-content">
    <div class="tab-pane active fade show" id="frends">
        <ul class="nearby-contct">
            @foreach ($users as $user)
            <li>
                <div class="nearly-pepls">
                    <figure>
                        <a href="time-line.html" title=""><img src="images/resources/friend-avatar9.jpg" alt=""></a>
                    </figure>
                    <div class="pepl-info">
                        <h4>{{ $user->name }}</h4>
                        <span>ftv model</span>
                        
                        @if (in_array($user->id, $friendRequests->toArray()))
                            <form action="{{ route('website.friends.cancel') }}" method="POST">
                                @csrf 
                                <input type="hidden" name="to_user" value="{{ $user->id }}">
                                <button type="submit" class="add-butn">Cancel Request</button>
                            </form>
                        
                            @elseif(in_array($user->id, $acceptRequests->toArray()))
                            <form action="{{ route('website.friends.update',$user->id) }}" method="POST">
                                @csrf 
                                @method('PUT')
                              
                                <button type="submit" class="add-butn">Accept Request</button>
                            </form>
                            
                            @elseif(in_array($user->id, $friends->toArray()))
                            <form action="{{ route('website.friends.update') }}" method="POST">
                                @csrf 
                            
                                <button type="submit" class="add-butn">Friend</button>
                            </form>
                       
                            @else
                            <form action="{{ route('website.friends.store') }}" method="POST">
                                @csrf 
                                <input type="hidden" name="to_user" value="{{ $user->id }}">
                                <button type="submit" class="add-butn">Add Friend</button>
                            </form>
                        @endif
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
</div>  --}}
{{-- @endsection  --}}

{{-- 
<div class="tab-content">
    <div class="tab-pane active fade show " id="frends" >
        <ul class="nearby-contct">
            @foreach ($users as $user )
                


            <li>
                <div class="nearly-pepls">
                    <figure>
                        <a href="time-line.html" title=""><img src="images/resources/friend-avatar9.jpg" alt=""></a>
                    </figure>
                    <div class="pepl-info">
                        <h4>{{ $user->name }}</h4>
                        <span>ftv model</span>
                        @if (in_array($user->id, $friendRequests))
                            <form action="{{ route('website.friends.cancel') }}" method="POST">
                                @csrf 
                                <input type="hidden" name="to_user" value="{{ $user->id }}">
                                <button type="submit" class="add-butn">Cancel Request</button>
                            </form>
                        @else
                            <form action="{{ route('website.friends.store') }}" method="POST">
                                @csrf 
                                <input type="hidden" name="to_user" value="{{ $user->id }}">
                                <button type="submit" class="add-butn">Add Friend</button>
                            </form>
                        @endif
                    </div>
                </div>
            </li>

            @endforeach
        </ul>
    </div>
</div> --}}




{{-- 
<li>
    <div class="nearly-pepls">
        <div class="pepl-info">
            <h4>{{ $user->name }}</h4>
            <span>ftv model</span>
            @php
                $friendRequest = \App\Models\FriendRequest::where('from_user_id', auth()->id())
                    ->where('to_user_id', $user->id)
                    ->first();
            @endphp
            @if ($friendRequest)
                <form action="{{ route('website.friends.cancel') }}" method="POST">
                    @csrf 
                    <input type="hidden" name="to_user" value="{{ $user->id }}">
                    <button type="submit" class="add-butn">Cancel Request</button>
                </form>
            @else
                <form action="{{ route('website.friends.store') }}" method="POST">
                    @csrf 
                    <input type="hidden" name="to_user" value="{{ $user->id }}">
                    <button type="submit" class="add-butn">Add Friend</button>
                </form>
            @endif
        </div>
    </div>
</li>









<li>
    <div class="nearly-pepls">
        <figure>
            <a href="time-line.html" title=""><img src="images/resources/friend-avatar9.jpg" alt=""></a>
        </figure>
        <div class="pepl-info">
            <h4>{{ $user->name }}</h4>
            <span>ftv model</span>
            @if (in_array($user->id, $friendRequests))
                <form action="{{ route('website.friends.cancel') }}" method="POST">
                    @csrf 
                    <input type="hidden" name="to_user" value="{{ $user->id }}">
                    <button type="submit" class="add-butn">Cancel Request</button>
                </form>
            @else
                <form action="{{ route('website.friends.store') }}" method="POST">
                    @csrf 
                    <input type="hidden" name="to_user" value="{{ $user->id }}">
                    <button type="submit" class="add-butn">Add Friend</button>
                </form>
            @endif
        </div>
    </div>
</li> --}}