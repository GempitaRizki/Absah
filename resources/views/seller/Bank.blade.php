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
                            <label for="bank_id" class="required-label">Pilih Bank</label>
                            <select class="form-control" id="bank_id" name="bank_id" required>
                                <option value="">Pilih Bank</option>
                                @foreach ($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="number" class="required-label">Nomor Rekening</label>
                            <input type="text" class="form-control" id="number" name="number" maxlength="255"
                                required>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="form-group">
                            <label for="name" class="required-label">Nama Pemilik Rekening</label>
                            <input type="text" class="form-control" id="name" name="name" maxlength="255"
                                required>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-12">
                        <button type="button" class="btn btn-secondary" onclick="goBack()">Kembali</button>
                        <button type="submit" class="btn btn-primary float-right">Berikutnya</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
@endsection
