@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Contrato indefinido
                </div>
                {{-- salario --}}
                <div class="card-body">
                    <form action="{{ route('indefined.save') }}" method="post">
                        @csrf
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
