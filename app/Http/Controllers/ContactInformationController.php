<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactInformation;
use App\Models\Information;
use Illuminate\Support\Facades\File;

class ContactInformationController extends Controller
{
    public function index()
    {
        $contact_information = ContactInformation::first();

        return view('contact_information.index', compact('contact_information'));
    }

    public function edit(ContactInformation $contact_information)
    {
        return view('contact_information.update', compact('contact_information'));
    }

    public function update(Request $request, ContactInformation $contact_information)
    {
        try {
            // Define validation rules
            $rules = [
                'title' => 'required',
                'header' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
                'file' => 'nullable|file|mimes:pdf',
            ];

            // Validate request
            $request->validate($rules);

            // Get input data, excluding the token and method fields
            $input = $request->except(['_token', '_method']);

            // Handle header file upload and deletion
            if ($request->hasFile('header')) {
                if (!empty($contact_information->header) && File::exists($contact_information->header)) {
                    File::delete($contact_information->header);
                }

                $header = $request->file('header');
                $headerPath = 'images/contact_information/header/';
                $headerName = "information-" . date('YmdHis') . "." . $header->getClientOriginalExtension();
                $header->move(public_path($headerPath), $headerName);
                $input['header'] = $headerPath . $headerName;
            }

            // Handle file upload and deletion
            if ($request->hasFile('file')) {
                if (!empty($contact_information->file) && File::exists($contact_information->file)) {
                    File::delete($contact_information->file);
                }

                $file = $request->file('file');
                $filePath = 'files/contact_information/';
                $fileName = "information-" . date('YmdHis') . "." . $file->getClientOriginalExtension();
                $file->move(public_path($filePath), $fileName);
                $input['file'] = $filePath . $fileName;
            }

            // Update the contact information
            $contact_information->update($input);

            return redirect()->route('contact_information.index')
                ->with('success', 'Contact information updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update contact information. Please try again. Error: ' . $e->getMessage());
        }
    }

}
