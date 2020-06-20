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
            <div class="card card-user">
                <div class="card-header bg-secondary">
                    <h3 class="text-white">Actualizar Por Servicios</h3>
                </div>

                <div class="card-body">
                    @foreach ($users as $user)
                    <form action="{{ route('services.update', ['id' => $user->contract_service->id]) }}" method="post" class=" box-user">
                        @csrf
                        <div class="card">
                            <div class="card-header bg-light ">
                                {{-- usuario --}}
                                <div class="form-group row ">
                                <label class="col-md-4 col-form-label text-md-right" for="select-usuarios">{{ $user->name .' '.$user->surname }}</label>
                                <input value="{{ $user->id }}"  type="hidden" name="user_id" id="user_id"/>
                            </div>
                            </div>
                                <div class="card-body">
                                    {{-- salario --}}
                                <div class="form-group row">
                                    <label for="salario" class="col-md-4 col-form-label text-md-right">{{ __('Salario') }}</label>

                                    <div class="col-md-6">
                                        <input id="salario" type="number" class="form-control @error('salario') is-invalid @enderror" name="salario" value="" required autofocus>

                                        @error('salario')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                {{-- retefuente --}}
                                <div class="form-group row">
                                    <label for="retefuente" class="col-md-4 col-form-label text-md-right">{{ __('Retefuente') }}</label>

                                    <div class="col-md-6">
                                        <select class="form-control col-md-6" id="select-usuarios" name="retefuente">
                                            <option value="4">4%</option>
                                            <option value="6">6%</option>
                                        </select>

                                        @error('retefuente')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                        Actualizar
                                        </button>
                                    </div>
                                </div>
                                </div>
                        </div>

                    </form>
                    @endforeach
                </div>
            </div>
            <div class="card card-user">
                <div class="card-header bg-secondary">
                  <h3 class="text-white">Elimianr Usuario</h3>
                </div>
                <div class="card-body">
                    @foreach ($users as $user)
                    <form action="{{ route('services.delete',  ['id' => $user->contract_service->id]) }}" method="post" class="box-user">
                        @csrf
                        <div class="card d-flex w-100 justify-content-between flex-row flex-wrap">
                            <div class="card-header bg-light w-50">
                                <div class="form-group row">
                                    <label class="col-md-4 col-form-label text-md-right" for="select-usuarios">{{ $user->name .' '.$user->surname }}</label>
                                    <input value="{{ $user->id }}" type="hidden" name="user_id" id="user_id" />
                                </div>

                            </div>
                            <div class="card-body w-50">

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4 ">
                                        <button type="submit" class="btn btn-danger">
                                        Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
