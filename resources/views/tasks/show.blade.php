@extends('layouts.master')

@section('content')

    <div class="container">

        @include('tasks.tags', ['tags' => $task->tags])

        <h1>{{ $task->body }}</h1>

        @if ($task->steps->isNotEmpty())
            <ul class="list-group">
                @foreach ($task->steps as $step)
                    <li class="list-group-item">
                        <form method="POST" action="/completed-steps/{{ $step->id }}">
                            @if ($step->completed)
                                @method('delete')
                            @endif

                            @csrf
                            <div class="form-check">
                                <label for="" class="form-check-label {{ $step->completed ? 'completed' : '' }}">
                                    <input type="checkbox" class="form-check-input" name="completed"
                                        onclick="this.form.submit()" {{ $step->completed ? 'checked' : '' }}>
                                    {{ $step->description }}
                                </label>
                            </div>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif

        <form method="POST" class="card card-body mb-4" action="/tasks/{{ $task->id }}/steps">
            @csrf
            <div class="form-group">
                <input type="text" name="description" class="form-control" placeholder="Шаг"
                    value="{{ old('description') }}">
            </div>
            <button type="submit" class="btn btn-primary">Добавить</button>
        </form>

        @include('includes.errors')

    </div>

@endsection
