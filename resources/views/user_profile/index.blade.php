@extends('layouts.app')

@section('css')
    <style>
        .profile-background{
            background: url({{asset('images/bg7.jpg')}}); 
            background-repeat: no-repeat; 
            background-position: center;
            background-size: 100% 100%;
        }
        .profile-image-container {
            width: 200px;
            height: 200px;
            margin: auto;
            position: relative;
            bottom: 100px;
        }
        .profile-image{
            border-radius: 50%;
            border: 4px solid white;
        }
        .user-details-container{
            /* min-height: 200px; */
        }
        @media screen and (min-width: 769px){
            .profile-background{
                height: 500px;
            }
        }
        @media screen and (max-width: 768px){
            .profile-background{
                height: 300px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="position-relative">
      <div class="profile-background"></div>
      <div class="profile-image-container">
        <img src="{{asset('images/no-image.png')}}" class="img-fluid profile-image">
      </div>
    </div>
    <div class="container user-details-container mb-5">
      <div class="d-flex justify-content-end align-items-center mb-3">
        @if(sizeof($friend_request))
          @if($friend_request[0]->status == 0)
            @if($friend_request[0]->requested_by == auth()->user()->id)
              <a href="{{url('/cancel-friend-request')}}" onclick="event.preventDefault(); document.getElementById('cancel-friend-request-form').submit();" class="btn btn-danger btn-sm"><i class="bi bi-person-x-fill"></i> Cancel friend request</a>
              <form id="cancel-friend-request-form" action="{{ url('/cancel-friend-request') }}" method="POST" class="d-none">
                @csrf
                <input name="requested_to" value="{{$userInfo[0]->user_id}}" type="hidden">
                <input name="requested_by" value="{{auth()->user()->id}}" type="hidden">
              </form>
            @elseif($friend_request[0]->requested_by == $userInfo[0]->user_id)
              <a href="{{url('/cancel-friend-request')}}" onclick="event.preventDefault(); document.getElementById('cancel-friend-request-form').submit();" class="m-1 btn btn-danger btn-sm"><i class="bi bi-person-x-fill"></i> Cancel friend request</a>
              <form id="cancel-friend-request-form" action="{{ url('/cancel-friend-request') }}" method="POST" class="d-none">
                @csrf
                <input name="requested_to" value="{{$friend_request[0]->requested_to}}" type="hidden">
                <input name="requested_by" value="{{$friend_request[0]->requested_by}}" type="hidden">
              </form>

              <a href="{{url('/accept-friend-request')}}" onclick="event.preventDefault(); document.getElementById('accept-friend-request-form').submit();" class="btn btn-success btn-sm"><i class="bi bi-person-check-fill"></i> Accept friend request</a>
              <form id="accept-friend-request-form" action="{{ url('/accept-friend-request') }}" method="POST" class="d-none">
                @csrf
                <input name="requested_to" value="{{$friend_request[0]->requested_to}}" type="hidden">
                <input name="requested_by" value="{{$friend_request[0]->requested_by}}" type="hidden">
              </form>
            @endif
          @endif
          @if($friend_request[0]->status == 1)
            @if($friend_request[0]->requested_by == auth()->user()->id)
              <a href="{{url('/unfriend')}}" onclick="event.preventDefault(); document.getElementById('unfriend').submit();" class="btn btn-danger btn-sm"><i class="bi bi-person-x"></i> Unfriend</a>
              <form id="unfriend" action="{{ url('/unfriend') }}" method="POST" class="d-none">
                @csrf
                <input name="requested_to" value="{{$userInfo[0]->user_id}}" type="hidden">
                <input name="requested_by" value="{{auth()->user()->id}}" type="hidden">
              </form>
            @elseif($friend_request[0]->requested_by == $userInfo[0]->user_id)
              <a href="{{url('/unfriend')}}" onclick="event.preventDefault(); document.getElementById('unfriend').submit();" class="btn btn-danger btn-sm"><i class="bi bi-person-x"></i> Unfriend</a>
              <form id="unfriend" action="{{ url('/unfriend') }}" method="POST" class="d-none">
                @csrf
                <input name="requested_to" value="{{$friend_request[0]->requested_to}}" type="hidden">
                <input name="requested_by" value="{{$friend_request[0]->requested_by}}" type="hidden">
              </form>
            @endif
          @endif
        @else
          <a href="{{url('/send-friend-request')}}" onclick="event.preventDefault(); document.getElementById('send-friend-request-form').submit();" class="btn btn-info btn-sm"><i class="bi bi-person-plus-fill"></i> Send friend request</a>
          <form id="send-friend-request-form" action="{{ url('/send-friend-request') }}" method="POST" class="d-none">
            @csrf
            <input name="requested_to" value="{{$userInfo[0]->user_id}}" type="hidden">
          </form>
        @endif
      </div>
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="col-sm-12 col-md-6">
              <p>{{$userInfo[0]->name}}</p>
            </div>
            <div class="col-sm-12 col-md-6">
              <p><i class="bi bi-telephone-fill"></i> Phone <br> @if($userInfo[0]->phone) {{$userInfo[0]->phone}} @else @endif</p>
            </div>
            <div class="col-sm-12 col-md-12">
              <p><i class="bi bi-house-fill"></i> Address <br> @if($userInfo[0]->address) {{$userInfo[0]->address}} @else @endif</p>
            </div>
            <div class="col-sm-12 col-md-12">
              <p><i class="bi bi-info-circle-fill"></i> About <br> @if($userInfo[0]->about) {{$userInfo[0]->about}} @else @endif</p>
            </div>
          </div>
        </div>
      </div>
      <div class="card mt-3">
        <div class="card-header">
          <h6>Mutual friends</h6>
        </div>
        <div class="card-body">
          <div class="row justify-content-center">
            @forelse($mutualFriends as $friens)
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                      @if($friens->user_requested_to == $userInfo[0]->name)
                        <span>{{$friens->user_requested_by}}</span>
                        
                      @else
                        <span>{{$friens->user_requested_to}}</span>
                      @endif
                    </div>
                </div>
            </div>
            @empty
              <p class="text-center text-danger">Sorry! {{$userInfo[0]->name}} has not made any friends yet. <a href="{{url('/send-friend-request')}}" onclick="event.preventDefault(); document.getElementById('quick-send-friend-request-form').submit();">Send friend request</a></p>
              <form id="quick-send-friend-request-form" action="{{ url('/send-friend-request') }}" method="POST" class="d-none">
                @csrf
                <input name="requested_to" value="{{$userInfo[0]->user_id}}" type="hidden">
              </form>
            @endforelse
          </div>
        </div>
      </div>
    </div>
@endsection

@section('js')
@endsection