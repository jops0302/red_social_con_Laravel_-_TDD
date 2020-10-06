@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto">
           
        @include('partials.validation-errors')

            <div class="card border-0 bg-light">
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Username:</label>
                            <input class="form-control" type="text" name="name" placeholder="Tu nombre de usuario ....">
                        </div>

                        <div class="form-group">
                            <label>Nombre:</label>
                            <input class="form-control" type="text" name="first_name" placeholder="Tu nombre ....">
                        </div>

                        <div class="form-group">
                            <label>Apellido:</label>
                            <input class="form-control" type="text" name="last_name" placeholder="Tu apellido ....">
                        </div>

                        <div class="form-group">
                            <label>Email:</label>
                            <input class="form-control" type="email" name="email" placeholder="Tu nombre ....">
                        </div>

                        <div class="form-group">
                            <label>Contraseña:</label>
                            <input class="form-control" type="password" name="password" placeholder="Tu contraseña ....">
                        </div>

                        <div class="form-group">
                            <label>Repite la Contraseña:</label>
                            <input class="form-control" type="password" name="password_confirmation" placeholder="Repite la contraseña ....">
                        </div>

                        <button class="btn btn-primary btn-block" dusk="register-btn">Registro</button>

                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection