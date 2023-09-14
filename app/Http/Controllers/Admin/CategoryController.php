<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CategoryImageRequest;
// use App\Authorizable;



class CategoryController extends Controller
{

    public function __construct() {

        $this->data['currentAdminMenu'] = 'catalog';
        $this->data['currentAdminSubMenu'] = 'category';
    }
    
    public function index()
    {
        $this->data['categories'] = Category::orderBy('name', 'ASC')->paginate(10);

        return view('admin.categories.index', $this->data);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name', 'asc')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = null;

        return view('admin.categories.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $params = $request->except('_token');
        $params['slug'] = $this->generateSlug($params['name']);
        $params['parent_id'] = (int) $params['parent_id'];
        // $category = Category::create($params);//class test Gempita

        if (Category::create($params)) {
            return redirect('admin/categories')->with('success', 'Category has been saved');
        }

        return redirect('admin/categories');
    }

    private function generateSlug($name)
    {
  
        return str_replace(' ', '-', strtolower($name));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $categories = Category::where('id', '!=', $id)->orderBy('name', 'asc')->get();

        $this->data['categories'] = $categories->toArray();
        $this->data['category'] = $category;
        return view('admin.categories.form', $this->data);
    }

    public function update(CategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $params = $request->except('_token');
        $params['slug'] = $this->generateSlug($params['name']);
        $params['parent_id'] = (int) $params['parent_id'];

        $category->update($params);

        return redirect('admin/categories')->with('success', 'Category has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        if ($category->delete()) {
            return redirect('admin/categories')->with('success', 'Category has been deleted');
        }

        return redirect('admin/categories');
    }

    public function images($id)
    {
        if(empty($id)) {
            return redirect('admin/categories/create');

            $category = Category::findOrFail($id);

            $this->data['CategoryID'] = $category->id;
            $this->data['category'] = $category;

            return view('admin.categories.images', $this->data);
        }
    }
    
    public function add_image($id)
    {
        if(empty($id)) {
            return redirect('admin/categories');

            $category = Category::findOrFal($id);

            $this->data['CategoryID'] = $category->id;
            $this->data['category'] = $category;


            return view('admin.categories.image_form', $this->data);

        }

    }

    // public function upload_image(CategoryImageRequest $request, $id )
    // {
    //     $category = Category::findOrFail($id);

    // }

}
