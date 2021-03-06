@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Datos personales</h3>
                    </div>
                    <div class="box-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if($errors->any())
                            <ul class="list-group">
                                @foreach($errors->all() as $error)
                                    <li class="list-group-item list-group-item-danger">
                                        {{ $error }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <form method="POST" action="{{ route('pages.user-account.update', $user) }}" >
                            @csrf @method('PUT')
                            <div class="form-group">
                                <label for="name">Nombre:</label>
                                <input name="name" class="form-control" type="text" value="{{ old('name', $user->name) }}">
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input name="email" class="form-control" type="text" value="{{ old('email', $user->email) }}">
                            </div>
                            <button class="btn btn-primary btn-block ">Actualizar información</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
