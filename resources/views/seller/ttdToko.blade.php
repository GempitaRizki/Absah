@extends('seller.topbar')

@section('content')
    <style>
        .required-label::after {
            content: " *";
            color: red;
        }
    </style>
    <div class="row">
        <div class="col-md-12 col-12 col-lg-12 col-xl-6 ml-auto mr-auto">
            <div class="login">
                <div class="login-form-container">
                    <div class="login-form">
                        <form method="POST" action="{{ route('StoreSellerIndexForm') }}">
                            @csrf
                            <div class="col-lg-12">
                                <div>
                                    <br>
                                    <h3 class="text-center">Penandatangan Toko</h3>
                                    <hr>
                                    <div class="form-group row">
                                        <label for="name"
                                            class="col-md-4 col-form-label text-md-end text-start required-label">Name</label>
                                        <div class="col-md-6">
                                            <input type="text" required
                                                class="form-control @error('name') is-invalid @enderror" id="name"
                                                name="name" value="{{ Session::get('ownerSession.name') }}">
                                            @if ($errors->has('name'))
                                                <span class="text-danger">{{ $errors->first('name') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="jabatan"
                                            class="col-md-4 col-form-label text-md-end text-start required-label">Jabatan</label>
                                        <div class="col-md-6">
                                            <input type="text" required
                                                class="form-control @error('jabatan') is-invalid @enderror" id="jabatan"
                                                name="jabatan" value="{{ Session::get('ownerSession.jabatan') }}">
                                            @if ($errors->has('jabatan'))
                                                <span class="text-danger">{{ $errors->first('jabatan') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="NIK"
                                            class="col-md-4 col-form-label text-md-end text-start required-label">NIK</label>
                                        <div class="col-md-6">
                                            <input type="text" required
                                                class="form-control @error('NIK') is-invalid @enderror" id="NIK"
                                                name="NIK" value="{{ Session::get('ownerSession.NIK') }}">
                                            @if ($errors->has('NIK'))
                                                <span class="text-danger">{{ $errors->first('NIK') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="NPWP"
                                            class="col-md-4 col-form-label text-md-end text-start required-label">NPWP</label>
                                        <div class="col-md-6">
                                            <input type="text" required
                                                class="form-control @error('NPWP') is-invalid @enderror" id="NPWP"
                                                name="NPWP" value="{{ Session::get('ownerSession.NPWP') }}"
                                                maxlength="15">
                                            @if ($errors->has('NPWP'))
                                                <span class="text-danger">{{ $errors->first('NPWP') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="phone_number"
                                            class="col-md-4 col-form-label text-md-end text-start required-label">No.
                                            HP</label>
                                        <div class="col-md-6">
                                            <input type="text" required
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                id="phone_number" name="phone_number"
                                                value="{{ Session::get('ownerSession.phone_number') }}">
                                            @if ($errors->has('phone_number'))
                                                <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" id="ownerCheckbox" name="ownerCheckbox"
                                            onchange="toggleFormFields(this)">
                                        <label for="ownerCheckbox">Penandatangan sama dengan penanggung jawab</label>
                                    </div>
                                    <br>
                                    <div id="additionalFields">
                                        <div class="form-group row">
                                            <label for="nama"
                                                class="col-md-4 col-form-label text-md-end text-start">Nama</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('nama') is-invalid @enderror" id="nama2"
                                                    name="nama2" value="{{ Session::get('ownerSession.nama') }}">
                                                @if ($errors->has('nama'))
                                                    <span class="text-danger">{{ $errors->first('nama') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="jabatan"
                                                class="col-md-4 col-form-label text-md-end text-start">Jabatan</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('jabatan') is-invalid @enderror"
                                                    id="jabatan2" name="jabatan2"
                                                    value="{{ Session::get('ownerSession.jabatan') }}">
                                                @if ($errors->has('jabatan'))
                                                    <span class="text-danger">{{ $errors->first('jabatan') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="NIK"
                                                class="col-md-4 col-form-label text-md-end text-start">NIK</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('NIK') is-invalid @enderror" id="NIK2"
                                                    name="NIK2" value="{{ Session::get('ownerSession.NIK') }}">
                                                @if ($errors->has('NIK'))
                                                    <span class="text-danger">{{ $errors->first('NIK') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="NPWP"
                                                class="col-md-4 col-form-label text-md-end text-start">NPWP</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('NPWP') is-invalid @enderror"
                                                    id="NPWP2" name="NPWP2"
                                                    value="{{ Session::get('ownerSession.NPWP') }}">
                                                @if ($errors->has('NPWP'))
                                                    <span class="text-danger">{{ $errors->first('NPWP') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="phone_number"
                                                class="col-md-4 col-form-label text-md-end text-start">Phone Number</label>
                                            <div class="col-md-6">
                                                <input type="text"
                                                    class="form-control @error('phone_number') is-invalid @enderror"
                                                    id="phone_number2" name="phone_number2"
                                                    value="{{ Session::get('ownerSession.phone_number') }}">
                                                @if ($errors->has('phone_number'))
                                                    <span class="text-danger">{{ $errors->first('phone_number') }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-secondary" onclick="goBack()">Kembali</button>
                                    <button type="submit" class="btn btn-primary float-right"
                                        name="">Berikutnya</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleFormFields(checkbox) {
            const additionalFields = document.getElementById("additionalFields");

            if (checkbox.checked) {
                additionalFields.style.display = "none";
            } else {
                additionalFields.style.display = "block";
            }
        }
    </script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script>
        const NPWP = document.getElementById("NPWP")
        NPWP.oninput = (e) => {
            e.target.value = autoFormatNPWP(e.target.value);
        }

        function autoFormatNPWP(NPWPString) {
            try {
                var cleaned = ("" + NPWPString).replace(/\D/g, "");
                var match = cleaned.match(/(\d{0,2})?(\d{0,3})?(\d{0,3})?(\d{0,1})?(\d{0,3})?(\d{0,3})$/);
                return [
                    match[1],
                    match[2] ? "." : "",
                    match[2],
                    match[3] ? "." : "",
                    match[3],
                    match[4] ? "." : "",
                    match[4],
                    match[5] ? "-" : "",
                    match[5],
                    match[6] ? "." : "",
                    match[6]
                ].join("")

            } catch (err) {
                return "";
            }
        }
    </script>
    <script>
        function toggleFormFields(checkbox) {
            const additionalFields = document.getElementById("additionalFields");
            const nameField = document.getElementById("name");
            const jabatanField = document.getElementById("jabatan");
            const NIKField = document.getElementById("NIK");
            const NPWPField = document.getElementById("NPWP");
            const phoneField = document.getElementById("phone_number");
    
            if (checkbox.checked) {
                additionalFields.style.display = "none";
            } else {
                additionalFields.style.display = "block";
            }
    
            // Lakukan pengisian otomatis jika checkbox dicentang
            if (checkbox.checked) {
                // Isi nilai-nilai pada field utama dengan nilai dari field tambahan
                nameField.value = document.getElementById("nama2").value;
                jabatanField.value = document.getElementById("jabatan2").value;
                NIKField.value = document.getElementById("NIK2").value;
                NPWPField.value = document.getElementById("NPWP2").value;
                phoneField.value = document.getElementById("phone_number2").value;
            } else {
                // Kembalikan nilai-nilai field utama ke nilai awal dari sesi
                nameField.value = "{{ Session::get('ownerSession.name') }}";
                jabatanField.value = "{{ Session::get('ownerSession.jabatan') }}";
                NIKField.value = "{{ Session::get('ownerSession.NIK') }}";
                NPWPField.value = "{{ Session::get('ownerSession.NPWP') }}";
                phoneField.value = "{{ Session::get('ownerSession.phone_number') }}";
            }
        }
    </script>
    
@endsection
