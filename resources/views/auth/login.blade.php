@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto px-4 py-2">
       
        @include('partials.validation-errors')

            <div class="card border-0 bg-light">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label >Email:</label>
                    <input  class="form-control" 
                            type="email" 
                            name="email" 
                            placeholder="Tu nombre ...."
                            value="{{ old('email') }}"
                            >
                        </div>

                        <div class="form-group">
                            <label >Contraseña:</label>
                    <input class="form-control" type="password" name="password" placeholder="Tu contraseña ....">
                        </div>
                    <button class="btn btn-primary btn-block" dusk="login-btn">Login</button>
                </div>
                </form>

            </div>
        </div>
    </div>
</div>


@endsection