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
            'logo' => 'required|mimes:pdf|max:2048',
            'banner' => 'required|mimes:pdf|max:2048',
            'ktp' => 'required|mimes:pdf|max:2048',
            'npwp' => 'required|mimes:pdf|max:2048',
            'aktaprb' =>'required|mimes:pdf|max:2048',
            'siup' => 'required|mimes:pdf|max:2048',
            'npwpbu' => 'required|mimes:pdf|max:2048',
            'nib' => 'required|mimes:pdf|max:2048',
            'skb' => 'required|mimes:pdf|max:2048',
            'bpt' => 'required|mimes:pdf|max:2048',
            'kbli' => 'required|mimes:pdf|max:2048',
            'tdp' => 'required|mimes:pdf|max:2048',
            'pkp' => 'required|mimes:pdf|max:2048'


        ]);
    
        if ($request->hasFile('logo')) {
            $logoFile = $request->file('logo');
            $logoFileName = 'logo_' . hash('sha256', time()) . '.' . $logoFile->getClientOriginalExtension();
            $logoPath = $logoFile->storeAs('uploads', $logoFileName, 'public');
            Session::push('uploaded_files', [
                'type' => 'logo',
                'path' => asset('storage/' . $logoPath),
                'name' => $logoFile->getClientOriginalName(),
            ]);
        }
    
        if ($request->hasFile('banner')) {
            $bannerFile = $request->file('banner');
            $bannerFilename = 'banner_' . hash('sha256', time()) . '.' . $bannerFile->getClientOriginalExtension();
            $bannerPath = $bannerFile->storeAs('uploads', $bannerFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'banner',
                'path' => asset('storage/' . $bannerPath),
                'name' => $bannerFile->getClientOriginalName(),
            ]);
        }

        if ($request->hasFile('ktp')) {
            $ktpFile = $request->file('ktp');
            $ktpFilename = 'ktp_' . hash('sha256', time()) . '.' . $ktpFile->getClientOriginalExtension();
            $ktpPath = $ktpFile->storeAs('uploads', $ktpFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'ktp',
                'path' => asset('storage/' . $ktpPath),
                'name' => $ktpFile->getClientOriginalName(),
            ]);
        }

        if ($request->hasFile('npwp')) {
            $npwpFile = $request->file('npwp');
            $npwpFilename = 'npwp_' . hash('sha256', time()) . '.' . $npwpFile->getClientOriginalExtension();
            $npwpPath = $npwpFile->storeAs('uploads', $npwpFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'npwp',
                'path' => asset('storage/' . $npwpPath),
                'name' => $npwpFile->getClientOriginalName(),
            ]);
        }

        if ($request->hasFile('aktaprb')) {
            $aktaprbFile = $request->file('aktaprb');
            $aktaprbFilename = 'aktaprb_' . hash('sha256', time()) . ' . ' . $aktaprbFile->getClientOriginalExtension();
            $aktaprbPath = $aktaprbFile->storeAs('uploads', $aktaprbFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'aktaprb',
                'path' => asset('storage/' . $aktaprbPath),
                'name' => $aktaprbFile->getClientOriginalName(),
            ]);
        }

        if($request->hasFile('siup')) {
            $siupFile = $request->file('siup');
            $siupFilename = 'siup_' . hash('sha256', time()) . ' . ' . $siupFile->getClientOriginalExtension();
            $siupPath = $siupFile->storeAs('uploads', $siupFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'siup',
                'path' => asset('storage/' . $siupPath),
                'name' => $siupFile->getClientOriginalName()
            ]);
        }

        if ($request->hasFile('npwpbu')) {
            $npwpbuFile = $request->file('npwpbu');
            $npwpbuFilename = 'npwpbu_' . hash('sha256', time()) . ' . ' .$npwpbuFile->getClientOriginalExtension();
            $npwpbuPath = $npwpbuFile->storeAs('uploads', $npwpbuFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'npwpbu',
                'path' => asset('storage/' . $npwpbuPath),
                'name' => $npwpFile->getClientOriginalName()
            ]);
        }

        if( $request->hasFile('nib')) {
            $nibFile = $request->file('nib');
            $nibFilename = 'nib_' . hash('sha256', time()) . ' . ' .$nibFile->getClientOriginalExtension();
            $nibPath = $nibFile->storeAs('uploads', $nibFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'nib',
                'path' => asset('storage/' . $nibPath),
                'name' => $nibFile->getClientOriginalName()
            ]);
        }

        if($request->hasFile('skb')) {
            $skbFile = $request->file('skb');
            $skbFilename  = 'skb_' . hash('sha256', time()) . ' . ' .$skbFile->getClientOriginalExtension();
            $skbPath = $skbFile->storeAs('uploads', $skbFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'skb',
                'path' => asset('storage/' . $skbPath),
                'name' => $skbFile->getClientOriginalName()
            ]);
        }

        if($request->hasFile('bpt')) {
            $bptFile = $request->file('bpt');
            $bptFilename  = 'bpt_' . hash('sha256', time()) . ' . ' .$bptFile->getClientOriginalExtension();
            $bptPath = $bptFile->storeAs('uploads', $bptFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'bpt',
                'path' => asset('storage/' . $bptPath),
                'name' => $bptFile->getClientOriginalName()
            ]);
        }

        if($request->hasFile('kbli')) {
            $kbliFile = $request->file('kbli');
            $kbliFilename  = 'kbli_' . hash('sha256', time()) . ' . ' .$kbliFile->getClientOriginalExtension();
            $kbliPath = $kbliFile->storeAs('uploads', $kbliFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'kbli',
                'path' => asset('storage/' . $kbliPath),
                'name' => $kbliFile->getClientOriginalName()
            ]);
        }
        if($request->hasFile('tdp')) {
            $tdpFile = $request->file('tdp');
            $tdpFilename  = 'tdp_' . hash('sha256', time()) . ' . ' .$tdpFile->getClientOriginalExtension();
            $tdpPath = $tdpFile->storeAs('uploads', $tdpFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'tdp',
                'path' => asset('storage/' . $tdpPath),
                'name' => $tdpFile->getClientOriginalName()
            ]);
        }

        if($request->hasFile('pkp')) {
            $pkpFile = $request->file('pkp');
            $pkpFilename = 'pkp_' . hash('sha256', time()) . ' . ' .$pkpFile->getClientOriginalExtension();
            $pkpPath = $pkpFile->storeAs('uploads', $pkpFilename, 'public');
            Session::push('uploaded_files', [
                'type' => 'pkp',
                'path' => asset('storage/' . $pkpPath),
                'name' => $pkpFile->getClientOriginalName()
            ]);
        }
    
        // dd(Session::get('uploaded_files'));
        dd(session('uploaded_files'));
    
        return redirect()->route('uploadFiles')->with('success', 'File berhasil diunggah.');
    }
    
}
