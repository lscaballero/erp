@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif --}}

            <div class="card">
                <div class="card-header">
                    Seleccionar tipo de contrato
                </div>
                <div class="card list-contracts">
                    <div class="card-body">
                        <div class="card-body contrato-indefinido">
                            <a class="btn btn-light" href="{{ route('indefined.list') }}">Indefinido </a>
                        </div>
                        <hr>
                        <div class="card-body contrato-por-servicios">
                            <a class="btn btn-light" href="{{ route('services.list') }}"> Por servicios</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

