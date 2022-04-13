<div class="w-full md:w-1/3 px-4 mb-5 pb-1">

    <div class="h-full flex flex-col justify-between py-4 px-1 bg-white rounded shadow-md">

        <div class="fw-normal fs-2 text-secondary pt-2 "
             title="{{ __('Last :days days', ['days' => config('queue-monitor.ui.metrics_time_frame') ?? 14]) }}">
            {{ __($metric->title) }}
        </div>

        <div>

            <div class="mt-2 fs-1  position-absolute bottom-0 start-0 px-5 mb-1">
                {{ $metric->format($metric->value) }}
            </div>

            @if($metric->previousValue !== null)

                <div class="mt-2 fs-5 fw-light {{ $metric->hasChanged() ? ($metric->hasIncreased() ? 'text-success' : 'text-warning') : 'text-secondary' }}">

                    @if($metric->hasChanged())
                        @if($metric->hasIncreased())
                            @lang('Up from')
                        @else
                            @lang('Down from')
                        @endif
                    @else
                        @lang('No change from')
                    @endif

                    {{ $metric->format($metric->previousValue) }}
                </div>

            @endif

        </div>

    </div>

</div>
