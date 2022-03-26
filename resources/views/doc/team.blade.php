@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box box-default">
      @foreach($positions as $position)
      @if($position->id == 1) @else
      <div class="box-header with-border">
        <h3 class="box-title">{{ $position->position }}</h3>
      </div>
      <div class="box-body">
        @foreach(User::where('position_id', $position->id)->get() as $user)
        <ul style="padding-left: 20px;">
          <li>{{ $user['name'] }}</li>
        </ul>
        @endforeach
      </div>
      @endif
      @endforeach
    </div>
  </div>
</div>

@endsection
