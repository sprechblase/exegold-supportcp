<!--
MIT License

Copyright (c) 2022 Sprechblase

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ config('app.name', 'Laravel') }} | Supportsystem</title>
  <link rel="icon" type="image/png" href="http://localhost/public/dist/img/soss.png">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="http://localhost/public/bower_components/bootstrap/dist/css/bootstrap-midnight.min.css">
  <link rel="stylesheet" href="http://localhost/public/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="http://localhost/public/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="http://localhost/public/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="http://localhost/public/dist/css/skins/skin-new-midnight.min.css">
  <link rel="stylesheet" href="http://localhost/public/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="http://localhost/public/css/modal-side.css">
  <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link href="http://localhost/public/css/select2.min.css" rel="stylesheet" />
  <link href="http://localhost/public/css/daterangepicker-bs3.css" rel="stylesheet" />

  <script src="https://unpkg.com/ionicons@5.0.0/dist/ionicons.js"></script>
  <script src="http://localhost/public/bower_components/jquery/dist/jquery.min.js"></script>
  <script src="http://localhost/public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <script src="http://localhost/public/dist/js/adminlte.min.js"></script>
  <script src="http://localhost/public/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="http://localhost/public/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="http://localhost/public/js/modal-side.js"></script>
  <script src="http://localhost/public/js/sweetalert2.all.js"></script>
  <script src="http://localhost/public/js/phpUnserialize.js"></script>
  <script src="http://cdn.ckeditor.com/4.9.2/full/ckeditor.js"></script>
  <script src="http://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
  <script type="text/javascript" src="http://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script src="http://localhost/public/js/daterangepicker.js"></script>


</head>
  @guest
  <body class="hold-transition skin-midnight sidebar-collapse">
  @else
  <body class="hold-transition skin-midnight sidebar-mini">
  @endguest

<div class="wrapper">

  <header class="main-header">

    <p class="logo">
      <span class="logo-mini"><b>RP</b></span>
      <span class="logo-lg"><b>Roleplay</b> System</span>
    </p>

    <nav class="navbar navbar-static-top" role="navigation">
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
    </nav>
  </header>

  @guest
  @else
  <aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="http://localhost/public/dist/img/soss.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{ Auth::user()->name }}</p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>

      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">HEADER</li>

        <li><a href="{{ url('/') }}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

        <li class="treeview">
          <a href="#"><i class="fa fa-book"></i> <span>Allgemein</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            @foreach(Docs::all() as $doc)
            <li><a href="{{ route('doc.open', $doc->id) }}"><i class="fa fa-book"></i> {{ $doc->description }}</a></li>
            @endforeach
            <li><a href="{{ route('doc.team') }}"><i class="fa fa-users"></i> Teamliste</a></li>
          </ul>
        </li>

        <li class="treeview <?php if(strpos(Route::currentRouteName(), 'supportcase') !== false) {echo 'active';} ?>">
          <a href="#"><i class="fa fa-briefcase"></i> <span>Supportfälle</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('supportcase.create') }}"><i class="fa fa-plus"></i> Neu</a></li>
            <li><a href="{{ route('supportcase.list', 'support') }}"><i class="fa fa-circle-o text-green"></i> Support</a></li>
            <li><a href="{{ route('supportcase.list', 'archiv') }}"><i class="fa fa-circle-o text-grey"></i> Archiv</a></li>
          </ul>
        </li>

        <li class="treeview <?php if(strpos(Route::currentRouteName(), 'banprotokoll') !== false) {echo 'active';} ?>">
          <a href="#"><i class="fa fa-ban"></i> <span>Banprotokolle</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('banprotokoll.create') }}"><i class="fa fa-plus"></i> Neu</a></li>
            <li><a href="{{ route('banprotokoll.list') }}"><i class="fa fa-list"></i> Anzeigen</a></li>
          </ul>
        </li>

        <li class="treeview <?php if(strpos(Route::currentRouteName(), 'user') !== false || strpos(Route::currentRouteName(), 'position') !== false || strpos(Route::currentRouteName(), 'log') !== false) {echo 'active';} ?>">
          <a href="#"><i class="fa fa-pencil"></i> <span>Verwaltung</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{ route('user.selfedit') }}"><i class="fa fa-user-md"></i> Profil</a></li>
            <li><a href="{{ route('logout') }}"
              onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
            <i class="fa fa-sign-out"></i> Logout</a></li>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            {{ csrf_field() }}
            </form>
            <br>
            <li><a href="{{ route('user.list') }}"><i class="fa fa-users"></i> Benutzerverwaltung</a></li>
            <li><a href="{{ route('position.list') }}"><i class="fa fa-users"></i> Positionen</a></li>
            <li><a href="{{ route('doc.list') }}"><i class="fa fa-book"></i> Docs verwalten</a></li>
            <li><a href="{{ route('log.list') }}"><i class="fa fa-list"></i> Logs</a></li>
          </ul>
        </li>

      </ul>
    </section>
  </aside>
  @endguest

  <div class="content-wrapper">
    <section class="content container-fluid">
      <div class="row">
        <div class="col-lg-12">

        	@if(env('APP_DEBUG') == true)
        	<div class="alert alert-warning">
        		<strong>WARTUNGSARBEITEN</strong> - Es kann zu temporären Ausfällen kommen.
        	</div>
        	@endif

          @if (session('success'))
          <div class="alert alert-success">
            {{ session('success') }}
          </div>
          @endif

          @if (session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
          @endif

          @if (session('warning'))
          <div class="alert alert-warning">
            {{ session('warning') }}
          </div>
          @endif
        </div>
      </div>

      @yield('content')

    </section>
  </div>

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <script>
        window.setInterval(function(){
        document.getElementById("localtime").innerHTML = new Date().toLocaleTimeString();
        },1000);
      </script>
       {{ date('d.m.Y') }} | <span id="localtime"></span> Uhr
    </div>
   <strong>Copyright &copy; {{ date('Y') }} <a href="https://github.com/sprechblase">Sprechblase</a></strong>
  </footer>
</div>

</body>
</html>
