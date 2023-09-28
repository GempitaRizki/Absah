@extends('seller.layout')

@section('content')
<div class="checkbox">
  <label>
    <input type="checkbox" id="chk"> Want to choose another picture?
  </label>
</div>

<div class="form-group" id="file-input" style="display:none;">
<label for="exampleInputFile">Choose main image</label>
 <input type="file" id="exampleInputFile">
 <p class="help-block">This will be your thumbnail image</p>
</div>
<script>
document.getElementById('chk').onchange = function(){
  if(this.checked) {document.getElementById('file-input').style.display='block';
  //more js statements
  }
  else {document.getElementById('file-input').style.display='none';
  //more js statements
  }
}
</script>
@endsection
