<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Category;
use App\Models\Dimension;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductDimension;
use App\Repositories\Image\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Throwable;

class ProductsController extends Controller
{

    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    private function save(Product $product, ProductRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $product->image = $this->imageRepository->upload($request->image);
        }

        $category = Category::find($request->category_id);

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->category_data = $category;
        $product->description =$request->description;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->status = $request->status;
        $product->save();

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('product.view-any');
        $products = Product::with(['category'])->simplePaginate(10);
        return view('admin.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('product.create');
        $product = new Product();
        $categories = Category::all();

        return view('admin.products.create', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        Gate::authorize('product.create');

        $product = new Product();

        $this->save($product, $request);
        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Gate::authorize('product.update');

        $product = Product::findOrFail($id);
        $categories = Category::all();


        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        Gate::authorize('product.update');

        $product = Product::findOrFail($id);

        $this->save($product, $request);

        return redirect()->route('products.index')->with('success', "Product $product->name Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gate::authorize('product.delete');

        $product = Product::findOrFail($id);

        $product->delete();

        // Storage::disk('uploads')->delete($product->image);

        return redirect()->back()->with('success', "Product $product->name Deleted!");
    }
}
