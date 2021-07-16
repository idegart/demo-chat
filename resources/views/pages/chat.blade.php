@extends('layouts.app')

@section('content')

    <main class="container d-flex justify-content-center min-vh-100">
        <div style="width: 300px">

            <a href="{{ route('users') }}" class="btn btn-outline-primary mb-3 mt-3">Вернуться</a>

            @forelse ($chat->messages as $message)
                <div class="alert {{ $message->getIsMineAttribute() ? 'alert-dark' : 'alert-secondary' }}" role="alert">
                    <h4 class="alert-heading">{{ $message->user->name }}</h4>
                    <p>{{ $message->text }}</p>
                    <hr>
                    <p class="mb-0">
                        {{ $message->created_at->format('m/d/Y H:i') }}
                    </p>
                </div>
            @empty
                <div class="alert alert-primary" role="alert">
                    Начните диалог
                </div>
            @endforelse

            <form method="post" action="{{ route('send-message', $chat) }}">
                @csrf
                <div class="form-floating mb-3">
                    <input name="text" type="text" class="form-control {{ $errors->has('text') ? 'is-invalid' : '' }}" id="text" placeholder="Введите текст">
                    <label for="text">Текст</label>
                    @if($errors->has('text'))
                        @foreach($errors->get('text') as $error)
                            <div class="invalid-feedback">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
            </form>
        </div>
    </main>
@endsection