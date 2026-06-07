<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Cause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cases = Cause::with('category')->latest()->paginate(12);
        return view('dashboard.cases.index', compact('cases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('dashboard.cases.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'link' => 'nullable|url',
            'goal' => 'required|numeric|min:0',
            'status' => 'required|in:open,close',
            'category_id' => 'required|exists:categories,id',
            'image' => 'required|image|max:2048', // max 2MB
        ]);

        $case = Cause::create([
            'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
            'content' => ['ar' => $request->content_ar, 'en' => $request->content_en],
            'link' => $request->link,
            'goal' => $request->goal,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            $case->image()->create([
                'path' => $request->file('image')->store('cases', 'public'),
            ]);
        }

        flash()->success(__('admin.case_created_successfully'));
        return redirect()->route('dashboard.cases.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cause $case)
    {
        $categories = \App\Models\Category::all();
        return view('dashboard.cases.edit', compact('case', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cause $case)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'link' => 'nullable|url',
            'goal' => 'required|numeric|min:0',
            'status' => 'required|in:open,close',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048', // max 2MB
        ]);

        $case->update([
            'title' => ['ar' => $request->title_ar, 'en' => $request->title_en],
            'content' => ['ar' => $request->content_ar, 'en' => $request->content_en],
            'link' => $request->link,
            'goal' => $request->goal,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('cases', 'public');
            if ($case->image) {
                File::delete(public_path($case->image->path));
                $case->image()->update(['path' => $path]);
            } else {
                $case->image()->create(['path' => $path]);
            }
        }

        flash()->info(__('admin.case_updated_successfully'));
        return redirect()->route('dashboard.cases.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cause $case)
    {
        if ($case->image) {
            File::delete(public_path($case->image->path));
            $case->image()->delete();
        }
        $case->delete();

        flash()->warning(__('admin.case_deleted_successfully'));
        return redirect()->route('dashboard.cases.index');
    }
}
