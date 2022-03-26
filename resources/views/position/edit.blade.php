@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Position bearbeiten</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
          <form method="POST" action="{{ route('position.edit.post', $position->id) }}">

            {{ csrf_field() }}

             <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="position" value="{{ $position->position }}">
            </div>

            <div class="form-group">
              <label>Beschreibung</label>
              <input type="text" class="form-control" name="position_description" value="{{ $position->position_description }}">
            </div>

            <div class="form-group">
              <label>Priorität (Ganzzahl)</label>
              <input type="text" class="form-control" name="priority" value="{{ $position->priority }}">
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success">Speichern</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
