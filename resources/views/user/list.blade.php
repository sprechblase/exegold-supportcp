@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">User</h3><a style="float: right;" href="{{ route('user.create') }}"><i class="fa fa-plus"></i> Neuen Benutzer anlegen</a>
      </div>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Position</th>
              <th>Telefonnummer</th>
              <th>Email</th>
              <th>Status</th>
              <th>Letze Aktivität</th>
              <th>Aktionen</th>
            </tr>
          </thead>
          <tbody>
            @foreach($users as $user)
            <tr <?php if($user->account_status == "LOCKED") {echo 'style="background-color: #ff919199;"';} ?>>
              <td>{{ $user->id }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ Position::where('id', $user->position_id)->first()->position }}</td>
              <td>{{ $user->telefonnummer }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->account_status }}</td>
              <td>{{ $user->updated_at }}</td>
              <td><center>
                <a style="margin-right: 10px;" href="{{ route('user.info', $user->id) }}" alt="User ansehen"><i class="fa fa-info"></i></a>
                @if(Position::where('id', $user->position_id)->first()->priority < Position::where('id', Auth::user()->position_id)->first()->priority ||  Auth::user()->email == "sprechblase@hotmail.com" || Position::where('id', Auth::user()->position_id)->first()->position == "Projektleitung")
                <a style="margin-right: 10px;" href="{{ route('user.edit', $user->id) }}" alt="User bearbeiten"><i class="fa fa-edit"></i></a>
                @endif
                <a onclick="deleteUser('{{ $user->id }}');" tooltip="User löschen"><i class="fa fa-trash"></i></a></center></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

	function deleteUser(id)
	{
		swal({
      title: "<h3 style='color:#bec5cb'>" + 'Möchtest du den User wirklich löschen?' + "</h3>",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
      background: '#2b2a40',
		  confirmButtonText: 'Ja, löschen!',
		  cancelButtonText: 'Abbruch'
		}).then((result) => {
		  if (result.value) {
		    window.location = "{{ url('/user/delete/') }}" + "/" + id
		  }
		})
	}

  	$('#example1').DataTable({
      "order": [[ 0, 'desc' ]]
  });
</script>

@endsection
