<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Session;

class CategoriesController extends Controller
{
    public function index()
    {
        // load the view and send all the database data to the view
        // Todo: with (concat the view with data using a variable)
        return view('admin.categories.index')->with('categories', Category::all());
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        // saving inside the database
        // call the model set the params and and save
        $category = new Category();
        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'Successfully created a category');

        if ($request->type == "multiple") {
            return redirect()->back();
        } else {
            return redirect()->route('category.index');
        }


    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::find($id);

        return view('admin.categories.edit')->with('category', $category);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);

        $category = Category::find($id);
        $category->name = $request->name;
        $category->save();

        Session::flash('success', 'Successfully updated the category');

        return redirect()->route('category.index');
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        foreach ($category->posts as $post) {
            $post->forceDelete();
        }
        $category->delete();

        Session::flash('success', 'Successfully deleted the category');

        return redirect()->route('category.index');
    }
}
