@extends('cms.index')

@section('content')
    <section class="content">
        <div class="container">
            <div class="row">
                @php
                    $store = \App\Models\StoreUser::where('user_id', Auth::user()->id)->first();
                @endphp
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            @php
                                $totalAll = \App\Models\Faktur::where('store_id', $store->store_id)->count();
                            @endphp
                            <h3>{{ $totalAll }}</h3>
                            <p>Total No Faktur</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            @php
                                $totalAll = \App\Models\Faktur::where('store_id', $store->store_id)
                                    ->where('status_faktur', 151)
                                    ->count();
                            @endphp
                            <h3>{{ $totalAll }}</h3>
                            <p>Sudah E-Faktur</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            @php
                                $totalAll = \App\Models\Faktur::where('store_id', $store->store_id)
                                    ->where('status_faktur', 152)
                                    ->count();
                            @endphp
                            <h3>{{ $totalAll }}</h3>
                            <p>Belum E-Faktur</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-secondary">
                        <div class="inner">
                            @php
                                $totalAll = \App\Models\Faktur::where('store_id', $store->store_id)
                                    ->where('status_faktur', 153)
                                    ->count();
                            @endphp
                            <h3>{{ $totalAll }}</h3>
                            <p>Batal E-Faktur</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-index">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modalFaktur">
                            <i class="fas fa-plus"></i> Tambah No. Faktur
                        </button>

                        <a href={{ asset('asset/FAKTUR.xlsx') }} class="btn btn-success"><i class="fa fa-download"></i>
                            Export Excel</a>

                        <div class="modal fade" id="modalFaktur" tabindex="-1" role="dialog"
                            aria-labelledby="modalFakturTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-center" id="modalFakturTitle">Range No. Faktur</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('store-pajak') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="no_faktur" required>No. Faktur Awal</label>
                                                <input type="text" class="form-control" id="no_faktur"
                                                    name="no_faktur" required pattern="[0-9]{3}\.[0-9]{2}\.[0-9]{8}"
                                                    placeholder="No Faktur Awal">
                                            </div>
                                            <div class="form-group">
                                                <label for="">No. Faktur Akhir</label>
                                                <input type="text" class="form-control" id="no_faktur_akhir"
                                                    name="" required pattern="[0-9]{3}\.[0-9]{2}\.[0-9]{8}"
                                                    placeholder="No Faktur Akhir">
                                            </div>
                                        </div>
                                        <div class="modal-footer justify-content-right">
                                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i>
                                                Simpan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>No. Faktur</th>
                                                <th>Status</th>
                                                <th>Nomor Order</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Fakturs as $faktur)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $faktur->no_faktur }}</td>
                                                <td>{{ $statusFakturList[$faktur->status_faktur] }}</td>
                                                <td>
                                                    @if ($faktur->order)
                                                        {{ $faktur->order->nomor_order }}
                                                    @else
                                                        (Non Set)
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                                               
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#no_faktur, #no_faktur_akhir').on('input', function() {
                var inputValue = $(this).val();
                var formattedValue = formatFaktur(inputValue);
                $(this).val(formattedValue);
            });
            function formatFaktur(input) {
                var numbers = input.replace(/\D/g, '');
                if (numbers.length > 13) {
                    numbers = numbers.slice(0, 13);
                }
                var formattedValue = numbers.replace(/(\d{3})(\d{2})(\d{8})/, '$1.$2.$3');
                return formattedValue;
            }
        });
    </script>
    <script>
        @if(session('success'))
            alert("{{ session('success') }}");
        @endif
    </script>
@endsection
