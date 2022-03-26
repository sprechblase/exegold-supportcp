@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Doc bearbeiten</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
          <form method="POST" action="{{ route('doc.edit.post', $doc->id) }}">

            {{ csrf_field() }}

            <div class="form-group">
              <label>Titel</label>
              <input type="text" class="form-control" name="description" value="{{ $doc->description }}" required>
            </div>

            <div class="form-group">
              <label>IFrame Code</label>
              <textarea required class="form-control" name="iframelink">{{ $doc->iframelink }}</textarea>
            </div>

            <div class="form-group">
              <label>Zugriff</label>
              <select class="form-control js-example-basic-multiple" name="access[]" multiple="multiple" class="js-example-basic-single">
                @foreach(Position::all() as $pos)
                <option <?php if(strpos($doc->access, $pos->position) !== false) {echo "selected";} ?> value="{{ $pos->position }}">{{ $pos->position }}</option>
                @endforeach
              </select>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-success">Speichern</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('.js-example-basic-multiple').select2();
</script>

@endsection
