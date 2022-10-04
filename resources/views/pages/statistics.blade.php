@extends('layouts.master')

@php
    $posts = $posts ?? collect();
    $news = $news ?? collect();
    $comments = $comment ?? collect();
    $tags = $tag ?? collect();
    $users = $user ?? collect();
@endphp

@section('content')

    <main role="main" class="container">

        <table class="table table-striped table-dark">
            <thead>
            <tr>
                <th scope="col">Общее количество статей:</th>
                <th scope="col">{{ $postsCount }}</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <th scope="row">Общее количество новостей:</th>
                <td>{{ $newsCount }}</td>
            </tr>
            <tr>
                <th scope="row">ФИО автора, у которого больше всего постов на сайте:</th>
                <td>{{ $userMaxCountPosts }}</td>
            </tr>
            <tr>
                <th scope="row">ФИО автора, у которого больше всего новостей на сайте:</th>
                <td>{{ $userMaxCountNews }}</td>
            </tr>
            <tr>
                <th scope="row">Самая длинная статья:</th>
                <td>Larry</td>
            </tr>
            <tr>
                <th scope="row">Самая короткая статья:</th>
                <td>Larry</td>
            </tr>
            <tr>
                <th scope="row">Средние количество статей у активных пользователей:</th>
                <td>Larry</td>
            </tr>
            <tr>
                <th scope="row">Самая непостоянная:</th>
                <td>Larry</td>
            </tr>
            <tr>
                <th scope="row">Самая обсуждаемая статья:</th>
                <td>Larry</td>
            </tr>
            </tbody>
        </table>
    </main><!-- /.container -->

@endsection

