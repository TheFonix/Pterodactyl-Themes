{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
	{{ trans('server.index.title', [ 'name' => $server->name]) }}
@endsection

@section('scripts')
	@parent
	{!! Theme::css('css/terminal.css') !!}
@endsection

@section('content-header')
	<!-- <h1>@lang('server.index.header')<small>@lang('server.index.header_sub')</small></h1> -->
	<ol class="breadcrumb">
		<li><a href="{{ route('index') }}">@lang('strings.servers')</a></li>
		<li class="active">{{ $server->name }}</li>
	</ol>
@endsection

@section('content')

<br>
<div class="row">
	<div class="col-xs-12">
		<div class="box">
			<div class="box-body position-relative">
				<div id="terminal" style="width:100%;"></div>
				<div id="terminal_input" class="form-group no-margin">
					<div class="input-group">
						<div class="input-group-addon terminal_input--prompt">Console:~/$</div>
						<input type="text" class="form-control terminal_input--input">
					</div>
				</div>
				<div id="terminalNotify" class="terminal-notify hidden">
					<i class="fa fa-bell"></i>
				</div>
			</div>
			<div class="box-footer text-center">
				@can('power-start', $server)<button class="btn btn-success disabled" data-attr="power" data-action="start">Start</button>@endcan
				@can('power-restart', $server)<button class="btn btn-primary disabled" data-attr="power" data-action="restart">Restart</button>@endcan
				@can('power-stop', $server)<button class="btn btn-danger disabled" data-attr="power" data-action="stop">Stop</button>@endcan
				@can('power-kill', $server)<button class="btn btn-danger disabled" data-attr="power" data-action="kill">Kill</button>@endcan
			</div>
		</div>
	</div>
</div>
<div class="row dynamic-update" data-server="{{ $server->uuidShort }}">
  <div class="row">
	<div class="col-xs-6 col-sm-3">
		<div class="box-body media align-items-center px-xl-3">
		<div class="box box-primary align-items-center">
			<div class="box-header with-border">
				<h3 class="box-title">Memory Usage</h3>
					<div class="text-info"><i class="fas fa-memory text-success ml-1"></i></div>
				</div>
				<div class="box-body">
					<h5 class="h6 text-muted text-uppercase mb-2">
						Memory
					</h5>
					<span class="h2 font-weight-bold mb-0" data-action="memory">--</span><span class="h2 font-weight-bold mb-0"> / {{ $server->memory === 0 ? '∞' : $server->memory }} MB</span> 
				</div>
			</div>    
		</div> 
	</div>
	<div class="col-xs-6 col-sm-3">
		<div class="box-body media align-items-center px-xl-3">
		<div class="box box-primary align-items-center">
			<div class="box-header with-border">
				<h3 class="box-title">Processor Usage</h3>
					<div class="text-info"><i class="fas fa-memory text-success ml-1"></i></div>
				</div>
				<div class="box-body">
					<h5 class="h6 text-muted text-uppercase mb-2">
						CPU
					</h5>
					<span class="h2 font-weight-bold mb-0" data-action="cpu" data-cpumax="{{ $server->cpu }}">--</span><span class="h2 font-weight-bold mb-0"> %</span>
				</div>
			</div>
		</div>
	</div>
		<div class="col-xs-6 col-sm-3">
		<div class="box-body media align-items-center px-xl-3">
		<div class="box box-primary align-items-center">
			<div class="box-header with-border">
				<h3 class="box-title">Node Information</h3>
					<div class="text-info"><i class="fas fa-memory text-success ml-1"></i></div>
				</div>
				<div class="box-body">
					<h5 class="h6 text-muted text-uppercase mb-2">
						Node ID
					</h5>
					<span class="h2 font-weight-bold mb-0">{{ str_limit($server->node->name,10 ) }}</span>
				</div>
			</div>
		</div>
	</div>
			<div class="col-xs-6 col-sm-3">
		<div class="box-body media align-items-center px-xl-3">
		<div class="box box-primary align-items-center">
			<div class="box-header with-border">
				<h3 class="box-title">Connection Information</h3>
					<div class="text-info"><i class="fas fa-memory text-success ml-1"></i></div>
				</div>
				<div class="box-body">
					<h5 class="h6 text-muted text-uppercase mb-2">
						IP Address / Port
					</h5>
					<span class="h2 font-weight-bold mb-0">{{ $server->allocation->ip }} / {{ $server->allocation->port }}</span> 
				</div>
			</div>
		</div>
	</div>
  </div>
</div>


@endsection

@section('footer-scripts')
	@parent
	{!! Theme::js('vendor/ansi/ansi_up.js') !!}
	{!! Theme::js('js/frontend/server.socket.js') !!}
	{!! Theme::js('vendor/mousewheel/jquery.mousewheel-min.js') !!}
	{!! Theme::js('js/frontend/console.js') !!}
	{!! Theme::js('vendor/chartjs/chart.min.js') !!}
	{!! Theme::js('vendor/jquery/date-format.min.js') !!}
	@if($server->nest->name === 'Minecraft' && $server->nest->author === 'support@pterodactyl.io')
		{!! Theme::js('js/plugins/minecraft/eula.js') !!}
	@endif
	{!! Theme::js('js/frontend/serverlist.js?t={cache-version}') !!}
@endsection
