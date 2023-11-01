<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Sekolah;
use App\Models\UserAddress;
use App\Models\BankMpMapping;
use App\Models\MasterBank;

class BankMp extends Model
{
    use HasFactory;

    protected $table = 'bank_mp';

    protected $fillable =
    [
        'bank_id',
        'name',
        'number',
        'cabang',
        'status_id'
    ];

    public function bank()
    {
        return $this->belongsTo(MasterBank::class, 'bank_id');
    }

    public function status()
    {
        return $this->belongsTo(MasterBank::class, 'status_id');
    }

    public static function getBankAvailableBuyer()
    {
        $sekolahIdByUserLogin = Sekolah::getSekolahId();
        $userId = Auth::id();
        $userAddress = UserAddress::where('user_id', $userId)
            ->where('sekolah_id', $sekolahIdByUserLogin)
            ->first();
        $listBank = [];
        
        if ($userAddress) {
            $bankMapping = BankMpMapping::where('province_id', $userAddress->province_id)
                ->where('status_id', '1')
                ->get();
            
            foreach ($bankMapping as $bankMap) {
                $bankMpName = BankMp::where('id', $bankMap->bank_mp_id)->first();
                $bankMasterName = MasterBank::where('id', $bankMpName->bank_id)->first();
                
                $listBank[$bankMpName->id] = $bankMasterName->name; 
            }
        } else {
            $bankMasterName = MasterBank::where('id', '2')->first();
            $listBank['30'] = $bankMasterName->name; 
        }
    
        return $listBank;
    }
    

    public static function getBankAvailableBuyerSelected($id)
    {
        $listBank = [];

        $bankMpName = BankMp::where('id', $id)->first();
        $bankMasterName = MasterBank::where('id', $bankMpName->bank_id)->first();
        $listBank[] = [
            'id' => $bankMpName->id,
            'name' => $bankMasterName->name,
        ];

        $dataArrayMap = collect($listBank)->pluck('name', 'id')->toArray();

        return $dataArrayMap;
    }
}
