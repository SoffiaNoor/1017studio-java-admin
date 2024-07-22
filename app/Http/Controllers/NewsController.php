<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\File;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::all();
        $news = News::paginate(8);
        $newsCount = News::count();
        return view('news.index', compact('news', 'newsCount'));
    }

    public function create()
    {
        return view('news.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png',
            'description' => 'required',
        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title should not exceed 255 characters.',
            'image.required' => 'Image is required.',
            'description.required' => 'Detail is required.',
            'description.max' => 'Detail should not exceed 255 characters.',
        ]);
        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'images/news/';
            $profileImage = "news" . "-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $destinationPath . $profileImage;
        }

        News::create($input);

        return redirect()->route('news.index')->with(['success' => 'Data successfully saved!']);
    }

    public function show(string $id)
    {
        $news = News::findOrFail($id);

        return view('news.show', compact('news'));
    }

    public function edit(News $news)
    {
        return view('news.update', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|max:255',
            'image' => ($request->hasFile('image') || !$news->image) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
            'description' => 'required',
            'is_show' => 'required|boolean',
        ], [
            'title.required' => 'Title is required.',
            'title.max' => 'Title should not exceed 255 characters.',
            'image.required' => 'Image is required.',
            'description.required' => 'Detail is required.',
            'description.max' => 'Detail should not exceed 255 characters.',
        ]);

        $input = $request->except(['_token', '_method']);

        if (!empty($news->image) && $request->hasFile('image')) {
            $imagePath = $news->image;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($image = $request->file('image')) {
            $destinationPath = 'images/news/';
            $profileImage = "news" . "-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('image') && !$news->image) {
            unset($input['image']);
        }
        $news->is_show = $request->input('is_show');
        $news->update($input);

        return redirect()->route('news.index')
            ->with('success', 'News updated successfully');
    }


    public function destroy(News $news)
    {
        if (!empty($news->image)) {
            $imagePath = $news->image;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
        $news->delete();

        return redirect()->route('news.index')
            ->with('success', 'News deleted successfully');
    }
}
