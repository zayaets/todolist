@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <a href="{{ route('admin_users') }}" class="btn btn-secondary mb-3">Back</a>

                <div class="card">
                    <div class="card-header">Tasks</div>

                    <div class="card-body">

                        @if(isset($tasks))
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Text</th>
                                    <th>Status</th>
                                    <th>Deleted</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->id }}</td>
                                        <td>{{ $task->text }}</td>
                                        <td>{{ ($task->status == 1) ? 'done' : 'ongoing' }}</td>
                                        <td>{{ $task->deleted_at }}</td>
{{--                                        <td><a href="{{ route('all_tasks', ['id' => $user->id]) }}" class="btn btn-primary">All tasks</a></td>--}}
                                    </tr>

                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
