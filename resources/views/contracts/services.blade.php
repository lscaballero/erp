@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Contrato Por Servicios
                </div>

                <div class="card-body">
                    <form action="{{ route('services.save') }}" method="post">
                        @csrf
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
                        {{-- usuario --}}
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="select-usuarios">Seleccionar usuario</label>
                            <select class="form-control col-md-6" id="select-usuarios" name="user_id">
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" >{{ $user->name .' '.$user->surname }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                  Crear
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
