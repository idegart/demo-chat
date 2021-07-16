@extends('layouts.app')

@section('content')

    <main class="container">

        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn btn-outline-primary mb-3 mt-3">Выйти</button>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Email</th>
                <th scope="col">Написать</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <th scope="row">{{ $loop->index + 1 }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <form method="post" action="{{ route('initiate-chat', $user) }}">
                            @csrf
                            <button class="btn btn-primary">Написать</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </main>

@endsection