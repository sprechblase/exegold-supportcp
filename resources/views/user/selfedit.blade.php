@extends('layouts.app')

@section('content')

<div class="row">

    <div class="col-lg-6">
      <div class="box box-widget widget-user-2">
        <div class="widget-user-header bg-yellow">
          <div class="widget-user-image">
            <img class="img-circle" src="http://localhost/public/dist/img/soss.png" alt="User Avatar">
          </div>
          <!-- /.widget-user-image -->
          <h3 class="widget-user-username">{{ $user->name }} (#{{ $user->id }})</h3>
          <h5 class="widget-user-desc">{{ Position::where('id', $user->position_id)->first()->position }}</h5>
        </div>
        <div class="box-footer no-padding">
          <ul class="nav nav-stacked">
            <li><a href="#">Email <span class="pull-right">{{ $user->email }}</span></a></li>
            <li><a href="#">Telefonnummer <span class="pull-right"><?php if(empty($user->telefonnummer)){echo "N/A";} else {echo $user->telefonnummer;} ?></span></a></li>
            <li><a href="#">Status <span class="pull-right">{{ $user->account_status }}</span></a></li>
            <li><a href="#">Insgesamte Supportfälle <span class="pull-right">{{ Supportcase::where('supporter', $user)->count() }}</span></a></li>
            <li><a href="#">Erstelldatum User <span class="pull-right">{{ $user->created_at }}</span></a></li>
            <li><a href="#">Letztes Account Update <span class="pull-right">{{ $user->updated_at }}</span></a></li>
          </ul>
        </div>
      </div>
    </div>

  <div class="col-lg-6">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Bearbeiten</h3>

        <div class="box-tools pull-right">
        </div>
      </div>
      <div class="box-body">
          <form method="POST" action="{{ route('user.selfedit.post') }}">

            {{ csrf_field() }}

            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            </div>

            <div class="form-group">
              <label>Telefonnummer</label>
              <input type="text" class="form-control" name="telefonnummer" value="{{ $user->telefonnummer }}">
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email" value="{{ $user->email }}">
            </div>

            <div class="form-group">
              <label>Passwort</label>
              <input type="password" class="form-control" name="password" value="{{ $user->password }}">
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
