@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin Dashboard</div>


                    <div class="card-body">

                        <a href="{{ route('admin_users') }}" class="btn btn-primary">Users</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
