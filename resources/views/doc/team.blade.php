@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box box-default">
      @foreach($positions as $position)
      <div class="box-header with-border">
        <h3 class="box-title">{{ $position->position }}</h3>
      </div>
      <div class="box-body">
        {{ User::where('position_id', $position->id)->get() }}
      </div>
      @endforeach
    </div>
  </div>
</div>

@endsection
