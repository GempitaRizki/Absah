<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\ProductCategory;

class UpdateParentIdsCommand extends Command
{
    protected $signature = 'update:parent-ids';
    protected $description = 'Update parent_ids for "Barang" and "Jasa" categories';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $productCategoryBarang = ProductCategory::where('name', 'Barang')->first();
        $productCategoryJasa = ProductCategory::where('name', 'Jasa')->first();

        if ($productCategoryBarang) {
            $productCategoryBarang->parent_id = 1;
            $productCategoryBarang->save();
        }

        if ($productCategoryJasa) {
            $productCategoryJasa->parent_id = 2;
            $productCategoryJasa->save();
        }

        $this->info('parent_ids updated for "Barang" and "Jasa".');
    }
}
