@extends('layouts.admin')

@section('css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script defer>
    $(document).ready(function() {
        $('#table').DataTable();
    });
</script>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <h3>
            Admin Tools <span class="text-muted">></span> Jobs Monitor
        </h3>

        <p class="mt-1">
            The background tasks that are happening inside {{ config('app.name') }}. Please add <code>IsMonitored</code> trait to the jobs to monitor them.
        </p>

        <div class="row">

        @isset($metrics)

        <h3 class="mx-1">
            Statistics
            <br>
            <small class="text-sm">
                Refresh page to update the stats
            </small>
        </h3>

        @foreach($metrics->all() as $metric)
            <div class="card border shadow-lg d-flex col mx-3 mb-2 text-start">
                    @include('queue-monitor::partials.metrics-card', [
                        'metric' => $metric,
                    ])
            </div>
            @endforeach
        @endisset
        </div>

        {{-- <div class="card border px-6 py-4 mb-6 ps-4 bg-white rounded shadow-lg">

            <h2 class="mb-4 ps-3 fs-1 fw-bold text-dark">
                @lang('Filter')
            </h2>

            <form action="" method="get">
                <div class="row flex items-center my-2 mx-2">
                    <div class="col px-2 w-50">
                        <label for="filter_show" class="d-block mb-1 fs-5  text-uppercase fw-bold text-secondary">
                            @lang('Show jobs')
                        </label>
                        <select name="type" id="filter_show" class="w-75 p-2 bg-light border-2 border-secondary rounded">
                            <option @if($filters['type'] === 'all') selected @endif value="all">@lang('All')</option>
                            <option @if($filters['type'] === 'running') selected @endif value="running">@lang('Running')</option>
                            <option @if($filters['type'] === 'failed') selected @endif value="failed">@lang('Failed')</option>
                            <option @if($filters['type'] === 'succeeded') selected @endif value="succeeded">@lang('Succeeded')</option>
                        </select>
                    </div>
                    <div class="col px-2 w-50">
                        <label for="filter_queues" class="d-block mb-1  fs-5  text-uppercase fw-bold text-secondary">
                            @lang('Queues')
                        </label>
                        <select name="queue" id="filter_queues" class="w-75 p-2 bg-light border-2 border-secondary rounded">
                            <option value="all">All</option>
                            @foreach($queues as $queue)
                                <option @if($filters['queue'] === $queue) selected @endif value="{{ $queue }}">
                                    {{ __($queue) }}

                                    @php
                                    $this->dispatch($queue);
                                    @endphp
                                   
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <div class="mt-4">

                    <button type="submit" class="ms-3 btn-sm btn-primary px-4 py-2  bg-opacity-50 hover:bg-primary fs-5 text-uppercase tracking-wider text-white rounded">
                        @lang('Filter')
                    </button>

                </div>

            </form>

        </div> --}}

        <div class="overflow-x-auto shadow-lg mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table" class="w-100 rounded whitespace-no-wrap">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 font-medium text-center fs-5 text-secondary text-uppercase border-1 border-light">@lang('Status')</th>
                                    <th class="px-4 py-3 font-medium text-center fs-5 text-secondary text-uppercase border-1 border-light">@lang('Job')</th>
                                    <th class="px-4 py-3 font-medium text-center fs-5 text-secondary text-uppercase border-1 border-light">@lang('Details')</th>

                                    @if(config('queue-monitor.ui.show_custom_data'))
                                        <th class="px-4 py-3 font-medium text-start fs-5 text-secondary text-uppercase border-1 border-light">@lang('Custom Data')</th>
                                    @endif

                                    <th class="px-4 py-3 font-medium text-center fs-5 text-secondary text-uppercase border-1 border-light">@lang('Progress')</th>
                                    <th class="px-4 py-3 font-medium text-center fs-5 text-secondary text-uppercase border-1 border-light">@lang('Duration')</th>
                                    <th class="px-4 py-3 font-medium text-center fs-5 text-secondary text-uppercase border-1 border-light">@lang('Started')</th>
                                    <th class="px-4 py-3 font-medium text-center fs-5 text-secondary text-uppercase border-1 border-light">@lang('Error')</th>

                                    @if(config('queue-monitor.ui.allow_deletion'))
                                        <th class="px-4 py-3 font-medium text-center fs-5 text-secondary text-uppercase border-1 border-light">@lang('Action')</th>
                                    @endif
                                </tr>

                            </thead>

                            <tbody class="bg-white">
                                @forelse($jobs as $job)
                                    <tr class="">
                                        <td class="p-4 text-secondary fs-5 leading-5 border-1 border-light">
                                            @if(!$job->isFinished())
                                                <span class="badge bg-info">
                                                    <i class="fa-solid fa-sync fa-spin"></i> Running
                                                </span>
                                            @elseif($job->hasSucceeded())
                                                <span class="badge bg-success">
                                                    <i class="fa-solid fa-check-circle"></i> Success
                                                </span>
                                            @else
                                                <span class="badge bg-danger">
                                                    <i class="fa-solid fa-times-circle"></i> Failed
                                                </span>
                                            @endif

                                        </td>

                                        <td class="p-2">
                                            {{ $job->getBaseName() }}
                                            <br>
                                            <small>
                                                #{{ $job->job_id }}
                                            </small>
                                        </td>

                                        <td>
                                            Queue: {{ $job->queue }}<br>
                                            Attempt: {{ $job->attempt }}
                                        </td>

                                        @if(config('queue-monitor.ui.show_custom_data'))
                                            <td class="p-4 text-secondary fs-5 leading-5 border-1 border-light">
                                                    <textarea rows="4"
                                                              class="w-50 fs-5 p-1 border rounded"
                                                              readonly>{{ json_encode($job->getData(), JSON_PRETTY_PRINT) }}
                                                    </textarea>

                                            </td>
                                        @endif

                                        <td>

                                            @if($job->progress !== null)

                                                <div class="w-32">

                                                    <div class="flex items-stretch h-3 rounded-full bg-gray-300 overflow-hidden">
                                                        <div class="h-full bg-success" style="width: {{ $job->progress }}%"></div>
                                                    </div>

                                                    <div class="flex justify-center mt-1 fs-5 text-secondary fw-normal">
                                                        {{ $job->progress }}%
                                                    </div>

                                                </div>

                                            @else
                                                -
                                            @endif

                                        </td>

                                        <td class="p-4 text-secondary fs-5 leading-5 border-1 border-light">
                                            {{ $job->getElapsedInterval()->format('%H:%I:%S') }}
                                        </td>

                                        <td class="p-4 text-secondary fs-5 leading-5 border-1 border-light">
                                            {{ $job->started_at->diffForHumans() }}
                                        </td>

                                        <td class="p-4 text-secondary fs-5 leading-5 border-1 border-light">

                                            @if($job->hasFailed() && $job->exception_message !== null)

                                                {{-- <textarea class="w-50 fs-5 p-1 border rounded">{{ $job->exception_message }}</textarea> --}}
                                                <code>
                                                    {{ $job->exception_message }}
                                                </code>

                                            @else
                                                -
                                            @endif

                                        </td>

                                        @if(config('queue-monitor.ui.allow_deletion'))
                                            <td class="text-center">
                                                <form action="{{ route('queue-monitor::destroy', [$job]) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="btn btn-danger btn-sm">
                                                        @lang('Delete')
                                                    </button>
                                                </form>
                                                @if($job->hasFailed())
                                                    <form action="{{ route('admin.jobs.retry') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" value="{{ $job->getId() }}" name="jobId">
                                                        <button class="btn btn-primary btn-sm mt-2">
                                                            Retry
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <p>
                                        Whoops! No entries found
                                    </p>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if(config('queue-monitor.ui.allow_purge'))
            <div class="mt-5">
                <form action="{{ route('queue-monitor::purge') }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="px-3 py-1 bg-danger bg-opacity-75  hover:bg-opacity-100 text-danger fs-5 text-uppercase tracking-wider text-white rounded">
                        @lang('Delete all entries')
                    </button>
                </form>
            </div>
        @endif
    </div>
</div>
@endsection
