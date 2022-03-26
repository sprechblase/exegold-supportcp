@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Docs</h3>

        <a href="{{ route('doc.create') }}" class="pull-right"><i class="fa fa-plus"></i> Neu</a>
      </div>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Beschreibung</th>
              <th>Aktionen</th>
            </tr>
          </thead>
          <tbody>
            @foreach($docs as $case)
            <tr>
              <td>{{ $case->id }}</td>
              <td>{{ $case->description }}</td>
              <td><center><a style="margin-right: 10px;" href="{{ route('doc.edit', $case->id) }}" alt="Doc bearbeiten"><i class="fa fa-edit"></i></a>  <a onclick="deleteDoc('{{ $case->id }}');" tooltip="Doc löschen"><i class="fa fa-trash"></i></a></center></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

	function deleteDoc(id)
	{
		swal({
		  title: 'Sicher?',
		  text: "Möchtest du das Doc wirklich löschen?",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
		  confirmButtonText: 'Ja, löschen!',
		  cancelButtonText: 'Abbruch'
		}).then((result) => {
		  if (result.value) {
		    window.location = "{{ url('/doc/delete/') }}" + "/" + id
		  }
		})
	}

  	$('#example1').DataTable({
      'responsive': true,
    	"order": [[ 0, 'desc' ]]
	});

</script>

@endsection
