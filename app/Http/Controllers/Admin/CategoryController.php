<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Category;
use App\Rules\alpha_spaces;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $categories = Category::all();
        $this->adminTemplate('category.index', __('Category'), ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->adminTemplate('category.add', __('Add Category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
         $request->validate([
            'name' => ['required', new alpha_spaces, 'unique:categories', 'min:2', 'max:255'],
        ]);
        $category = new Category;
        $category->name = $request->post('name');
        if (!$category->save()) {
            return redirect()->route('admin.category.index')->with('Error', __('an error occurred'));
        }
        return redirect()->route('admin.category.index')->with('Success', __('Add success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $category = Category::find($id);

        if ($category == null) {
            return redirect()->route('admin.category.index')->with('Error', __('Not Fond') . ' ' . __('Category'));
        } else {
            $this->adminTemplate('category.edit', __('Edit Category'), [
                'category' => $category,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'name' => ['required', new alpha_spaces, 'unique:categories,id,' . $id, 'min:2', 'max:255'],

        ]);
        $category = Category::find($id);
        $category->name = $request->post('name');
        if (!$category->save()) {
            return redirect()->route('admin.category.index')->with('Error', __('an error occurred'));
        }
        return redirect()->route('admin.category.index')->with('Success', __('Edit success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $category = Category::find($id);
        if ($category == null) {
            return redirect()->route('admin.category.index')->with('Error', __('Not Fond') . ' ' . __('category'));
        }
        if ($category->groups()->get() == null) {
            return redirect()->route('admin.category.index')->with('Error', __('It cannot be deleted because it is related to something else'));
        }
        $category->delete();
        return redirect()->route('admin.category.index')->with('Success', __('delete success'));
    }
}
