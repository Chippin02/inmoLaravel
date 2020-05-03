@extends('layouts.app')

@section('content')
    <div style="display: flex; justify-content: center;">
        <div class="card" style="width: 50%;">
            <div class="card-body">
                <h3 style="text-align-last: center;">{{$publication->pubTitle}}</h3>
                <h7 style="text-align-last: center; color: gray;">Fecha publicación: {{$publication->created_at}}</h7><br/>
                <div style="display: flex; justify-content: space-between;">
                    <div>
                        <strong>Tipo de oferta: </strong>{{\App\Http\Controllers\HomeController::getPublicationType($publication->type)->name}}<br/>
                        <h4>{{$property->name}} ({{$property_type->name}})</h4>
                        <h5>Descripción:</h5>
                        {{$property->description}}<br/><br/>
                        <strong>Dirección:</strong> {{$property->address}} ({{$property->city}})<br/>
                        <strong>m2:</strong> {{$property->m2}} m2<br/>
                        <strong>Precio:</strong> {{$publication->price}} €<br/>
                        <strong>Persona de contacto:</strong> {{$user->name}} ({{$user->email}})<br/>
                    </div>
                    <div>
                        <img src="{{asset('storage/'.$property->photo)}}" style="width: 400px"/>
                    </div>
                </div>
                <br/>
                <div style="display: flex; justify-content: center;"><a class="btn btn-primary" href="{{route('offers.show', $publication->id)}}">¡Me interesa!</a></div>
            </div>
        </div>
    </div>
@endsection