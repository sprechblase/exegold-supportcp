@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">User bearbeiten</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
          <form method="POST" action="{{ route('user.edit.post', $user->id) }}">

            {{ csrf_field() }}

            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name" value="{{ $user->name }}">
            </div>

            <div class="form-group">
              <label>Position</label>
              <select class="form-control" name="position_id">
                @foreach(Position::all() as $pos)

	                @if($pos->priority < Position::where('id', Auth::user()->position_id)->first()->priority ||  Auth::user()->email == "sprechblase@hotmail.com")
	                <option <?php if($user->position_id == $pos->id) {echo "selected";} ?> value="{{ $pos->id }}">{{ $pos->position }}</option>
	                @endif

                @endforeach
              </select>
            </div>

            <div class="form-group">
              <label>Telefonnummer</label>
              <input type="text" class="form-control" name="telefonnummer" value="{{ $user->telefonnummer }}">
            </div>

            @if($user->email == "sprechblase@hotmail.com" && Auth::user()->email != "sprechblase@hotmail.com")
            @else
            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" name="email" value="{{ $user->email }}">
            </div>
            @endif

            @if($user->email == "sprechblase@hotmail.com" && Auth::user()->email != "sprechblase@hotmail.com")
            @else
            <div class="form-group">
              <label>Passwort</label>
              <input type="password" class="form-control" name="password" value="{{ $user->password }}">
            </div>

            <div class="form-group">
              <label>Account Status</label>
              <select class="form-control" name="account_status">
                <option <?php if($user->account_status == "FREE") {echo 'selected';} ?> value="FREE">FREE</option>
                <option <?php if($user->account_status == "LOCKED") {echo 'selected';} ?> value="LOCKED">LOCKED</option>
              </select>
            </div>
            @endif

            @if($user->email == "sprechblase@hotmail.com" && Auth::user()->email != "sprechblase@hotmail.com")
            @else
            <div class="form-group">
              <label>Permissions</label>
              <select class="form-control" name="permissions[]" multiple="multiple" size="{{ \Spatie\Permission\Models\Permission::all()->count() }}">
                @foreach(\Spatie\Permission\Models\Permission::all() as $perm)
                	@if(Auth::user()->hasPermissionTo($perm->name) || Auth::user()->email == "sprechblase@hotmail.com")
                	<option <?php if($user->hasPermissionTo($perm->name)) {echo "selected";} ?> value="{{ $perm->name }}">{{ $perm->name }}</option>
                	@endif
                @endforeach
              </select>
            </div>
            @endif

            <div class="form-group">
              <button type="submit" class="btn btn-success">Speichern</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
