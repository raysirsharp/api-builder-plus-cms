@extends('layouts.setup-wizard')

@section('title', 'Welcome')

@section('content')
    <div class="px-md-5 px-2 py-5">
        <div class="jumbotron">
            <h3>Welcome!</h3>
            <p class="lead">Let's get started with configuring your application.</p>
            <hr class="my-4">
            <div class="text-center col-md-8 offset-md-2">
                <p>
                    First we will start by configuring your database.
                    At this time you are expected to have MSQL running on your local instance.
                    Please fill in your database credentials below to continue.
                </p>
                <form class="text-left col-md-8 offset-md-2" action="">
                    <div class="form-group">
                        <label><i class="fas fa-database"></i> Database Name</label>
                        <input type="text" class="form-control" id="database_name" name="database_name">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Database Username</label>
                        <input type="text" class="form-control" id="database_user_name" name="database_user_name">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Database Password</label>
                        <input type="text" class="form-control" id="database_password" name="database_password">
                    </div>
                </form>
                <button class="btn btn-primary">
                    <i class="fas fa-check"></i> Let's Go!
                </button>
            </div>
        </div>
    </div>
@endsection
