@extends('layouts.menu') 

@section('title', 'Mi cuerpo')
@section('content')

			<div class="wrapper">
				<h3 class="title">Mi cuerpo</h3>
				<div class="nav-container">
					<button class="button-body active-body" onclick="tabClick(event,'graphic')">Grafica</button>
					<button class="button-body" onclick="tabClick(event,'add')">Mediciones</button>
					<button class="button-body" onclick="tabClick(event,'goal')">Añadir medicion</button>
					<button class="button-body" onclick="tabClick(event,'measuring')" style="margin-right: 0;">Objectivos</button>
				</div>

				<div class="tab-container">
					<div id="graphic" class="tab-box" style="display: block;">
						@include('bodies.tables.graphic')
					</div>
					<div id="add" class="tab-box">
						@include('bodies.tables.measuring')
					</div>
					<div id="goal" class="tab-box">
						@include('bodies.tables.add')	
					</div>
					<div id="measuring" class="tab-box">
						@include('bodies.tables.goal')						
					</div>							
				</div>
			</div>

			<script src="{{ asset('js/tabMenu.js') }}"></script>

@endsection
