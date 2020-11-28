
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
