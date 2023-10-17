<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Str;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';

    protected $fillable = [
        'name', 'slug', 'parent_id', 'hierarchy', 'hierarchy_name', 'level', 'status_id',
        'logo', 'bash_logo', 'descriptions', 'type_category', 'dikbud_type',
        'urut', 'dikbud', 'kat_agregasi',
    ];

    public static function checkCategoryAssignParent($id)
    {
        $model = ProductCategory::where('parent_id', $id)->first();

        if ($model) {
            $data = 'YES';
        } else {
            $data = 'NO';
        }

        return $data;
    }

    public static function getListCategory($parent, $statusId = false)
    {
        $query = DB::table('product_category')
            ->where('parent_id', $parent)
            ->orderBy('id')
            ->get();

        $listCategory = [];
        foreach ($query as $category) {
            $listCategory[$category->id] = $category->name;
        }

        return $listCategory;
    }

    public static function updateHierarchy($id)
    {
        $model = ProductCategory::find($id);
        $parentId = $model->parent_id;

        if ($parentId != 0) {
            $modelParent = ProductCategory::where('id', $parentId)->first();
            $hierarchyParent = $modelParent->hierarchy . '-' . $id;
        } else {
            $hierarchyParent = $id;
        }

        $model->hierarchy = $hierarchyParent;
        $model->save();

        return true;
    }

    public static function explodeHirarchy($id)
    {
        $data = ProductCategory::where('id', $id)->first();
        $explodeHirarchy = explode('-', $data->hierarchy);
        if ($explodeHirarchy) {
            $dataArr = [];
            foreach ($explodeHirarchy as $value) {
                $dataDetail = ProductCategory::where('id', $value)->first();
                $dataArr[] = $dataDetail->name;
            }

            $dataFinal = implode(' > ', $dataArr);
        } else {
            $dataFinal = $data->name;
        }

        return $dataFinal;
    }

    public static function getListHirarchy($sub = 'null')
    {
        if ($sub != 'null') {
            $productCategory = ProductCategory::where('status_id', '40')->where('id', $sub)->get();
        } else {
            $productCategory = ProductCategory::where('status_id', '40')->where('parent_id', '0')->get();
        }

        $listHierarchy = [];
        foreach ($productCategory as $category) {
            $explodeHierarchy = explode('-', $category->hierarchy);
            if ($explodeHierarchy) {
                $dataArr = [];
                foreach ($explodeHierarchy as $value) {
                    $dataDetail = ProductCategory::where('id', $value)->first();
                    $dataArr[] = $dataDetail->name;
                }

                $listHierarchy[$category->id] = implode(' > ', $dataArr);
            } else {
                $listHierarchy[$category->id] = $catinfoegory->name;
            }
        }

        return $listHierarchy;
    }

    public static function getListHirarchySelected($id)
    {
        $productCategory = ProductCategory::where('id', $id)->get();
        $listHierarchy = [];
        foreach ($productCategory as $category) {
            $explodeHierarchy = explode('-', $category->hierarchy);
            if ($explodeHierarchy) {
                $dataArr = [];
                foreach ($explodeHierarchy as $value) {
                    $dataDetail = ProductCategory::where('id', $value)->first();
                    $dataArr[] = $dataDetail->name;
                }

                $listHierarchy[$category->id] = implode(' > ', $dataArr);
            } else {
                $listHierarchy[$category->id] = $category->name;
            }
        }

        return $listHierarchy;
    }

    public static function deleteCategory($id)
    {
        DB::table('product_category')
            ->where('id', $id)
            ->delete();

        return true;
    }

    public static function getListHirarchyAddProduct()
    {
        $productCategory = ProductCategory::where('status_id', '40')->limit(40)->get();

        $listHierarchy = [];
        foreach ($productCategory as $category) {
            $explodeHierarchy = explode('-', $category->hierarchy);
            if ($explodeHierarchy) {
                $dataArr = [];
                foreach ($explodeHierarchy as $value) {
                    $checkParent = ProductCategory::checkCategoryAssignParent($value);

                    if ($checkParent == 'NO') {
                        $listShow = ProductCategory::where('id', $value)->first();
                        $explodeListShow = explode('-', $listShow->hierarchy);

                        foreach ($explodeListShow as $valueListShow) {
                            $listShowDetail = ProductCategory::where('id', $valueListShow)->first();
                            if (!empty($listShowDetail->name)) {
                                $dataArr[] = $listShowDetail->name;
                            }
                        }

                        $listHierarchy[$value] = implode(' > ', $dataArr);
                    }
                }
            }
        }

        return $listHierarchy;
    }

    public function uploadFile($catId)
    {
        if ($this->validate()) {
            $directory = '/source/category/' . $catId . '#' . date('Y-m-d');
            $directoryPlace = storage_path('app/public') . '/source/category/' . $catId . '#' . date('Y-m-d');

            $createdAt = now();
            $uploadIp = request()->ip();
            $storelogoUpload = storage_path('app/public') . $directory;
            $storeFileBaseUrllogoUpload = 'storage/source/category/' . $catId . '#' . date('Y-m-d');
            $storeFileExtensionlogoUpload = $this->logoUpload->extension();
            $storeFileSizelogoUpload = $this->logoUpload->getSize();
            $storeFileTypelogoUpload = $this->logoUpload->getMimeType();
            $storeFileNamelogoUpload = str_random(40);
            $pathlogoUpload = $storelogoUpload . '/' . $storeFileNamelogoUpload . '.' . $storeFileExtensionlogoUpload;
            $BashUrllogoUpload = $storeFileBaseUrllogoUpload . '/' . $storeFileNamelogoUpload . '.' . $storeFileExtensionlogoUpload;

            $bashUrlSistemLogoUpload = $directory . '/' . $storeFileNamelogoUpload . '.' . $storeFileExtensionlogoUpload;
            $pathSistemLogoUpload = storage_path('app/public') . '/source/category/' . $catId . '#' . date('Y-m-d');

            $this->insertStorageItem(
                'fileStorage',
                $bashUrlSistemLogoUpload,
                $pathSistemLogoUpload,
                $storeFileTypelogoUpload,
                $storeFileSizelogoUpload,
                $storeFileNamelogoUpload,
                $uploadIp,
                $createdAt
            );

            if (!file_exists($storelogoUpload)) {
                mkdir($storelogoUpload, 0775, true);
            }

            $this->logoUpload->move($storelogoUpload, $storeFileNamelogoUpload . '.' . $storeFileExtensionlogoUpload);

            ProductCategory::where('id', $catId)->update([
                'logo' => $pathlogoUpload,
                'bash_logo' => $BashUrllogoUpload,
            ]);

            return true;
        }
    }

    public function insertStorageItem($component, $baseUrl, $path, $type, $size, $name, $uploadIp, $createdAt)
    {
        DB::table('file_storage_item')->insert([
            'component' => $component,
            'base_url' => $baseUrl,
            'path' => $path,
            'type' => $type,
            'size' => $size,
            'name' => $name,
            'upload_ip' => $uploadIp,
            'created_at' => $createdAt,
        ]);

        return true;
    }

    public static function getListCategoryNav($category = false)
    {
        if ($category == false) {
            $model = ProductCategory::where('parent_id', '0')
                ->where('status_id', '40')
                ->orderBy('urut', 'asc')
                ->get();
        } else {
            $model = ProductCategory::where('parent_id', $category)
                ->where('status_id', '40')
                ->orderBy('urut', 'asc')
                ->get();
        }

        return $model;
    }

    public static function getListCategoryNavOne($category)
    {
        $model = ProductCategory::where('id', $category)
            ->orderBy('urut', 'asc')
            ->first();

        return $model;
    }

    public static function getListTipeKategori()
    {
        $listTipeKategori = DB::table('master_status')
            ->where('label_status', 'TYPE_CATEGORY')
            ->orderBy('id')
            ->pluck('name', 'id')
            ->toArray();

        return $listTipeKategori;
    }

    public static function getListKategori($categoryType)
    {
        $productCategory = ProductCategory::where('status_id', '40')
            ->where('type_category', $categoryType)
            ->limit(40)
            ->get();

        $listHierarchy = [];
        foreach ($productCategory as $category) {
            $explodeHierarchy = explode('-', $category->hierarchy);
            if ($explodeHierarchy) {
                $dataArr = [];
                foreach ($explodeHierarchy as $value) {
                    $checkParent = ProductCategory::checkCategoryAssignParent($value);
                    if ($checkParent == 'NO') {
                        $listShow = ProductCategory::where('id', $value)->first();
                        $explodeListShow = explode('-', $listShow->hierarchy);
                        foreach ($explodeListShow as $valueListShow) {
                            $listShowDetail = ProductCategory::where('id', $valueListShow)->first();
                            if (!empty($listShowDetail->name)) {
                                $dataArr[] = $listShowDetail->name;
                            }
                        }
                        $listHierarchy[$value] = implode(' > ', $dataArr);
                    }
                }
            }
        }

        $dataFix = [];
        foreach ($listHierarchy as $key => $listHierarchy) {
            $dataFix[] = [
                'id' => $key,
                'name' => $listHierarchy,
            ];
        }

        return $dataFix;
    }

    public static function getListKategoriNew($categoryType)
    {
        $productCategory = ProductCategory::where('status_id', '40')
            ->where('parent_id', $categoryType)
            ->orderBy('urut', 'asc')
            ->get();

        $dataFix = [];
        foreach ($productCategory as $key) {
            $dataFix[] = [
                'id' => $key->id,
                'name' => $key->name,
            ];
        }

        return $dataFix;
    }
}
