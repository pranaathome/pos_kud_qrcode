<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'DESC')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {

        //form validation
        $this->validate($request, [
            'name' => 'required|string|max:50',
            'description' => 'nullable|string'
        ]);

        try {
            //firstOrCreate jika nama kategori sudah ada, maka record tersebut hanya diselect tidak di add
            $categories = Category::firstOrCreate([
                'name' => $request->name
            ], [
                'description' => $request->description
            ]);
            return redirect()->back()->with(['success' => 'Kategori: ' . $categories->name . ' Ditambahkan']);
        } catch(\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }
}
