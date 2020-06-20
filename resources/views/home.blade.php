@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">Crear Contrato</div>

                <div class="card-body contrato-indefinido">
                    <a class="btn btn-light" href=" {{ route('contract.indefined') }}">Indefinido </a>
                </div>
                <hr>
                <div class="card-body contrato-por-servicios">
                    <a class="btn btn-light" href="{{ route('contract.services') }}"> Por servicios</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
