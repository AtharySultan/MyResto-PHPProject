<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryControllerA extends Controller
{
    public function CreatCategory() {
        $categories = Category::all(); // جلب جميع الفئات
        return view('admin.addCategory', compact('categories'));
    }

    public function store(Request $request) {
        // التحقق من المدخلات
        $request->validate([
            'categ_name' => 'required|string|max:255',
            'categ_description' => 'nullable|string',
        ]);

        // حفظ الفئة
        Category::create([
            'name' => $request->categ_name,
            'description' => $request->categ_description,
        ]);

        // الرجوع للصفحة مع رسالة نجاح
        return redirect()->route('Dashboard.CreatCategory')->with('success', 'تمت إضافة الفئة بنجاح!');
    }


    public function delete($id){

        $data=Category::find($id);

        if($data){
            $data->delete();
        }
        return redirect()->route('Dashboard.CreatCategory');
    }

    public function edit($id)
{
    $category = Category::findOrFail($id);
    return view('admin.editCategory', compact('category'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'categ_name' => 'required|string|max:255',
        'categ_description' => 'nullable|string',
    ]);

    $category = Category::findOrFail($id);
    $category->update([
        'name' => $request->categ_name,
        'description' => $request->categ_description,
    ]);

    return redirect()->route('Dashboard.CreatCategory')->with('success', 'تم تحديث الفئة بنجاح!');
}

}

