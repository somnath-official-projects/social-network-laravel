@extends('layouts.app')

@section('css')
@endsection

@section('content')
  <div class="container-fluid mt-3">
    <ul class="nav nav-tabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" data-bs-toggle="pill" data-bs-target="#request-sent" type="button" role="tab" aria-controls="request-sent" aria-selected="true">Request sent</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="pill" data-bs-target="#request-received" type="button" role="tab" aria-controls="request-received" aria-selected="true">Request received</button>
      </li>
    </ul>
    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="request-sent" role="tabpanel" aria-labelledby="request-sent-tab">
        <h1>Request sent</h1>
      </div>
      <div class="tab-pane fade" id="request-received" role="tabpanel" aria-labelledby="request-received-tab">
        <h1>Request received</h1>
      </div>
    </div>
  </div>
@endsection

@section('js')
@endsection