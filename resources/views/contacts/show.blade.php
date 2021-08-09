@extends('layouts.master')

@section('content')

    <div class="container">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>E-mail</th>
                <th>Сообщение</th>
                <th>Дата создания</th>
            </tr>
            </thead>
            <tbody>

            @foreach($contacts as $contact)
                <tr>
                    <td>{{ $contact->email }}</td>
                    <td     style="max-width: 400px;">{{ $contact->message }}</td>
                    <td>{{ $contact->created_at->format('d.m.Y')}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>

    </div>

@endsection


