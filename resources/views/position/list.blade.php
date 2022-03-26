@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Positionen</h3><a style="float: right;" href="{{ route('position.create') }}"><i class="fa fa-plus"></i> Neuen Position anlegen</a>
      </div>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Position</th>
              <th>Beschreibung</th>
              <th>Priorität</th>
              <th>Aktionen</th>
            </tr>
          </thead>
          <tbody>
            @foreach($positions as $position)
            <tr>
              <td>{{ $position->id }}</td>
              <td>{{ $position->position }}</td>
              <td>{{ $position->position_description }}</td>
              <td>{{ $position->priority }}</td>

              <td><center><a href="{{ route('position.edit', $position->id) }}" alt="Position bearbeiten"><i class="fa fa-edit"></i></a>  <a style="margin-left: 10px;" onclick="deletePosition('{{ $position->id }}');" tooltip="Position löschen"><i class="fa fa-trash"></i></a></center></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

	function deletePosition(id)
	{
		swal({
		  title: 'Sicher?',
		  text: "Möchtest du die Position wirklich löschen?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Ja, löschen!',
		  cancelButtonText: 'Abbruch'
		}).then((result) => {
		  if (result.value) {
		    window.location = "{{ url('/position/delete/') }}" + "/" + id
		  }
		})
	}

  	$('#example1').DataTable({
    	"order": [[ 3, 'desc' ]]
	});
</script>

@endsection
