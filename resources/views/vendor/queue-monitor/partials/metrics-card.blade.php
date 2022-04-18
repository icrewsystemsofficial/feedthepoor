<div>
    <div class="row">
        <div class="col card-title fs-3 ps-4 pt-4" title="{{ __('Last :days days', ['days' => config('queue-monitor.ui.metrics_time_frame') ?? 14]) }}">
            {{ __($metric->title) }}
        </div>
        <div class="col-auto stat text-primary mt-3 me-3">
            <i class="align-middle " data-feather="clock"></i>
        </div>
    </div>

    <div>

        <h1 class="mt-1 mb-3 ps-3 fs-1"> {{ $metric->format($metric->value) }}</h1>


        <div class="mb-3 ps-3 ">

            @if($metric->previousValue !== null)

            <div class="mt-2 fs-3 text-secondary  {{ $metric->hasChanged() ? ($metric->hasIncreased() ? 'text-success' : 'text-warning') : 'text-secondary' }}">

                @if($metric->hasChanged())
                @if($metric->hasIncreased())
                @lang('Up from')
                @else
                @lang('Down from')
                @endif
                @else
                @lang('No change from')
                @endif

                <span class="text-danger">{{ $metric->format($metric->previousValue) }} </span>
            </div>

            @endif

        </div>

    </div>

</div>