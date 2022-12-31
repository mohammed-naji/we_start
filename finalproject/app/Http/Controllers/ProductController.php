<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Gate::authorize('show-products');
        $products = Product::latest('id')->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::select(['id', 'name'])->get();
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // // $checked = $request->input('input-quantity', 0);

        // dd($request->all());

        $slug = Str::slug($request->en_name);

        $count = Product::whereSlug($slug)->count();
        $slug = $slug.'-'.$count;
        // dd($ex);

        DB::beginTransaction();

        try {
            $product = Product::create([
                'name' => '',
                'slug' => $slug,
                'smalldesc' => '',
                'desc' => '',
                'price' => $request->price,
                'quantity' => $request->quantity,
                'category_id' => $request->category_id,
                'featured' => $request->input('featured', 0)
            ]);

            if($request->hasFile('image')) {
                $image = $request->file('image')->store('uploads/products', 'custom');
                $product->gallery()->create([
                    'path' => $image,
                    'feature' => 1
                ]);
            }

            if($request->has('album')) {
                foreach($request->album as $file) {
                    $product->gallery()->create([
                        'path' => $file,
                        'feature' => 0
                    ]);
                }
            }

            if($request->has('variation')) {
                foreach($request->variation as $type => $data) {
                    foreach($data as $info) {
                        $product->variations()->create([
                            'type' => $type,
                            'value' => $info['value'],
                            'extraprice' => $info['price']
                        ]);
                    }
                }
            }

            DB::commit();
        }catch(Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

        return redirect()->route('admin.products.index')->with('msg', 'Product created successfullly')->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::select(['id', 'name'])->get();
        $product = $product->load('image', 'category', 'gallery', 'variations');
        return view('admin.products.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }

    public function add_image(Request $request)
    {
        return $request->file('file')->store('/uploads/products', 'custom');
    }
}
