<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use PDF;

class AktivitasPenggunaSellerController extends Controller
{
    public function __construct()
    {
        $this->data['currentSellerMenu'] = 'aktivitaspenggunaSeller';
        $this->middleware('activity.logger');
    }

    public function index()
    {
        $this->data['activities'] = Activity::with('user')->get();
        return view('seller.Items.aktivitaspenggunaIndex', $this->data);
    }

    public function generatePDF()
    {
        $activities = Activity::with('user')->get();
        $pdf = PDF::loadHTML('<h1>Aktivitas Pengguna</h1>' . view('pdf.activities', compact('activities')))->setPaper('a4', 'landscape');
        return $pdf->download('activities.pdf');
    }
}
