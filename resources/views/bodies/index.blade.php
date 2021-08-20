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
                  <div class="tab-pane active" role="tabpanel" id="graphic">
                     @include('bodies.tables.graphic' , ['goals_weight' => $goals_weight , 'goals_body_fat' => $goals_body_fat ])
                  </div>
                  <div class="tab-pane" role="tabpanel" id="add">
                  	@include('bodies.tables.add')
                  </div>
                  <div class="tab-pane" role="tabpanel" id="goal">
                     @include('bodies.tables.goal')
                  </div>
                  <div class="tab-pane" role="tabpanel" id="measuring">
                      @include('bodies.tables.measuring' , ['measurements' => $measurements])
                  </div>
               </div>
            </div>
@endsection