@extends('layouts.app')

@section('content')

<div class="row">
  <div class="col-lg-12">
    <div class="box box-default">
        <div class="box-header with-border">
          <h3 class="box-title">{{ $doc->description }}</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
          <?php echo $doc->iframelink; ?>
        </div>
    </div>
  </div>
</div>

@endsection
