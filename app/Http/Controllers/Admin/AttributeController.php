<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Attribute;
use App\Models\AttributeOption;

use App\Http\Requests\AttributeOptionRequest;
use App\Http\Requests\AttributeRequest;

use Session;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     public function __construct()
    {

        $this->data['currentAdminMenu'] = 'catalog';
        $this->data['currentAdminSubMenu'] = 'attribute';

        $this->data['types'] = Attribute::types();
        $this->data['booleanOptions'] = Attribute::booleanOptions();
        $this->data['validations'] = Attribute::validations();
    }
    public function index()
    {
        $this->data['attributes'] = Attribute::orderBy('name', 'ASC')->paginate(10);
        return view('admin.attributes.index', $this->data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->data['attribute'] = null;
        
        return view('admin.attributes.form', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        $params = $request->except('_token');
        $params['is_required'] = (bool) $params['is_required'];
        $params['is_unique'] = (bool) $params['is_unique'];
        $params['is_configurable'] = (bool) $params['is_configurable'];
        $params['is_filterable'] = (bool) $params['is_filterable'];

        if (Attribute::create($params)) {
            Session::flash('success', 'Attribute has been saved');
        }

        return redirect('admin/attributes');
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
    public function edit(string $id)
    {
        $attribute = Attribute::findOrFail($id);

        $this->data['attribute'] = $attribute;
        
        return view('admin.attributes.form', $this->data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest  $request, string $id)
    {
        $params = $request->except('_token');
        $params['is_required'] = (bool) $params['is_required'];
        $params['is_unique'] = (bool) $params['is_unique'];
        $params['is_configurable'] = (bool) $params['is_configurable'];
        $params['is_filterable'] = (bool) $params['is_filterable'];

        unset($params['code']);
        unset($params['type']);

        $attribute = Attribute::findOrFail($id);

        if ($attribute->update($params)) {
            Session::flash('success', 'Attribute has been saved');
        }

        return redirect('admin/attributes');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attribute = Attribute::findOrFail($id);

        if ($attribute->delete()) {
            return redirect('admin/attributes')->with('success', 'Category has been deleted');
        }

        return redirect('admin/attributes');
    }

    public function options($attributeID)
    {
        if (empty($attributeID)) {
            return redirect('admin/attributes');
        }

        $attribute = Attribute::findOrFail($attributeID);
        $this->data['attribute'] = $attribute;

        return view('admin.attributes.options', $this->data);
    }

    public function store_option(AttributeOptionRequest $request, $attributeID)
    {
        if (empty($attributeID)) {
            return redirect('admin/attributes');
        }
        
        $params = [
            'attribute_id' => $attributeID,
            'name' => $request->get('name'),
        ];

        if (AttributeOption::create($params)) {
            Session::flash('success', 'option has been saved');
        }

        return redirect('admin/attributes/'. $attributeID .'/options');
    }

    public function edit_option($optionID)
    {
        $option = AttributeOption::findOrFail($optionID);

        $this->data['attributeOption'] = $option;
        $this->data['attribute'] = $option->attribute;

        return view('admin.attributes.options', $this->data);
    }

    public function update_option(AttributeOptionRequest $request, $optionID)
    {
        $option = AttributeOption::findOrFail($optionID);
        $params = $request->except('_token');

        if ($option->update($params)) {
            Session::flash('success', 'Option has been updated');
        }

        return redirect('admin/attributes/'. $option->attribute->id .'/options');
    }

    public function remove_option($optionID)
    {
        if (empty($optionID)) {
            return redirect('admin/attributes');
        }

        $option = AttributeOption::findOrFail($optionID);

        if ($option->delete()) {
            Session::flash('success', 'option has been deleted');
        }

        return redirect('admin/attributes/'. $option->attribute->id .'/options');
    }
}

