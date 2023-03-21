<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function blog()
    {
        $blogs = Blog::all();

        return view('admin.blog', compact('blogs'));
    }

    public function addblog()
    {

        return view('admin.addblog');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        $request->image->move(public_path('images'), $imageName);

        DB::table('blogs')->insert([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imageName,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/blog')->with('success', 'Blog post created successfully.');
    }

    public function dashboard()
    {
        $blogs = Blog::all();

        return view('user.dashboard', compact('blogs'));
    }
}
