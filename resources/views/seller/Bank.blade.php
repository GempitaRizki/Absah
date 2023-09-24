@extends('themes.ezone.footer')

@section('content')
<div class="container mt-5" style="margin-bottom: 100px;">
    <div class="tab-pane" role="tabpanel" id="step5">
        <h3>Informasi Bank</h3>
        <hr>

        <form method="post" action="{{ route('submitBankInfo') }}">
            @csrf

            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="bank_id">Bank</label>
                        <select class="form-control" id="bank_id" name="bank_id" required>
                            <option value="">Pilih Bank</option>
                            @foreach($banks as $bank)
                                <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="number">Nomor Rekening</label>
                        <input type="text" class="form-control" id="number" name="number" maxlength="255" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="name">Nama Pemilik Rekening</label>
                        <input type="text" class="form-control" id="name" name="name" maxlength="255" required>
                    </div>
                </div>
                <input type="hidden" name="status_id" value="22">
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
