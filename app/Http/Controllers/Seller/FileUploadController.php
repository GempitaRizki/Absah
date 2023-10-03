<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StoreFile;
use Illuminate\Support\Facades\Session;

class FileUploadController extends Controller
{
    public function index()
    {
        return view('seller.file-upload');
    }
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:2048',
            'file_type' => 'required'
        ]);
    
        $uploadedFiles = session('uploaded_files', []);
    
        if ($request->hasFile('file')) {
            $uploadedFile = $request->file('file');
            $filename = $request->input('file_type') . '.' . $uploadedFile->getClientOriginalExtension();
            $filePath = $uploadedFile->storeAs('uploads', $filename, 'public');
            $uploadedFiles[$request->input('file_type')] = [
                'type' => $request->input('file_type'),
                'path' => asset('storage/' . $filePath),
                'name' => $request->input('file_type') . '.' . $uploadedFile->getClientOriginalExtension(),
            ];
        }
    
        session(['uploaded_files' => $uploadedFiles]);
    
        return redirect()->route('uploadFiles')->with('success', 'File berhasil diunggah.');
    }
    

    public function deleteFile($type)
    {
        $uploadedFiles = session('uploaded_files');

        if (isset($uploadedFiles[$type])) {
            unset($uploadedFiles[$type]);
            session(['uploaded_files' => $uploadedFiles]);

            return redirect()->back()->with('success', 'File berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'File tidak ditemukan.');
    }
}
