@extends('cms.index')

@section('content')
    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-info">
                        <span class="info-box-icon"><i class="fas fa-user"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Pengguna</span>
                            <span class="info-box-number">{{ Auth::user()->totalPengguna() }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-success">
                        <span class="info-box-icon"><i class="fas fa-check"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Pengguna Aktif</span>
                            <span class="info-box-number">{{ Auth::user()->totalPenggunaAktif() }}</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box bg-danger">
                        <span class="info-box-icon"><i class="fas fa-times"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total Pengguna Dibekukan</span>
                            <span class="info-box-number">{{ Auth::user()->totalPenggunaBeku() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Jabatan</th>
                            <th>Email</th>
                            <th>Logged At</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataProvider as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->username }}</td>
                                <td>{{ $data->jabatan }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->logged_at }}</td>
                                <td>{{ $data->statuses()[$data->status] ?? 'Status Tidak Dikenali' }}</td>
                                <td>
                                    <!-- Actions buttons here -->
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </section>
@endsection
