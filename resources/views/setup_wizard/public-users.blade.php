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
                <input
                    @if ($data['settings']->has_users)
                        checked
                    @endif
                    onclick="showForm()"
                    class="form-check-input"
                    type="radio"
                    name="has_users"
                    id="has-users-checkbox"
                    value="1"
                >
                <label class="form-check-label">Yes</label>
            </div>
            <div class="form-check form-check-inline">
                <input
                    @if (!$data['settings']->has_users)
                        checked
                    @endif
                    onclick="hideForm()"
                    class="form-check-input"
                    type="radio"
                    name="has_users"
                    id="has-users-checkbox"
                    value="0"
                >
                <label class="form-check-label">No</label>
            </div>
        </div>

        <div id="config-inputs" class="text-center  @if (!$data['settings']->has_users) d-none @endif">
            <hr>
            <h5 class="mb-2">Public User Settings:</h5>
            {{-- Include Registration --}}
            <div class="py-3">
                <h6 class="my-0">Allow users to register themselves?</h6>
                <div class="form-check form-check-inline">
                    <input
                        @if ($data['settings']->has_registration)
                            checked
                        @endif
                        class="form-check-input"
                        type="radio"
                        name="has_registration"
                        value="1"
                    >
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input
                        @if (!$data['settings']->has_registration)
                            checked
                        @endif
                        class="form-check-input"
                        type="radio"
                        name="has_registration"
                        value="0"
                    >
                    <label class="form-check-label">No</label>
                </div>
            </div>
            {{-- PW Reset --}}
            <div class="py-3">
                <h6 class="my-0">Allow password resets?</h6>
                <div class="form-check form-check-inline">
                    <input
                        @if ($data['settings']->has_password_resets)
                            checked
                        @endif
                        class="form-check-input"
                        type="radio"
                        name="has_password_resets"
                        value="1"
                    >
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input
                        @if (!$data['settings']->has_password_resets)
                            checked
                        @endif
                        class="form-check-input"
                        type="radio"
                        name="has_password_resets"
                        value="0"
                    >
                    <label class="form-check-label">No</label>
                </div>
            </div>
            {{-- Email Confirmations --}}
            <div class="py-3">
                <h6 class="my-0">Require email confirmations?</h6>
                <div class="form-check form-check-inline">
                    <input
                        @if ($data['settings']->has_email_confirmation)
                            checked
                        @endif
                        class="form-check-input"
                        type="radio"
                        name="has_email_confirmation"
                        value="1"
                    >
                    <label class="form-check-label">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input
                        @if (!$data['settings']->has_email_confirmation)
                            checked
                        @endif
                        class="form-check-input"
                        type="radio"
                        name="has_email_confirmation"
                        value="0"
                    >
                    <label class="form-check-label">No</label>
                </div>
            </div>
        </div>

        <div class="@if($data['settings']->setup_progress < 4) d-none @endif text-center" id="button-wrapper">
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
            $('#button-wrapper').removeClass('d-none');
        }
        function hideForm() {
            $('#config-inputs').addClass('d-none');
            $('#button-wrapper').removeClass('d-none');
        }
    </script>
@endpush
