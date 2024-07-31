<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsInformation;
use App\Models\Information;
use Illuminate\Support\Facades\File;

class NewsInformationController extends Controller
{
    public function index()
    {
        $news_information = NewsInformation::first();

        return view('news_information.index', compact('news_information'));
    }

    public function edit(NewsInformation $news_information)
    {
        return view('news_information.update', compact('news_information'));
    }

    public function update(Request $request, NewsInformation $news_information)
    {
        try {
            // Define validation rules
            $rules = [
                'header_image' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            ];

            // Validate request
            $request->validate($rules);

            // Get input data, excluding the token and method fields
            $input = $request->except(['_token', '_method']);

            // Handle header file upload and deletion
            if ($request->hasFile('header_image')) {
                if (!empty($news_information->header_image) && File::exists($news_information->header_image)) {
                    File::delete($news_information->header_image);
                }

                $header_image = $request->file('header_image');
                $headerPath = 'images/news_information/header_image/';
                $headerName = "information-" . date('YmdHis') . "." . $header_image->getClientOriginalExtension();
                $header_image->move(public_path($headerPath), $headerName);
                $input['header_image'] = $headerPath . $headerName;
            }

            // Update the contact information
            $news_information->update($input);

            return redirect()->route('news_information.index')
                ->with('success', 'News information updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update contact information. Please try again. Error: ' . $e->getMessage());
        }
    }
}
