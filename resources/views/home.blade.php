@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="container mt-3">
    <div class="row justify-content-center">
        @forelse ($users as $user)
            <div class="col-md-8 mb-3">
                <div class="card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <span>{{$user->name}}</span>
                        <a href="{{url('/view-profile')}}/{{$user->id}}" class="btn btn-sm btn-primary">View Profile</a>
                    </div>
                </div>
            </div>
        @empty
            <h1 class="text-center text-danger">No Data</h1>
        @endforelse
    </div>
</div>
@endsection

@section('js')
@endsection