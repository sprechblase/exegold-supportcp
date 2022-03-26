@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box">
      <div class="box-header with-border">
        <h3 class="box-title">Logs</h3>

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
              <th>User</th>
              <th>Model</th>
              <th>Aktion</th>
              <th>Datum</th>
              <th>Aktionen</th>
            </tr>
          </thead>
          <tbody>
            @foreach($logs as $log)
            <tr>
              <td>{{ $log->id }}</td>
              <td>{{ $log->user_id }}</td>
              <td>{{ $log->model }}</td>
              <td>{{ $log->action }}</td>
              <td>{{ $log->created_at }}</td>
              <td><center><a onclick="loadLog('{{ $log->id }}');"><i alt="Fall anzeigen" class="fa fa-info"></i></a></center></td>
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
        <h4 class="sidemodal-title">Log #<span id="log_id"></span></h4>
      </div>
      <div class="sidemodal-body">

      	<table class="table">
      	  <tbody>
      	    <tr>
      	      <td><strong>User-ID:</strong><span class="pull-right" id="log_user"></span></td>
      	    </tr>

      	    <tr>
      	      <td><strong>Model:</strong><span class="pull-right" id="log_model"></span></td>
      	      <td><strong>Aktion:</strong><span class="pull-right" id="log_action"></span></td>
      	    </tr>

      	    <tr>
      	      <td><strong>Erstellt:</strong><span class="pull-right" id="log_created"></span></td>
      	      <td><strong>Update:</strong><span class="pull-right" id="log_updated"></span></td>
      	    </tr>
      	  </tbody>
      	</table>

      	<legend>Data-New:</legend>
      	<pre><span id="log_datanew"></span></pre><br>

      	<legend>Data-Old:</legend>
      	<pre><span id="log_dataold"></span></pre><br>

      </div>
      <div class="sidemodal-footer">
        <button type="button" class="btn btn-default" data-dismiss="sidemodal">Schließen</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">

	function loadLog(id)
	{
		$.ajax({
			url: "{{ url('/log/ajax/') }}" + "/" + id,
			type: 'GET',
		})
		.done(function(data) {

			var obj = JSON.parse(data);

			console.log(obj.type);

			$('#log_id').text(obj.id);
			$('#log_user').text(obj.user_id);
			$('#log_model').text(obj.model);
			$('#log_action').text(obj.action);
			$('#log_created').text(obj.created_at);
			$('#log_updated').text(obj.updated_at);


      $('#log_datanew').html(obj.datanew);
      $('#log_dataold').html(obj.dataold);


			$('#myModal').sidemodal('toggle');
		});

	}

  	$('#example1').DataTable({
    	"order": [[ 0, 'desc' ]]
	});
</script>

@endsection
