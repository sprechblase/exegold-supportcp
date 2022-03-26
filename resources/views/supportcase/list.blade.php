@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Supportfälle</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
      </div>
      <div class="box-body">
        <table id="example1" class="table table-bordered table-hover">
          <thead>
            <tr>
              <th>Type</th>
              <th>Bereich</th>
              <th>Supporter</th>
              <th>User (TS3 / DISCORD / STEAMNAME)</th>
              <th>Fall abgeschlossen?</th>
              <th>Datum</th>
              <th>Aktionen</th>
            </tr>
          </thead>
          <tbody>
            @foreach($cases as $case)
            <tr>
              <td>{{ $case->type }}</td>
              <td>{{ $case->casetype }}</td>
              <td>{{ $case->supporter }}</td>
              <td>{{ $case->spieler }}</td>
              @if($case->done == "YES")
                <td style="color: #098700;">JA</td>
              @else
                <td style="color: #b80000;">NEIN</td>
              @endif
              <td>{{ $case->created_at }}</td>
              <td><center><a onclick="loadSupportCase('{{ $case->id }}');"><i alt="Fall anzeigen" class="fa fa-info"></i></a>  <a style="margin-left: 10px;" href="{{ route('supportcase.edit', $case->id) }}" alt="Fall bearbeiten"><i class="fa fa-edit"></i></a>  <a style="margin-left: 10px;" onclick="deleteSupportCase('{{ $case->id }}');" tooltip="Fall löschen"><i class="fa fa-trash"></i></a></center></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="myModal" class="sidemodal fade" role="dialog">
  <div class="sidemodal-dialog">
    <div class="sidemodal-content">
      <div class="sidemodal-header">
        <button type="button" class="close" data-dismiss="sidemodal">&times;</button>
        <h4 class="sidemodal-title">Supportfall #<span id="fall_id"></span></h4>
      </div>
      <div class="sidemodal-body">

      	<table class="table">
      	  <tbody>
      	    <tr>
      	      <td><strong>Fall-Typ:</strong><span class="pull-right" id="fall_typ"></span></td>
      	      <td><strong>Fall-Bereich:</strong><span class="pull-right" id="fall_bereich"></span></td>
      	    </tr>

      	    <tr>
      	      <td><strong>Supporter:</strong><span class="pull-right" id="fall_supporter"></span></td>
      	      <td><strong>User (TS3 / DISCORD / STEAMNAME):</strong><span class="pull-right" id="fall_spieler"></span></td>
      	    </tr>

      	    <tr>
      	      <td><strong>Fall abgeschlossen?:</strong><span class="pull-right" id="fall_done"></span></td>
      	    </tr>
      	  </tbody>
      	</table>

      	<legend>Fall / Entscheidung:</legend>
      	<pre><span id="fall_fall"></span></pre><br>

      	<legend>Beweise:</legend>
      	<pre><span id="fall_beweise"></span></pre><br>

      </div>
      <div class="sidemodal-footer">
        <button type="button" class="btn btn-default" data-dismiss="sidemodal">Schließen</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

	function deleteSupportCase(id)
	{
		swal({
		  title: "<h3 style='color:#bec5cb'>" + 'Möchtest du den Fall wirklich löschen?' + "</h3>",
		  type: 'warning',
		  showCancelButton: true,
		  confirmButtonColor: '#3085d6',
		  cancelButtonColor: '#d33',
      background: '#2b2a40',
		  confirmButtonText: 'Ja, löschen!',
		  cancelButtonText: 'Abbruch'
		}).then((result) => {
		  if (result.value) {
		    window.location = "{{ url('/supportfall/delete/') }}" + "/" + id
		  }
		})
	}

	function loadSupportCase(id)
	{
		$.ajax({
			url: "{{ url('/supportfall/ajax/') }}" + "/" + id,
			type: 'GET',
		})
		.done(function(data) {

			var obj = JSON.parse(data);

			console.log(obj.type);

			$('#fall_id').text(obj.id);
			$('#fall_typ').text(obj.type);
			$('#fall_bereich').text(obj.casetype);
			$('#fall_supporter').text(obj.supporter);
			$('#fall_spieler').text(obj.spieler);
			$('#fall_scn').text(obj.scn);
			$('#fall_done').text(obj.done);

			$('#fall_fall').html(obj.geschehen);
			$('#fall_beweise').html(obj.Beweise);
			$('#fall_entscheidung').html(obj.Entscheidung);

			$('#myModal').sidemodal('toggle');
		});

	}

  	$('#example1').DataTable({
    	"order": [[ 5, 'desc' ]]
	});

</script>

@endsection
