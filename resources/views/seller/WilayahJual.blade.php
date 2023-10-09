@extends('seller.topbar')

@section('content')
    <div class="container mt-5" style="margin-bottom: 100px;">
        <form method="POST" action="{{ route('WilayahJual-Store') }}">
            @csrf
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <h3 class="center">Wilayah Jual</h3>
                        <hr>
                        <div class="panel-body container-items">
                            <div class="item panel panel-default">
                                <div class="selected_wilayahjual">
                                    <select name="kategori_product" id="kategori_product">
                                        <option value="Nasional">Nasional</option>
                                        <option value="Regional">Regional</option>
                                    </select>
                                </div>
                                <br>
                                <div class="panel-body">
                                    <!-- Hidden input to store selected districts -->
                                    <input type="hidden" name="districts[]">
                                    <div class="selected-districts">
                                        <div class="selected-district-names"></div>
                                    </div>
                                    <input type="hidden" name="district_ids[]" class="selected-district-ids">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <!-- Some content here -->
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row showKota">
                                        <div class="col-sm-12">
                                            <p><b>Districts</b></p>
                                            <select name="districts[]" class="form-control form-control-lg" multiple
                                                id="districtSelect" size="5" style="height: 200px; font-size: 16px;">
                                                @foreach ($districts as $district)
                                                    <option value="{{ $district->id }}">{{ $district->name }}</option>
                                                @endforeach
                                            </select>
                                            <br>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-secondary" onclick="goBack()">Kembali</button>
                    <button type="submit" class="btn btn-primary float-right">Simpan & Lanjutkan</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script>
        jQuery(document).ready(function($) {
            var selectedDistrictsCount = 0;

            $('#addDistrictButton').on('click', function() {
                var newItem = $('.item.panel.panel-default').first().clone();

                newItem.find('select[name^="districts"]').val([]);
                newItem.find('input[name^="districts[]"]').val('');

                var panelTitle = newItem.find('.panel-title-address');
                var panelTitleText = panelTitle.text();
                panelTitleText = panelTitleText.replace(/(\d+)/, function(match) {
                    return parseInt(match) + 1;
                });
                panelTitle.text(panelTitleText);

                newItem.find('.selected-districts').html('');

                $('.container-items').append(newItem);

                selectedDistrictsCount++;

                $('#totalSelectedDistricts').text(selectedDistrictsCount);

                var districtSelect = newItem.find('select[name^="districts[]"]');
                districtSelect.empty();
                @foreach ($districts as $district)
                    districtSelect.append($('<option>', {
                        value: '{{ $district->id }}',
                        text: '{{ $district->name }}'
                    }));
                @endforeach

                districtSelect.selectpicker('refresh');
            });

            $('.container-items').on('click', '.remove-item', function() {
                $(this).closest('.item.panel.panel-default').remove();
                selectedDistrictsCount--;
                $('#totalSelectedDistricts').text(selectedDistrictsCount);

                updateSelectedDistrictNames();
            });

            $('.container-items').on('change', 'select[name^="districts[]"]', function() {
                updateSelectedDistrictNames($(this));
            });

            function updateSelectedDistrictNames(selectElement) {
                var selectedValues = selectElement.val();
                var selectedDistrictNames = [];
                var selectedDistrictIds = [];

                if (selectedValues) {
                    selectedValues = selectedValues.filter(function(value) {
                        return value !== null;
                    });

                    $.each(selectedValues, function(index, value) {
                        var districtName = selectElement.find('option[value="' + value + '"]').text();
                        selectedDistrictNames.push(districtName);
                        selectedDistrictIds.push(value);
                    });
                }

                selectElement.closest('.item.panel.panel-default').find('.selected-district-names').html(
                    '<b>Districts yang Dipilih:</b> ' + selectedDistrictNames.join(', '));

                selectElement.closest('.item.panel.panel-default').find('.selected-district-ids').val(
                    selectedDistrictIds);
            }

            updateSelectedDistrictNames($('select[name^="districts[]"]'));

            $('.selected_wilayahjual select').change(function() {
                var selectedValue = $(this).val();
                $('#kategori_product').val(selectedValue);
            });
        });
    </script>
@endsection
