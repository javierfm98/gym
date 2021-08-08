@extends('layouts.menu')
@section('title', 'Entreno')

@section('content')



@foreach( $training as $category)
    <li>{{ $category->name }}</li>
    @endforeach



@endsection