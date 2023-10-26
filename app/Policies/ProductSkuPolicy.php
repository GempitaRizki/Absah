<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ProductSku;

class ProductSkuPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function view(User $user, ProductSku $productSku)
    {
        return $user->id === $productSku->created_by;
    }
    
}
