<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Repositories\Image\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{

    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }
    private function save(Category $category, CategoryRequest $request)
    {
        $validated = $request->validated();
        if($request->hasFile('image')){
            $category->image_path = $this->imageRepository->upload($request->image);
//            dd($category->image);
        }

        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->description = $request->description;
        $category->status = $request->status;
        $category->price = $request->price;
        $category->save();
    }

    public function index()
    {
        Gate::authorize('category.view-any');

        $categories = Category::with('parent')->paginate();
        return view('admin.categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        Gate::authorize('category.create');

        $category = new Category();
        $parents = Category::all();
        return view('admin.categories.create', [
            'category' => $category,
            'parents' => $parents,
        ]);
    }

    public function store(CategoryRequest $request)
    {
        Gate::authorize('category.create');

        $category = new Category();

        $this->save($category, $request);

        return redirect()->route('categories.index')->with('success', 'Category Added Successfully');
    }


    public function show($id)
    {
        Gate::authorize('category.view');

        $category = Category::findOrFail($id);

        return view('admin.categories.show');
    }


    public function edit($id)
    {
        Gate::authorize('category.update');

        $category = Category::findOrFail($id);
        $parents = Category::all();

        return view('admin.categories.edit', [
            'category' => $category,
            'parents' => $parents,
        ]);
    }


    public function update(CategoryRequest $request, $id)
    {
        Gate::authorize('category.update');

        $category = Category::findOrFail($id);

        $this->save($category, $request);

        return redirect()->route('categories.index')->with('success', "Category $category->id Updated Successfully");
    }


    public function destroy($id)
    {
        Gate::authorize('category.delete');

        $category = Category::findOrFail($id);
        $category->delete();

        Storage::disk('public')->delete($category->image_path);

        return redirect()->back()->with('success', "Category $category->name Deleted!");
    }
}
