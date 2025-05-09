<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dish;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class DishesControllerA extends Controller
{
    // عرض صفحة إضافة طبق جديد
    public function CreatDishes()
    {
        // جلب الفئات من قاعدة البيانات
        $categories = Category::all();
    
        // جلب جميع الأطباق
        $dishes = Dish::with('category')->get(); 
    
        return view('admin.addDishes', compact('categories', 'dishes'));
    }
    

    // تخزين الطبق الجديد في قاعدة البيانات
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // تخزين الصورة في المجلد المحدد
        $imagePath = $request->file('image')->store('dishes_images', 'public');

        // إنشاء طبق جديد
        Dish::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'available' => true,  // يمكن تعديل هذه القيمة حسب الحاجة
        ]);

        // إعادة التوجيه مع رسالة نجاح
        return redirect()->route('Dashboard.CreatDishes')->with('success', 'تم إضافة الطبق بنجاح!');
    }

    // عرض جميع الأطباق
    public function index()
    {
        $dishes = Dish::with('category')->get();
        return view('admin.addDishes', compact('dishes'));
    }

    public function showMenu()
    {
        // جلب الأطباق مع الفئات
        $dishes = Dish::with('category')->get();
        
        // جلب جميع الفئات من قاعدة البيانات
        $categories = Category::all(); 
    
        return view('admin.showMenu', compact('dishes', 'categories'));
    }

    public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'price' => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $dish = Dish::findOrFail($id);
    $dish->name = $request->name;
    $dish->description = $request->description;
    $dish->price = $request->price;
    $dish->category_id = $request->category_id;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        $dish->image = $imageName;
    }

    $dish->save();

    return redirect()->route('Dashboard.CreatDishes')->with('success', 'تم تعديل الطبق بنجاح');
}

public function edit($id)
{
    $dish = Dish::findOrFail($id);
    $categories = Category::all();
    return view('admin.editDishes', compact('dish', 'categories'));
}


public function delete($id){

   $data=Dish::find($id);

   if($data){
       $data->delete();
   }
   return redirect()->route('Dashboard.CreatDishes');
}
    
    
    

}
