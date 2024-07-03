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
            $rules = [
                'title' => 'required',
                'header' => ($request->hasFile('header') || !$contact_information->header) ? 'image|mimes:jpeg,jpg,png|max:2048' : '', // Check if image is required
            ];

            if (!$request->hasFile('header') && !$contact_information->header) {
                $rules['header'] = 'required|image|mimes:jpeg,jpg,png';
            } elseif ($request->hasFile('header')) {
                $rules['header'] = 'image|mimes:jpeg,jpg,png';
            }

            $request->validate($rules);

            $input = $request->except(['_token', '_method']);

            if (!empty($contact_information->header) && $request->hasFile('header')) {
                $imagePath6 = $contact_information->header;

                if (File::exists($imagePath6)) {
                    File::delete($imagePath6);
                }
            }

            if ($header = $request->file('header')) {
                $destinationPath6 = 'images/contact_information/header/';
                $profileImage6 = "information" . "-" . date('YmdHis') . "." . $header->getClientOriginalExtension();
                $header->move($destinationPath6, $profileImage6);
                $input['header'] = $destinationPath6 . $profileImage6;
            } elseif (!$request->hasFile('header') && !$contact_information->header) {
                unset($input['header']);
            }

            $contact_information->update($input);

            return redirect()->route('contact_information.index')
                ->with('success', 'Contact information updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update contact information. Please try again.');
        }
    }
}
