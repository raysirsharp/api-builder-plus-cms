@extends('layouts.setup-wizard')

@section('title', 'Setup - Step ' . $step)

@section('step-title')
    @include(
        'setup_wizard.partials.step-title',
        [
            'icon' => 'fas fa-user',
            'title' => 'Master User',
            'step' => $step
        ]
    )
@endsection

@section('content')
    <p>
        Now we will set up your master user record.
        This account you will have full permissions to building and managing your application.
    </p>
    <hr>
    <form method="POST" class="text-left col-md-8 offset-md-2" action="{{ route('setup-wizard-submit', $step) }}">
        @csrf
        @method('PATCH')
        <div class="form-group">
            <label><i class="fas fa-user"></i> Username</label>
            <input type="text" class="form-control" name="user_name" required
                value="{{ old('user_name') ?? ($data['user_name'] ?? '') }}" />
        </div>
        <div class="form-group">
            <label><i class="fas fa-envelope"></i> Email</label>
            <input type="email" class="form-control" name="email" required
                value="{{ old('email') ?? ($data['email'] ?? '') }}" />
                <small>(We do note collect this, it will be used within your application only)</small>
        </div>
        <div class="form-group">
            <label><i class="fas fa-lock"></i> Password</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control" id="password" name="password" required />
                <div class="input-group-append">
                    <button onclick="showHidePasswordField(this, 'password')" class="btn btn-info" type="button">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label><i class="fas fa-user-lock"></i> Password Confirmation</label>
            <div class="input-group mb-3">
                <input type="password" class="form-control" id="password_confirm" name="password_confirm" required />
                <div class="input-group-append">
                    <button onclick="showHidePasswordField(this, 'password_confirm')" class="btn btn-info" type="button">
                        <i class="far fa-eye"></i>
                    </button>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-check"></i> Let's Go!
        </button>
    </form>
@endsection


