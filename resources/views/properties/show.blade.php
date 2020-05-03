@extends('layouts.app')

@section('content')
    <div class="col-lg-12">
        <h1 class="my-4">{{$property->name}}</h1>
        @if(Auth::user()->hasRole('admin'))
            <h4 class="my-7">Propietario: {{$owner->name}} ({{$owner->email}})</h4>
        @endif
        <h2 class="my-5">Descripción</h2>
        <p>{{$property->description}}</p>
        <p><strong>Tipo: </strong>{{$type->name}}</p>
        <p><strong>Ciudad: </strong>{{$property->city}}</p>
        <p><strong>Dirección: </strong>{{$property->address}}</p>
        <p><strong>m2: </strong>{{$property->m2}}</p>
        <br/>
        <br/>
        @if($property->photo!=null)
            <img src="{{asset('storage/'.$property->photo)}}" width="150px">
            <br/>
            <br/>
            </br>
        @endif
        <a class="btn btn-info" href="{{route('properties.index')}}">Volver</a>
        <br/>
        <br/>
    </div>
@endsection