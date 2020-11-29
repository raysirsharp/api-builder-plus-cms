<h3>
    @if (isset($icon))
        <i class="{{ $icon }}"></i>
    @endif
    {{ $title }} <small>(Step {{ $step }} / 5)</small>
</h3>
<p class="lead">
    @if ($step == 1)
        Let's get started with configuring your application.
    @else
        ... continue configuring your application.
    @endif
</p>
<div class="row">
    <div class="col-6">
        @if ($step > 1)
            <a href="/setup-wizard/{{ $step - 1 }}" class="btn btn-sm btn-info">
                <i class="fas fa-backward"></i> Prev
            </a>
        @endif
    </div>
    <div class="col-6 text-right">
        @if ($data['has_data'])
            <a href="/setup-wizard/{{ $step + 1 }}" class="btn btn-sm btn-info">
                Next <i class="fas fa-forward"></i>
            </a>
        @endif
    </div>
</div>
<hr class="my-4">
