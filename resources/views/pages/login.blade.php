@extends('layouts.app')

@section('content')
    <main class="d-flex justify-content-center align-items-center min-vh-100">

        <form class="" style="min-width: 300px" method="post" action="{{ route('login') }}">
            @csrf

            <h1 class="h3 mb-3 fw-normal text-center">Войдите</h1>

            <div class="form-floating mb-3">
                <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" placeholder="Email">
                <label for="email">Email</label>
                @if($errors->has('email'))
                    @foreach($errors->get('email') as $error)
                        <div class="invalid-feedback">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="form-floating mb-3">
                <input name="password" type="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" placeholder="Пароль">
                <label for="password">Пароль</label>
                @if($errors->has('password'))
                    @foreach($errors->get('password') as $error)
                        <div class="invalid-feedback">
                            {{ $error }}
                        </div>
                    @endforeach
                @endif
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Войти</button>
        </form>
    </main>
@endsection