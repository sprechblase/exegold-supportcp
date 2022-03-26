@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Neues Banprotokoll</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
          <form method="POST" action="{{ route('banprotokoll.create.post') }}">

            {{ csrf_field() }}

            <div class="form-group">
              <label>Supporter</label>
              <select class="form-control js-example-basic-multiple" name="supporter[]" multiple="multiple" class="js-example-basic-single">
                <option value="{{ Auth::user()->name }}">{{ Auth::user()->name }}</option>
              </select>
            </div>

            <div class="form-group">
              <label>Steamname</label>
              <input type="text" class="form-control" name="spieler" required>
            </div>

            <div class="form-group">
              <label>Grund</label>
              <input type="text" class="form-control" name="forumname" required>
            </div>

            <div class="form-group">
              <label>Supportfall-ID</label> <label style="font-size: 0.7em;">(WENN VORHANDEN)</label>
              <input type="number" class="form-control" name="supportfallid">
            </div>

            <div class="form-group">
              <label>Von</label>
              <input type="text" class="von form-control" name="von" value="{{ date('Y.m.d H:i') }}" required>
            </div>

            <div class="form-group">
              <label>Bis</label>
              <input type="text" class="bis form-control" name="bis" required>
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
	$( document ).ready(function() {
      $('.von').daterangepicker({
        minDate: Date.now(),
        timePickerIncrement:5,
        singleDatePicker: true,
        timePicker: true,
        format: 'YYYY.MM.DD HH:mm',
        timePicker12Hour: false,
      });

      $('.bis').daterangepicker({
        minDate: Date.now(),
        timePickerIncrement:5,
        singleDatePicker: true,
        timePicker: true,
        format: 'YYYY-MM-DD HH:mm',
        timePicker12Hour: false,
      });
  });
</script>

@endsection
