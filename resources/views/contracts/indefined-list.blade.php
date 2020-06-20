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
                    <h3 class="text-white">Actualizar indefinido</h3>
                </div>

                <div class="card-body">
                    @foreach ($users as $user)
                    <form action="{{ route('indefined.update', ['id' => $user->contract_indefinite->id]) }}" method="post" class=" box-user">
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
                    <form action="{{ route('indefined.delete',  ['id' => $user->contract_indefinite->id]) }}" method="post" class="box-user">
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
