<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProductCategory extends Model
{
    const CHECK_YES = 'YES';
    const CHECK_NO = 'NO';
    const CAT_ENABLE = '40';
    const CAT_DISABLE = '41';
    const DEFAULT_PARENT = '0';

    use HasFactory;

    protected $table = "product_category";

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'hierarchy',
        'hierarchy_name',
        'level',
        'status_id',
        'logo',
        'bash_logo',
        'descriptions',
        'type_category',
        'dikbud_type',
        'urut',
        'dikbud',
        'kat_agregasi'
    ];

    public static function getListHierarchy($sub = null)
    {
        if ($sub) {
            return ProductCategory::where('status_id', self::CAT_ENABLE)
                ->where('id', $sub)
                ->get();
        } else {
            return ProductCategory::where('status_id', self::CAT_ENABLE)
                ->where('parent_id', 0)
                ->get();
        }
    }

    public static function getListCategory($parent, $statusId = false)
    {
        $query = ProductCategory::where('parent_id', $parent);
        if ($statusId !== false) {
            $query->where('status_id', $statusId);
        }
        $categories = $query->orderBy('id')->get();
        $listCategory = $categories->pluck('name', 'id');

        return $listCategory;
    }

    public static function updateHierarchy($id)
    {
        $category = ProductCategory::find($id);
        $parentId = $category->parent_id;
        if ($parentId != 0) {
            $parentCategory = ProductCategory::find($parentId);
            $hierarchyParent = $parentCategory->hierarchy;

            $hierarchyParent .= '-' . $id;
        } else {
            $hierarchyParent = $id;
        }

        $category->hierarchy = $hierarchyParent;
        $category->save();
        return true;
    }

    public static function explodeHirarchy($id)
    {
        $category = ProductCategory::find($id);
        $explodeHirarchy = explode('-', $category->hierarchy);

        if ($explodeHirarchy) {
            $dataArr = [];

            foreach ($explodeHirarchy as $value) {
                $dataDetail = ProductCategory::find($value);
                $dataArr[] = $dataDetail->name;
            }

            $dataFinal = implode(' > ', $dataArr);
        } else {
            $dataFinal = $category->name;
        }

        return $dataFinal;
    }

    public static function getListHirarchy($sub = null)
    {
        if ($sub !== null) {
            $productCategory = ProductCategory::where('status_id', self::CAT_ENABLE)
                ->where('id', $sub)
                ->get();
        } else {
            $productCategory = ProductCategory::where('status_id', self::CAT_ENABLE)
                ->where('parent_id', self::DEFAULT_PARENT)
                ->get();
        }

        $listHirarchy = [];
        foreach ($productCategory as $category) {
            $explodeHierarchy = explode('-', $category->hierarchy);
            if ($explodeHierarchy) {
                $dataArr = [];
                foreach ($explodeHierarchy as $value) {
                    $dataDetail = ProductCategory::where('id', $value)->first();
                    $dataArr[] = $dataDetail->name;
                }

                $listHirarchy[$category->id] = implode(' > ', $dataArr);
            } else {
                $listHirarchy[$category->id] = $category->name;
            }
        }

        return $listHirarchy;
    }

    public static function getListHirarchySelected($id)
    {
        $productCategory = ProductCategory::where('id', $id)->get();
        $listHirarchy = [];
        foreach ($productCategory as $productCategory) {
            $explodeHirarchy = explode('-', $productCategory->hierarchy);
            if ($explodeHirarchy) {
                $dataArr = [];
                foreach ($explodeHirarchy as $value) {
                    $dataDetail = ProductCategory::where('id', $value)->first();
                    $dataArr[] = $dataDetail->name;
                }

                $listHirarchy[$productCategory->id] = implode(' > ', $dataArr);
            } else {
                $listHirarchy[$productCategory->id] = $productCategory->name;
            }
        }

        return $listHirarchy;
    }

    public static function deleteCategory($id)
    {
        DB::table('product_category')->where('id', $id)->delete();

        return true;
    }

    public static function checkCategoryAssignParent($id)
    {
        $model = ProductCategory::where('parent_id', $id)->first();

        if ($model) {
            return self::CHECK_YES;
        } else {
            return self::CHECK_NO;
        }
    }

    public static function getListHirarchyAddProduct()
    {
        $productCategories = ProductCategory::where('status_id', self::CAT_ENABLE)->limit(40)->get();

        $listHirarchy = [];
        foreach ($productCategories as $productCategory) {
            $explodeHierarchy = explode('-', $productCategory->hierarchy);
            if ($explodeHierarchy) {
                $dataArr = [];
                foreach ($explodeHierarchy as $value) {
                    $checkParent = ProductCategory::checkCategoryAssignParent($value);

                    if ($checkParent == self::CHECK_NO) {
                        $listShow = ProductCategory::where('id', $value)->first();
                        $explodeListShow = explode('-', $listShow->hierarchy);

                        foreach ($explodeListShow as $valueListShow) {
                            $listShowDetail = ProductCategory::where('id', $valueListShow)->first();
                            if (!empty($listShowDetail->name)) {
                                $dataArr[] = $listShowDetail->name;
                            }
                        }
                        $listHirarchy[$value] = implode(' > ', $dataArr);
                    }
                }
            }
        }

        return $listHirarchy;
    }

    public function uploadFile($catId, UploadedFile $logoUpload)
    {
        if ($logoUpload->isValid()) {
            $directory = '/source/category/' . $catId . '#' . now()->format('Y-m-d');
            $directoryPlace = storage_path('app/public') . $directory;

            $component = 'fileStorage';
            $createdAt = now();
            $uploadIp = request()->ip();

            $storelogoUpload = storage_path('app/public') . $directory;
            $storeFileBaseUrllogoUpload = Storage::url($directory);
            $storeFileExtensionlogoUpload = $logoUpload->extension();
            $storeFileSizelogoUpload = $logoUpload->getSize();
            $storeFileTypelogoUpload = $logoUpload->getClientMimeType();
            $storeFileNamelogoUpload = Str::random();
            $pathlogoUpload = $storelogoUpload . '/' . $storeFileNamelogoUpload . '.' . $storeFileExtensionlogoUpload;
            $bashUrllogoUpload = $storeFileBaseUrllogoUpload . '/' . $storeFileNamelogoUpload . '.' . $storeFileExtensionlogoUpload;

            $bashUrlSistemLogoUpload = $directory . '/' . $storeFileNamelogoUpload . '.' . $storeFileExtensionlogoUpload;
            $pathSistemLogoUpload = storage_path('app/public');

            $this->insertStorageItem(
                $component,
                $bashUrlSistemLogoUpload,
                $pathSistemLogoUpload,
                $storeFileTypelogoUpload,
                $storeFileSizelogoUpload,
                $storeFileNamelogoUpload,
                $uploadIp,
                $createdAt
            );

            Storage::disk('public')->makeDirectory($directory);
            $logoUpload->move($storelogoUpload, $storeFileNamelogoUpload . '.' . $storeFileExtensionlogoUpload);

            $productCategory = ProductCategory::find($catId);
            $productCategory->logo = $pathlogoUpload;
            $productCategory->bash_logo = $bashUrllogoUpload;
            $productCategory->save();

            return true;
        }

        return false;
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
        $query = self::query()
            ->where('status_id', self::CAT_ENABLE);

        if ($category === false) {
            $query->where('parent_id', 0)
                ->orderBy('urut');
        } else {
            $query->where('parent_id', $category)
                ->orderBy('urut');
        }

        return $query->get();
    }

    public static function getListCategoryNavOne($category)
    {
        return self::where('id', $category)
            ->orderBy('urut')
            ->first();
    }

    public static function getListTipeKategori()
    {
        return MasterStatus::where('label_status', MasterStatus::TYPE_CATEGORY)
            ->orderBy('id')
            ->pluck('name', 'id');
    }

    public static function getListKategori($categoryType)
    {
        $productCategories = ProductCategory::where('status_id', self::CAT_ENABLE)
            ->where('type_category', $categoryType)
            ->limit(40)
            ->get();

        $listHierarchy = [];

        foreach ($productCategories as $productCategory) {
            $explodeHierarchy = explode('-', $productCategory->hierarchy);

            if ($explodeHierarchy) {
                $dataArr = [];

                foreach ($explodeHierarchy as $key => $value) {
                    $checkParent = self::checkCategoryAssignParent($value);

                    if ($checkParent == self::CHECK_NO) {
                        $listShow = ProductCategory::where('id', $value)->first();
                        $explodeListShow = explode('-', $listShow->hierarchy);

                        foreach ($explodeListShow as $keyListShow => $valueListShow) {
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
        $productCategories = ProductCategory::where('status_id', self::CAT_ENABLE)
            ->where('parent_id', $categoryType)
            ->orderBy('urut', 'ASC')
            ->get();

        $dataFix = [];

        foreach ($productCategories as $productCategory) {
            $dataFix[] = [
                'id' => $productCategory->id,
                'name' => $productCategory->name,
            ];
        }

        return $dataFix;
    }
}
