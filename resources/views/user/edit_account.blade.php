@extends('layouts.app')

@section('css')
@endsection

@section('content')
  <div class="container-fluid mt-3">
    <div class="card">
      <div class="card-header">
        <h6>Edit your profile.</h6>
      </div>
      <div class="card-body">
        <form action="{{url('/user/account/update')}}" method="POST">
          <div class="row">
            @csrf
            <div class="col-sm-12 col-md-6 mb-3">
              <label for="name" class="form-label">Name</label>
              <input type="text" name="name" class="form-control" id="name" value="{{auth()->user()->name}}" required>
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
              <label for="phone" class="form-label">Phone</label>
              @if(sizeof($userInfo))
                <input type="number" name="phone" class="form-control" id="phone" value="{{$userInfo[0]->phone}}">
              @else
                <input type="number" name="phone" class="form-control" id="phone">
              @endif
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
              <label for="address" class="form-label">Address</label>
              @if(sizeof($userInfo))
                <textarea rows="4" name="address" class="form-control" id="address">{{$userInfo[0]->address}}</textarea>
              @else
                <textarea rows="4" name="address" class="form-control" id="address"></textarea>
              @endif
            </div>
            <div class="col-sm-12 col-md-6 mb-3">
              <label for="about" class="form-label">About</label>
              @if(sizeof($userInfo))
                <textarea rows="4" name="about" class="form-control" id="about">{{$userInfo[0]->about}}</textarea>
              @else
                <textarea rows="4" name="about" class="form-control" id="about"></textarea>
              @endif
            </div>
            <div>
              <button type="submit" class="btn btn-primary btn-sm">Submit</button>
              <a href="{{url('/user/account')}}" class="btn btn-warning btn-sm">Cancel</a>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection

@section('js')
@endsection