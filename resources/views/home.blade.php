@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(count($publications) == 0)
                Lo lamentamos, actualmente no hay ofertas disponibles.
            @else
                @foreach($publications as $publication)
                    <div class="card">
                        @if(!is_null(\App\Http\Controllers\HomeController::getProperty($publication->property_id)->photo))
                            <div class="card-header"
                                 style="background-image: url('{{asset('storage/'.\App\Http\Controllers\HomeController::getProperty($publication->property_id)->photo)}}');
                                        background-size: cover; height: 200px;">
                        @else
                            <div class="card-header">Imagen no disponible
                        @endif
                        </div>
                        <div class="card-header">
                            {{$publication->pubTitle}}<br/>
                            Tipo de oferta: {{\App\Http\Controllers\HomeController::getPublicationType($publication->type)->name}}
                        </div>
                        <div class="card-body">
                            <p>
                                <strong>{{\App\Http\Controllers\HomeController::getProperty($publication->property_id)->name}}</strong>

                                <br/>
                                Descripción:<br/>
                                {{\App\Http\Controllers\HomeController::getProperty($publication->property_id)->description}}<br/>
                                Dirección: {{\App\Http\Controllers\HomeController::getProperty($publication->property_id)->address}}
                                 ({{\App\Http\Controllers\HomeController::getProperty($publication->property_id)->city}})
                            </p>
                        </div>
                        <div class="card-header" style="display: flex; justify-content: space-between">
                            <h5><strong>Precio</strong>: {{$publication->price}} €</h5>
                            <a class="btn btn-primary" href="{{route('offers.show', $publication->id)}}">Visitar</a>
                        </div>
                    </div>
                    <br/>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
