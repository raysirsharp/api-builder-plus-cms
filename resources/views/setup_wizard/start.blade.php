@extends('layouts.setup-wizard')

@section('title', 'Welcome')

@section('content')
    <div class="px-md-5 px-3 py-5">
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
                <form method="POST" class="text-left col-md-8 offset-md-2" action="{{ route('setup-wizard-submit', 1) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group">
                        <label><i class="fas fa-database"></i> Database Name</label>
                        <input
                            type="text"
                            class="form-control"
                            name="database_name"
                            required value="{{ old('database_name') ?? $data['database_name'] ?? '' }}"
                        />
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-user"></i> Database Username</label>
                        <input
                            type="text"
                            class="form-control"
                            name="database_user_name"
                            required
                            value="{{ old('database_user_name') ?? $data['database_user_name'] ?? '' }}"
                        />
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-lock"></i> Database Password</label>
                        <input
                            type="password"
                            class="form-control"
                            name="database_password"
                            required
                            value="{{ old('database_password') ?? $data['database_password'] ?? '' }}"
                        />
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-check"></i> Let's Go!
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
