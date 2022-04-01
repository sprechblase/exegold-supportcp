@extends('layouts.app')

@section('content')

<div class="row">

<!-- motto -->
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
   <span class="info-box-icon bg-green"><i class="ion ion-ios-chatboxes"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">MESSAGE OF THE MONTH</span>
      @if(strpos(env('APP_MOTD'), 'http') !== false)
      <img src="{{ env('APP_MOTD') }}" width="60" height="60"></img>
      @else
      <span class="info-box-number">{{ env('APP_MOTD') }}</span>
      @endif
    </div>
  </div>
</div>
<!-- /motto -->

<!-- teammitglieder -->
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
   <span class="info-box-icon bg-black"><i class="ion ion-ios-bookmarks"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">ID</span>
      <span class="info-box-number">{{ Auth::user()->id }}</span>
    </div>
  </div>
</div>
<!-- /teammitglieder -->

<!-- fix for small devices only -->
<div class="clearfix visible-sm-block"></div>

<!-- rang -->
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
   <span class="info-box-icon bg-black"><i class="ion ion-ios-person"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Rang</span>
      <span class="info-box-number">{{ Position::where('id', Auth::user()->position_id)->first()->position }}</span>
    </div>
  </div>
</div>
<!-- /rang -->

<div class="col-md-3 col-sm-6 col-xs-12">
  <div style="  display: block;
    min-height: 90px;
    width: 100%;
    background-color: #171522;
    border-radius: 2px;
    margin-bottom: 15px;">
  </div>
</div>

<!-- teammitglieder -->
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
   <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Team Mitglieder</span>
      <span class="info-box-number">{{ User::all()->count() }}</span>
    </div>
  </div>
</div>
<!-- /teammitglieder -->

<!-- supportfälle -->
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-aqua"><i class="ion ion-ios-briefcase"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Supportfälle</span>
      <span class="info-box-number">{{ Supportcase::where('done', 'NO')->count() }} / {{ Supportcase::all()->count() }} <small>(offen / gesamt)</small></span>
    </div>
  </div>
</div>
<!-- /supportfälle -->

<!-- ysupportfälle -->
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
   <span class="info-box-icon bg-aqua"><i class="ion ion-ios-briefcase-outline"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Deine Supportfälle</span>
      <span class="info-box-number">{{ Supportcase::where('supporter', Auth::user()->name)->count() }}</span>
    </div>
  </div>
</div>
<!-- /ysupportfälle -->

<!-- banprotokolle -->
<div class="col-md-3 col-sm-6 col-xs-12">
  <div class="info-box">
    <span class="info-box-icon bg-red"><i class="ion ion-ios-eye"></i></span>
    <div class="info-box-content">
      <span class="info-box-text">Banprotokolle</span>
      <span class="info-box-number">{{ Banprotokoll::all()->count() }}</span>
    </div>
  </div>
</div>
<!-- /banprotokolle -->

<div class="col-lg-12">
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Willkommen</h3>

      <div class="box-tools pull-right">
      </div>
    </div>
    <div class="box-body">
        <br>
      Hey {{ Auth::user()->name }} 👋, <br>
        <br>
      Herzlich willkommen im Supportsystem zur Dokumentation jeglicher Supportfälle von {{ env('APP_NAME') }}. <br>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Dignissimos deserunt alias a similique optio odit itaque, autem maxime iure ullam, distinctio ratione veritatis in commodi minus deleniti hic? Ipsum, quaerat.<br>
        <br>
    </div>
  </div>
</div>

<!-- /.row -->
@endsection
