<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the products.
     */
    public function index()
    {
        $products = Product::all();
        return view('c1he3f.my-products', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('c1he3f.add-products');
    }

    /**
     * Store a newly created product in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string', // جعل الوصف nullable إذا كان غير إلزامي
            'base_price' => 'required|numeric|min:0',
            'payment_gateway_fee' => 'nullable|numeric|min:0', // جعل هذا الحقل nullable في الـ validation
            'selling_price' => 'required|numeric|min:0',
            'type' => 'required|in:physical,digital',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'required|boolean', // 👈 إضافة التحقق من حقل is_active
            
            'digital_file_path' => 'nullable|file|mimes:pdf,mp4,mp3,mov,avi,flv,wmv,ogg,wav|max:204800', // 👈 للتعامل مع الملفات الرقمية (بحد أقصى 200 ميجابايت كمثال)
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        $digitalFilePath = null;
        // قم بتغيير '$request->hasFile('digital_file')' إلى '$request->hasFile('digital_file_path')' هنا
        if ($request->type === 'digital' && $request->hasFile('digital_file_path')) {
            // وقم بتغيير '$request->file('digital_file')' إلى '$request->file('digital_file_path')' هنا
            $digitalFilePath = $request->file('digital_file_path')->store('digital_products', 'public');
        }


        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'base_price' => $request->base_price,
            'payment_gateway_fee' => $request->payment_gateway_fee ?? 0.00,
            'selling_price' => $request->selling_price,
            'type' => $request->type,
            'image_path' => $imagePath,
            'digital_file_path' => $digitalFilePath,
            'is_active' => $request->is_active, // 👈 إضافة حقل is_active
        ]);

        return redirect()->route('c1he3f.my-products')->with('success', 'تم إضافة المنتج بنجاح!');
    }


    /**
     * Display the specified product.
     */
    public function show(Product $product)
    {
        return view('c1he3f.view-product', compact('product'));
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit(Product $product)
    {
        return view('c1he3f.edit-product', compact('product'));
    }

    /**
     * Update the specified product in storage.
     */
    public function update(Request $request, Product $product)
    {
        // 1. Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'payment_gateway_fee' => 'nullable|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            
            'type' => 'required|in:physical,digital',
            'is_active' => 'required|boolean',
            // Image is not required on update, only if a new one is provided
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // Digital file is nullable, but required if type changes to digital and no existing file
            'digital_file_path' => 'nullable|file|mimes:pdf,mp4,mp3,mov,avi,flv,wmv,ogg,wav|max:204800',
        ];

        // If the product is being changed to digital and there's no existing digital file,
        // This logic can get complex, a simpler approach is to make it nullable and handle removal/upload.

        $request->validate($rules);

        // 2. Handle main product image upload/update
        $imagePath = $product->image_path; // Keep existing image path by default
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            // Store new image
            $imagePath = $request->file('image')->store('product_images', 'public');
        }

        // 3. Handle digital file upload/update based on product type
        $digitalFilePath = $product->digital_file_path; // Keep existing digital file path by default

        // If the product type is being changed TO digital OR if it's already digital
        if ($request->type === 'digital') {
            if ($request->hasFile('digital_file')) {
                // Delete old digital file if it exists
                if ($digitalFilePath && Storage::disk('public')->exists($digitalFilePath)) {
                    Storage::disk('public')->delete($digitalFilePath);
                }
                // Store new digital file
                $digitalFilePath = $request->file('digital_file')->store('digital_products', 'public');
            }
            // If type is digital but no new file uploaded and there was no old file,
            // or if the user explicitly removes it (you'd need a separate flag for that),
            // you might want to set $digitalFilePath to null or validate its presence.
            // For now, if no new file, it retains the old path.
        } else {
            // If the product type is changed FROM digital to physical, delete the digital file
            if ($digitalFilePath && Storage::disk('public')->exists($digitalFilePath)) {
                Storage::disk('public')->delete($digitalFilePath);
                $digitalFilePath = null; // Clear the path in DB
            }
        }


        // 4. Update the product in the database
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'base_price' => $request->base_price,
            'payment_gateway_fee' => $request->payment_gateway_fee ?? 0.00,
            'selling_price' => $request->selling_price,
            'type' => $request->type,
            'image_path' => $imagePath,
            'digital_file_path' => $digitalFilePath, // Make sure this is correctly assigned
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('c1he3f.my-products')->with('success', 'تم تحديث المنتج بنجاح!');
    }


    /**
     * Remove the specified product from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
            Storage::disk('public')->delete($product->image_path);
        }

        $product->delete();

        return redirect()->route('c1he3f.my-products')->with('success', 'تم حذف المنتج بنجاح!');
    }
}
