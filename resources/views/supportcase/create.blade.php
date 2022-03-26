@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Neuer Supportfall</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
          <form method="POST" action="{{ route('supportcase.create.post') }}">

            {{ csrf_field() }}

            <div class="form-group">
              <label>Typ</label>
              <select class="form-control" name="type">
                <option value="Regelbruch">Regelbruch</option>
                <option value="Sonstiges">Sonstiges</option>
              </select>
            </div>

            <div class="form-group">
              <label>Bereich</label>
              <select class="form-control" name="casetype">
                <option value="Support">Support</option>
              </select>
            </div>

            <div class="form-group">
              <label>Supporter</label>
              <select class="form-control" name="supporter[]">
                <option value="{{ Auth::user()->name }}">{{ Auth::user()->name }}</option>
              </select>
            </div>

            <div class="form-group">
              <label>User</label> <label style="font-size: 0.75em;">(TS3 / DISCORD / STEAMNAME)</label>
              <input type="text" class="form-control" name="spieler" required>
            </div>

            <div class="form-group">
              <label>Fall / Entscheidung</label>
              <textarea class="form-control" name="geschehen"><p></p></textarea>
            </div>

            <div class="form-group">
              <label>Beweis(e)</label> <label style="font-size: 0.75em;">(WENN NICHT VORHANDEN, FREILASSEN)</label>
              <textarea class="form-control" name="Beweise"><p></p></textarea>
            </div>

            <div class="form-group">
              <label>Fall abgeschlossen?</label>
              <select class="form-control" name="done">
                <option value="YES">Ja</option>
                <option value="NO">Nein</option>
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
	$(function() {
    	CKEDITOR.replace( 'geschehen' );
    	CKEDITOR.replace( 'Beweise' );
    	CKEDITOR.replace( 'Entscheidung' );
  	});
</script>

@endsection
