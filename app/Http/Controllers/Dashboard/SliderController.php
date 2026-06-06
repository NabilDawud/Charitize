<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::latest('id')->paginate(env('PAGE_SIZE', 12));
        return view('dashboard.sliders.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.sliders.create');
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
            'btn1_link' => 'nullable|url',
            'btn1_text_ar' => 'nullable|string|max:255',
            'btn1_text_en' => 'nullable|string|max:255',
            'btn2_link' => 'nullable|url',
            'btn2_text_ar' => 'nullable|string|max:255',
            'btn2_text_en' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $path = $request->file('image')->store('uploads/sliders', 'custom');

        $slider = Slider::create([
            'title' => [
                'ar' => $request->title_ar,
                'en' => $request->title_en,
            ],
            'content' => [
                'ar' => $request->content_ar,
                'en' => $request->content_en,
            ],
            'btn1_link' => $request->btn1_link,
            'btn1_text' => [
                'ar' => $request->btn1_text_ar,
                'en' => $request->btn1_text_en,
            ],
            'btn2_link' => $request->btn2_link,
            'btn2_text' => [
                'ar' => $request->btn2_text_ar,
                'en' => $request->btn2_text_en,
            ],
        ]);

        if ($path) {
            $slider->image()->create([
                'path' => $path
            ]);
        }

        flash()->success(__('admin.slider_created_successfully'));
        return redirect()->route('dashboard.sliders.index');
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        return view('dashboard.sliders.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'content_ar' => 'required|string',
            'content_en' => 'required|string',
            'btn1_link' => 'nullable|url',
            'btn1_text_ar' => 'nullable|string|max:255',
            'btn1_text_en' => 'nullable|string|max:255',
            'btn2_link' => 'nullable|url',
            'btn2_text_ar' => 'nullable|string|max:255',
            'btn2_text_en' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $slider->update([
            'title' => [
                'ar' => $request->title_ar,
                'en' => $request->title_en,
            ],
            'content' => [
                'ar' => $request->content_ar,
                'en' => $request->content_en,
            ],
            'btn1_link' => $request->btn1_link,
            'btn1_text' => [
                'ar' => $request->btn1_text_ar,
                'en' => $request->btn1_text_en,
            ],
            'btn2_link' => $request->btn2_link,
            'btn2_text' => [
                'ar' => $request->btn2_text_ar,
                'en' => $request->btn2_text_en,
            ],
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('uploads/sliders', 'custom');
            if ($slider->image) {
                // Delete old image
                File::delete(public_path($slider->image->path));
                // Update with new image
                $slider->image()->update(['path' => $path]);
            } else {
                // Create new image record
                $slider->image()->create(['path' => $path]);
            }
        }

        flash()->info(__('admin.slider_updated_successfully'));
        return redirect()->route('dashboard.sliders.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slider $slider)
    {
        if ($slider->image) {
            // Delete image file
            File::delete(public_path($slider->image->path));
            // Delete image record
            $slider->image()->delete();
        }
        $slider->delete();

        flash()->warning(__('admin.slider_deleted_successfully'));
        return redirect()->route('dashboard.sliders.index');
    }
}
