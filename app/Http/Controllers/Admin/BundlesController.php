<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bundle;
use App\Repositories\Image\ImageRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class BundlesController extends Controller
{

    protected $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    private function save(Bundle $bundle, Request $request)
    {
        $request->validate([
            'name' => 'string|required|max:255',
            'description' => 'string|required|max:255',
            'price' => 'integer|required|min:1',
            'image' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $bundle->image = $this->imageRepository->upload($request->image);
        }


        $bundle->name = $request->name;
        $bundle->description = $request->description;
        $bundle->price = $request->price;
        $bundle->save();

    }

    public function index()
    {
        Gate::authorize('product.view-any');
        $bundles = Bundle::simplePaginate(10);
        return view('admin.bundles.index', [
            'bundles' => $bundles,
        ]);
    }


    public function create()
    {
        Gate::authorize('bundle.create');
        $bundle = new Bundle();

        return view('admin.bundles.create', [
            'bundle' => $bundle,
        ]);
    }


    public function store(Request $request)
    {
        Gate::authorize('bundle.create');

        $bundle = new Bundle();

        $this->save($bundle, $request);
        return redirect()->route('bundles.index')->with('success', 'Bundle Added Successfully');
    }


    public function edit($id)
    {
        Gate::authorize('bundle.update');
        $bundle = Bundle::findOrFail($id);
        return view('admin.bundles.edit', [
            'bundle' => $bundle,
        ]);
    }


    public function update(Request $request, $id)
    {
        Gate::authorize('bundle.update');

        $bundle = Bundle::findOrFail($id);

        $this->save($bundle, $request);

        return redirect()->route('bundles.index')->with('success', "Bundle $bundle->name Updated Successfully!");
    }


    public function destroy($id)
    {
        Gate::authorize('bundle.delete');

        $bundle = Bundle::findOrFail($id);

        $bundle->delete();

        // Storage::disk('uploads')->delete($bundle->image);

        return redirect()->back()->with('success', "Bundle $bundle->name Deleted!");
    }
}
