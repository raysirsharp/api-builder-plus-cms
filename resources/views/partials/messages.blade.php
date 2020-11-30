
{{-- Flash Messages --}}
@if(session('message'))
    <div class="alert alert-info" role="alert">
        <i class="fas fa-info-circle"></i>
        {{ session('message') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" role="alert">
        <i class="fas fa-info-circle"></i>
        {{ session('error') }}
    </div>
@endif

@if(session('success'))
    <div class="alert alert-success" role="alert">
        <i class="fas fa-info-circle"></i>
        {{ session('success') }}
    </div>
@endif

{{-- Validation Errors --}}
@if($errors->any())
    <div class="alert alert-danger" role="alert">
        <i class="fas fa-info-circle"></i>
        The data you submitted is not valid, please check your inputs and try again.
    </div>
    @php
        $errorList = '';
        foreach($errors->all() as $error) {
            if (count($errors) > 1) {
                $errorList = $errorList . '- ';
            }
            $errorList = $errorList . $error . '<br/>';
        }
    @endphp
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Validation Errors',
            html: '{!! $errorList !!}'
        });
    </script>
@endif
