@extends('seller.layout')

@section('content')
<!DOCTYPE html>
<html>
<head>
    <title>Pratinjau PDF</title>
</head>
<body>
    <h2>Pratinjau PDF</h2>
    <embed src="{{ route('previewPdf', ['file' => $uploadedFile]) }}" width="100%" height="500px" type="application/pdf">
</body>
</html>
@endsection
