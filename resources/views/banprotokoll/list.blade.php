@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Banprotokolle</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>ID</th>
              <th>Steamname</th>
              <th>Grund</th>
              <th>Supporter</th>
              <th>Supportfall-ID</th>
              <th>Von</th>
              <th>Bis</th>
              <th>Aktionen</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cases as $case)
            <tr <?php if(date('Y.m.d H:i:s', strtotime($case->bis)) < date('Y.m.d H:i:s')) {echo 'style="background-color: lightgreen;"';} ?>>
              <td>{{ $case->id }}</td>
              <td>{{ $case->spieler }}</td>
              <td>{{ $case->forumname }}</td>
              <td>{{ $case->supporter }}</td>
              @if($case->supportfallid == null)
              <td>Nicht vorhanden</td>
              @else
              <td>{{ $case->supportfallid }}</td>
              @endif
              <td>{{ $case->von }}</td>
              <td>{{ $case->bis }}</td>
              <td><center><a style="margin-right: 10px;" href="{{ route('banprotokoll.edit', $case->id) }}" alt="Banprotokoll bearbeiten"><i class="fa fa-edit"></i></a>  <a onclick="deleteBanprotokoll('{{ $case->id }}');" tooltip="Banprotokoll löschen"><i class="fa fa-trash"></i></a></center></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

	function deleteBanprotokoll(id)
	{
		swal({
		  title: "<h3 style='color:#bec5cb'>" + 'Möchtest du das Banprotokoll wirklich löschen?' + "</h3>",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
      background: '#2b2a40',
		  confirmButtonText: 'Ja, löschen!',
		  cancelButtonText: 'Abbruch'
		}).then((result) => {
		  if (result.value) {
		    window.location = "{{ url('/banprotokoll/delete/') }}" + "/" + id
		  }
		})
	}

  	$('#example1').DataTable({
      'responsive': true,
    	"order": [[ 0, 'desc' ]]
	});

</script>

@endsection
