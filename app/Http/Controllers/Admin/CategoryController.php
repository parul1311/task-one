<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $length = 10;
        if($request->get('length'))
        $length = $request->get('length');
        $categories = Category::query();

        if($request->get('search'))
            $categories->where('name','like','%'.$request->get('search').'%');
                
        if($request->get('parent_id'))
            $categories->where('parent_id',$request->get('parent_id'));
        else
            $categories->where('parent_id',null);

        $categories = $categories->withCount('subCategories')->paginate($length);
        return  view('admin.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = new Category();
        $categories = Category::all();
        return  view('admin.categories.save',compact('category','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = [
            'name' => 'required|string',
            'parent_id' => 'nullable',
            'status' => 'requied|in:Active,Inactive',
        ];
        $category = Category::updateOrCreate(
            ['id' => $request->id],
            [
                'name' => $request->name,
                'parent_id' => $request->parent_id,
                'status' => $request->status,
            ]);
        return redirect()->route('admin.categories.index')->with('success','category saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id 
     * 
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if($id)
          $categories =  Category::with('subCategories')->withCount('subCategories')->where('id',$id)->get();
        else
        $categories =  Category::with('subCategories')->withCount('subCategories')->where('parent_id',null)->get();
        
        return  view('admin.categories.show',compact('categories','id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return  view('admin.categories.save',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if($category){
            if($category->subCategories()->count() > 0)
                return back()->with('error','This category have '.$category->subCategories()->count().' sub categories! Please delete child category first.');
            $category->delete();
        }
        return back()->with('success','category deleted successfully');
    }
}
