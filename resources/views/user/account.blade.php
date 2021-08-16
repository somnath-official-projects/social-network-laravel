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
        <div class="profile-background">
					<a href="{{url('user/account/edit')}}" class="btn btn-primary btn-sm" style="position: absolute; right: 10px; top: 10px;"><i class="bi bi-pencil-fill"></i> Edit profile</a>
				</div>
        <div class="profile-image-container">
            <img src="{{asset('images/no-image.png')}}" class="img-fluid profile-image">
        </div>
    </div>
    <div class="container user-details-container mb-5">
        @if(sizeOf($userInfo))
            <div class="card">
                <div class="card-body">
                    <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p>{{auth()->user()->name}}</p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <p><i class="bi bi-telephone-fill"></i> Phone<br> {{$userInfo[0]->phone}}</p>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <p><i class="bi bi-house-fill"></i> Address <br> {{$userInfo[0]->address}}</p>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <p><i class="bi bi-info-circle-fill"></i> About <br> {{$userInfo[0]->about}}</p>
                            </div>
                    </div>
                </div>
            </div>
        @else
            <div class="card">
                <div class="card-body">
                    <div class="row">
                            <div class="col-sm-12 col-md-6">
                                <p>{{auth()->user()->name}}</p>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <p><i class="bi bi-telephone-fill"></i> Phone </p>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <p><i class="bi bi-house-fill"></i> Address </p>
                            </div>
                            <div class="col-sm-12 col-md-12">
                                <p><i class="bi bi-info-circle-fill"></i> About </p>
                            </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('js')
@endsection