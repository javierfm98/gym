@extends('layouts.menu') 

@section('title', 'Mi cuerpo')
@section('content')
            <div class="container wrapper mt-4">
               <h3 class="mb-4">Mi cuerpo</h3>
               <ul class="nav nav-pills nav-fill">
                  <li class="nav-item"> <a class="nav-link  active" href="#graphic" data-toggle="tab">Gráfica</a> </li>
                  <li class="nav-item"> <a class="nav-link" href="#add" data-toggle="tab">Añadir medición</a> </li>
                  <li class="nav-item"> <a class="nav-link" href="#goal" data-toggle="tab">Objetivos</a> </li>
                  <li class="nav-item"> <a class="nav-link" href="#measuring" data-toggle="tab">Mediciones</a> </li>
               </ul>

               <div class="tab-content">
                  <div class="tab-pane active" role="tabpanel" id="graphic">1</div>
                  <div class="tab-pane" role="tabpanel" id="add">
                  	@include('bodies.tables.add')
                  </div>
                  <div class="tab-pane" role="tabpanel" id="goal">3</div>
                  <div class="tab-pane" role="tabpanel" id="measuring">4</div>
               </div>
            </div>
@endsection