<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use Illuminate\Support\Facades\File;


class InformationController extends Controller
{
    public function index()
    {
        $information = Information::first();

        return view('information.index', compact('information'));
    }

    public function edit(Information $information)
    {
        return view('information.update', compact('information'));
    }

    public function update(Request $request, Information $information)
    {
        try {
            $rules = [
                'name' => 'required',
                'description' => 'required',
                'address' => 'required',
                'phone' => 'required',
                'google_map' => 'required',
                'order_wa' => 'required',
                'maintenance' => 'required|boolean',
                'header_image' => ($request->hasFile('header_image') || !$information->header_image) ? 'image|mimes:jpeg,jpg,png|max:2048' : '', // Check if image is required
                // 'footer_image' => ($request->hasFile('footer_image') || !$information->footer_image) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
            ];

            if (!$request->hasFile('logo_header') && !$information->logo_header) {
                $rules['logo_header'] = 'required|image|mimes:jpeg,jpg,png|max:2048';
            } elseif ($request->hasFile('logo_header')) {
                $rules['logo_header'] = 'image|mimes:jpeg,jpg,png|max:2048';
            }

            if (!$request->hasFile('logo_favicon') && !$information->logo_favicon) {
                $rules['logo_favicon'] = 'required|image|mimes:jpeg,jpg,png|max:2048';
            } elseif ($request->hasFile('logo_favicon')) {
                $rules['logo_favicon'] = 'image|mimes:jpeg,jpg,png|max:2048';
            }

            if (!$request->hasFile('logo_company') && !$information->logo_company) {
                $rules['logo_company'] = 'required|image|mimes:jpeg,jpg,png|max:2048';
            } elseif ($request->hasFile('logo_company')) {
                $rules['logo_company'] = 'image|mimes:jpeg,jpg,png|max:2048';
            }

            if (!$request->hasFile('image') && !$information->image) {
                $rules['image'] = 'required|image|mimes:jpeg,jpg,png';
            } elseif ($request->hasFile('image')) {
                $rules['image'] = 'image|mimes:jpeg,jpg,png';
            }

            if (!$request->hasFile('header_image') && !$information->header_image) {
                $rules['header_image'] = 'required|image|mimes:jpeg,jpg,png';
            } elseif ($request->hasFile('header_image')) {
                $rules['header_image'] = 'image|mimes:jpeg,jpg,png';
            }

            // if (!$request->hasFile('footer_image') && !$information->footer_image) {
            //     $rules['footer_image'] = 'required|image|mimes:jpeg,jpg,png';
            // } elseif ($request->hasFile('footer_image')) {
            //     $rules['footer_image'] = 'image|mimes:jpeg,jpg,png';
            // }

            $request->validate($rules);

            $input = $request->except(['_token', '_method']);

            $input['phone'] = (strpos($request->phone, '0') === 0) ? '62' . substr($request->phone, 1) : $request->phone;

            $input['order_wa'] = (strpos($request->order_wa, '0') === 0) ? '62' . substr($request->order_wa, 1) : $request->order_wa;

            if ($input['phone'] !== $information->phone || $input['order_wa'] !== $information->order_wa) {
                $whatsappLink = 'https://wa.me/' . urlencode($input['phone']) . '?text=' . urlencode($input['order_wa']);
                $input['link_wa'] = $whatsappLink;
            }

            if (!empty($information->logo_header) && $request->hasFile('logo_header')) {
                $imagePath = $information->logo_header;

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }

            if (!empty($information->logo_favicon) && $request->hasFile('logo_favicon')) {
                $imagePath2 = $information->logo_favicon;

                if (File::exists($imagePath2)) {
                    File::delete($imagePath2);
                }
            }

            if (!empty($information->logo_company) && $request->hasFile('logo_company')) {
                $imagePath3 = $information->logo_company;

                if (File::exists($imagePath3)) {
                    File::delete($imagePath3);
                }
            }

            if (!empty($information->image) && $request->hasFile('image')) {
                $imagePath4 = $information->image;

                if (File::exists($imagePath4)) {
                    File::delete($imagePath4);
                }
            }

            if (!empty($information->header_image) && $request->hasFile('header_image')) {
                $imagePath6 = $information->header_image;

                if (File::exists($imagePath6)) {
                    File::delete($imagePath6);
                }
            }

            if (!empty($information->footer_image) && $request->hasFile('footer_image')) {
                $imagePath7 = $information->footer_image;

                if (File::exists($imagePath7)) {
                    File::delete($imagePath7);
                }
            }

            if ($logo_header = $request->file('logo_header')) {
                $destinationPath = 'images/information/logo_header/';
                $profileImage = "information" . "-" . "logo_header" . date('YmdHis') . "." . $logo_header->getClientOriginalExtension();
                $logo_header->move($destinationPath, $profileImage);
                $input['logo_header'] = $destinationPath . $profileImage;
            } elseif (!$request->hasFile('logo_header') && !$information->logo_header) {
                unset($input['logo_header']);
            }

            if ($logo_favicon = $request->file('logo_favicon')) {
                $destinationPath2 = 'images/information/logo_favicon/';
                $profileImage2 = "information" . "-" . "logo_favicon" . date('YmdHis') . "." . $logo_favicon->getClientOriginalExtension();
                $logo_favicon->move($destinationPath2, $profileImage2);
                $input['logo_favicon'] = $destinationPath2 . $profileImage2;
            } elseif (!$request->hasFile('logo_favicon') && !$information->logo_favicon) {
                unset($input['logo_favicon']);
            }

            if ($logo_company = $request->file('logo_company')) {
                $destinationPath3 = 'images/information/logo_company/';
                $profileImage3 = "information" . "-" . "logo_company" . date('YmdHis') . "." . $logo_company->getClientOriginalExtension();
                $logo_company->move($destinationPath3, $profileImage3);
                $input['logo_company'] = $destinationPath3 . $profileImage3;
            } elseif (!$request->hasFile('logo_company') && !$information->logo_company) {
                unset($input['logo_company']);
            }

            if ($image = $request->file('image')) {
                $destinationPath4 = 'images/information/image/';
                $profileImage4 = "information" . "-" . "image" . date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath4, $profileImage4);
                $input['image'] = $destinationPath4 . $profileImage4;
            } elseif (!$request->hasFile('image') && !$information->image) {
                unset($input['image']);
            }

            if ($header_image = $request->file('header_image')) {
                $destinationPath6 = 'images/information/header_image/';
                $profileImage6 = "information" . "-" . date('YmdHis') . "." . $header_image->getClientOriginalExtension();
                $header_image->move($destinationPath6, $profileImage6);
                $input['header_image'] = $destinationPath6 . $profileImage6;
            } elseif (!$request->hasFile('header_image') && !$information->header_image) {
                unset($input['header_image']);
            }

            if ($footer_image = $request->file('footer_image')) {
                $destinationPath7 = 'images/information/footer_image/';
                $profileImage7 = "information" . "-" . date('YmdHis') . "." . $footer_image->getClientOriginalExtension();
                $footer_image->move($destinationPath7, $profileImage7);
                $input['footer_image'] = $destinationPath7 . $profileImage7;
            } elseif (!$request->hasFile('footer_image') && !$information->footer_image) {
                unset($input['footer_image']);
            }

            $information->maintenance = $request->input('maintenance');

            $information->update($input);

            return redirect()->route('information.index')
                ->with('success', 'Information updated successfully');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to update information. Please try again.');
        }
    }
}
