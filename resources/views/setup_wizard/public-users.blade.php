@extends('layouts.setup-wizard')

@section('title', 'Setup - Step ' . $step)

@section('step-title')
    @include(
        'setup_wizard.partials.step-title',
        [
            'icon' => 'fas fa-user',
            'title' => 'Public Users',
            'step' => $step
        ]
    )
@endsection

@section('content')
    <p>
        Now we will configure your app for public users.
        Select from the settings below.
    </p>
    <hr>
    <form method="POST" class="text-left col-md-8 offset-md-2" action="{{ route('setup-wizard-submit', $step) }}">
        @csrf
        @method('PATCH')

        <div class="text-center">
            <h5>Does your app need public users?</h5>
            <div class="form-check form-check-inline">
                <input onclick="showForm()" class="form-check-input" type="radio" name="has_users" id="has-users-checkbox" value="1">
                <label class="form-check-label">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input onclick="hideForm()" class="form-check-input" type="radio" name="has_users" id="has-users-checkbox" value="0">
                <label class="form-check-label">No</label>
            </div>
        </div>

        <div id="config-inputs" class="text-center d-none">
            <hr>
            <h5 class="mb-2">Public User Settings:</h5>
            {{-- Include Registration --}}
            <div class="py-3">
                <h6 class="my-0">Allow users to register themselves?</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="has_users" id="has-users-checkbox" value="1">
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="has_users" id="has-users-checkbox" value="0">
                    <label class="form-check-label">No</label>
                </div>
            </div>
            {{-- PW Reset --}}
            <div class="py-3">
                <h6 class="my-0">Allow password resets?</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="has_users" id="has-users-checkbox" value="1">
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="has_users" id="has-users-checkbox" value="0">
                    <label class="form-check-label">No</label>
                </div>
            </div>
            {{-- Email Confirmations --}}
            <div class="py-3">
                <h6 class="my-0">Require email confirmations?</h6>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="has_users" id="has-users-checkbox" value="1">
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="has_users" id="has-users-checkbox" value="0">
                    <label class="form-check-label">No</label>
                </div>
            </div>

            <button type="submit" class="btn mt-4 btn-primary">
                <i class="fas fa-check"></i> Submit
            </button>
        </div>

    </form>
@endsection

@push('scripts')
    <script>
        function showForm() {
            $('#config-inputs').removeClass('d-none');
        }
        function hideForm() {
            $('#config-inputs').addClass('d-none');
        }
    </script>
@endpush
