<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;



class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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

        if (Category::create($params)) {
            return redirect('admin/categories')->with('success', 'Category has been saved');
        }

        return redirect('admin/categories');
    }

    private function generateSlug($name)
    {
        // Implement your custom slug generation logic here
        // For example, you can remove spaces and convert to lowercase
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

        return view('admin.categories.form', compact('category', 'categories'));
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
}
