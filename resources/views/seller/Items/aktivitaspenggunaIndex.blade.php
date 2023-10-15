@extends('cms.index')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Aktivitas Pengguna</h2>
                <a href="{{ route('download.pdf') }}" class="btn btn-primary">Download PDF</a>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Type</th>
                            <th>Message</th>
                            <th>IP</th>
                            <th>Browser</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activities as $activity)
                            <tr>
                                <td>{{ $activity->id }}</td>
                                <td>{{ $activity->type }}</td>
                                <td>{{ $activity->message }}</td>
                                <td>{{ $activity->ip }}</td>
                                <td>{{ $activity->user_agent }}</td>
                                <td>{{ $activity->created_at }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">
                                <div class="pagination">
                                    @if ($activities->previousPageUrl())
                                        <a href="{{ $activities->previousPageUrl() }}" class="btn btn-primary">Previous Page</a>
                                    @endif
                                    @if ($activities->nextPageUrl())
                                        <a href="{{ $activities->nextPageUrl() }}" class="btn btn-primary">Next Page</a>
                                    @endif
                                </div>
                            </td>
                        </tr>                                               
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
