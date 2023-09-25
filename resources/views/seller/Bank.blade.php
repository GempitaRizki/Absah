@extends('seller.topbar')

@section('content')
    <style>
        .required-label::after {
            content: " *";
            color: red;
        }
    </style>
    <div class="container mt-5" style="margin-bottom: 100px;">
        <div class="tab-pane" role="tabpanel" id="step5">
            <h3>Informasi Bank</h3>
            <hr>

            <form method="post" action="{{ route('submitBankInfo') }}">
                @csrf

                <div class="row">
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="bank_id" class="col-md-2 col-form-label text-md-end text-start required-label">Pilih Bank</label>
                            <select class="select2-selection select2-selection--single" id="bank_id" name="bank_id" required>
                                <option value="">Pilih Bank</option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->name }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="number" class="col-md-3 col-form-label text-md-end text-start required-label">Nomor Rekening</label>
                            <input type="text" class="form-control" id="number" name="number" maxlength="255" required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name" class="col-md-4 col-form-label text-md-end text-start required-label">Nama Pemilik Rekening</label>
                            <input type="text" class="form-control" id="name" name="name" maxlength="255" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-primary float-right" name="info-usaha">Berikutnya</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
