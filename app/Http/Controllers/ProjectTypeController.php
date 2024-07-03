<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectType;
use App\Models\Project;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProjectTypeController extends Controller
{
    public function index()
    {
        $projectType = ProjectType::all();
        $projectType = ProjectType::paginate(8);
        $jenisProject = Project::all();

        return view('projectType.index', compact('projectType', 'jenisProject'));
    }

    public function create()
    {
        $projectId = Project::all();
        return view('projectType.create', compact('projectId'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_project' => 'required',
            'name' => 'required|max:255',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
            // 'image_360' => 'required|image|mimes:jpg',
            'small_description' => 'required',
            'luas_bangunan' => 'required|max:255',
            'luas_tanah' => 'required|max:255',
            'fondasi' => 'required|max:255',
            'dinding' => 'required|max:255',
            'plafon' => 'required|max:255',
            'kamar_tidur' => 'required|max:255',
            'kamar_mandi' => 'required|max:255',
            'carport' => 'required|max:255',
            'air' => 'required|max:255',
        ], [
            'id_project.required' => 'Project id is required.',
            'name.required' => 'Name is required.',
            'name.max' => 'Name should not exceed 255 characters.',
            'image.required' => 'Image is required.',
            'image.mimes' => 'Only JPEG, JPG, and PNG images are allowed.',
            'image.max' => 'The image size should not exceed 2048 KB.',
            // 'image_360.required' => 'Image is required.',
            // 'image_360.mimes' => 'Only JPG images are allowed.',
            'small_description.required' => 'Description is required',
            'luas_bangunan.required' => 'Luas Bangunan is required.',
            'luas_bangunan.max' => 'Luas Bangunan should not exceed 255 characters.',
            'luas_tanah.required' => 'Luas Tanah is required.',
            'luas_tanah.max' => 'Luas Tanah should not exceed 255 characters.',
            'fondasi.required' => 'Fondasi is required.',
            'fondasi.max' => 'Fondasi should not exceed 255 characters.',
            'dinding.required' => 'Dinding is required.',
            'dinding.max' => 'Dinding should not exceed 255 characters.',
            'plafon.required' => 'Plafon is required.',
            'plafon.max' => 'Plafon should not exceed 255 characters.',
            'kamar_tidur.required' => 'Kamar Tidur is required.',
            'kamar_tidur.max' => 'Kamar Tidur should not exceed 255 characters.',
            'kamar_mandi.required' => 'Kamar Mandi is required.',
            'kamar_mandi.max' => 'Kamar Mandi should not exceed 255 characters.',
            'carport.required' => 'Carport is required.',
            'carport.max' => 'Carport should not exceed 255 characters.',
            'air.required' => 'Air is required.',
            'air.max' => 'Air should not exceed 255 characters.',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/projectType/image/';
            $profileImage = "image" . "-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
            $input['image'] = $destinationPath . $profileImage;
        }

        // if ($image_360 = $request->file('image_360')) {
        //     // Save locally first
        //     $destinationPath360 = 'images/projectType/image_360/';
        //     $timestamp = date('YmdHis');
        //     $profileImage360 = "image_360" . "-" . $timestamp . "." . $image_360->getClientOriginalExtension();
        //     $image_360->move(public_path($destinationPath360), $profileImage360);
        //     $localImagePath = $destinationPath360 . $profileImage360;

        //     // Then read the saved file for external upload
        //     $imagePath = public_path($localImagePath);
        //     $response = Http::attach('image_360', file_get_contents($imagePath), $profileImage360)
        //         ->post('https://java.1017studios.com/api/upload-image-360', ['timestamp' => $timestamp]);

        //     Log::info('Response from frontend server:', ['response' => $response->body()]);

        //     if ($response->successful()) {
        //         $externalImagePath = $response->json('path');
        //         $input['image_360'] = $localImagePath; // Use locally saved path for consistency
        //         $input['image_360_external'] = $externalImagePath;
        //     } else {
        //         return redirect()->route('projectType.index')->with(['error' => 'Failed to upload 360 image to frontend server!']);
        //     }
        // }

        ProjectType::create($input);

        return redirect()->route('projectType.index')->with(['success' => 'Data successfully saved!']);
    }



    public function show(string $id)
    {
        $projectType = ProjectType::findOrFail($id);

        return view('projectType.show', compact('projectType'));
    }

    public function edit(ProjectType $projectType)
    {
        $projectImageAll = Project::all();

        return view('projectType.update', compact('projectType', 'projectImageAll'));
    }

    public function update(Request $request, ProjectType $projectType)
    {
        $request->validate([
            'id_project' => 'required',
            'name' => 'required|max:255',
            'image' => ($request->hasFile('image') || !$projectType->image) ? 'image|mimes:jpeg,jpg,png|max:2048' : '', // Check if image is required
            // 'image_360' => ($request->hasFile('image_360') || !$projectType->image_360) ? 'image|mimes:jpg' : '', // Check if image is required
            'small_description' => 'required',
            'luas_bangunan' => 'required|max:255',
            'luas_tanah' => 'required|max:255',
            'fondasi' => 'required|max:255',
            'dinding' => 'required|max:255',
            'plafon' => 'required|max:255',
            'kamar_tidur' => 'required|max:255',
            'kamar_mandi' => 'required|max:255',
            'carport' => 'required|max:255',
            'air' => 'required|max:255',
        ], [
            'id_project.required' => 'Project id is required.',
            'name.required' => 'Name is required.',
            'name.max' => 'Name should not exceed 255 characters.',
            'image.required' => 'Image is required.',
            'image.mimes' => 'Only JPEG, JPG, and PNG images are allowed.', // Custom error message for image format
            'image.max' => 'The image size should not exceed 2048 KB.', // Custom error message for image size
            // 'image_360.required' => 'Image is required.',
            // 'image_360.mimes' => 'Only JPG images are allowed.', // Custom error message for image format
            'small_description.required' => 'Description is required',
            'luas_bangunan.required' => 'Luas Bangunan is required.',
            'luas_bangunan.max' => 'Luas Bangunan should not exceed 255 characters.',
            'luas_tanah.required' => 'Luas Tanah is required.',
            'luas_tanah.max' => 'Luas Tanah should not exceed 255 characters.',
            'fondasi.required' => 'Fondasi is required.',
            'fondasi.max' => 'Fondasi should not exceed 255 characters.',
            'dinding.required' => 'Dinding is required.',
            'dinding.max' => 'Dinding should not exceed 255 characters.',
            'plafon.required' => 'Plafon is required.',
            'plafon.max' => 'Plafon should not exceed 255 characters.',
            'kamar_tidur.required' => 'Kamar Tidur is required.',
            'kamar_tidur.max' => 'Kamar Tidur should not exceed 255 characters.',
            'kamar_mandi.required' => 'Kamar Mandi is required.',
            'kamar_mandi.max' => 'Kamar Mandi should not exceed 255 characters.',
            'carport.required' => 'Carport is required.',
            'carport.max' => 'Carport should not exceed 255 characters.',
            'air.required' => 'Air is required.',
            'air.max' => 'Air should not exceed 255 characters.',
        ]);

        $input = $request->except(['_token', '_method']);

        if (!empty($projectType->image) && $request->hasFile('image')) {
            $imagePath = public_path($projectType->image);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        // if (!empty($projectType->image_360) && $request->hasFile('image_360')) {
        //     $imagePath2 = public_path($projectType->image_360);

        //     if (File::exists($imagePath2)) {
        //         File::delete($imagePath2);
        //     }
        // }

        if ($image = $request->file('image')) {
            $destinationPath = 'images/projectType/image/';
            $profileImage = "image" . "-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path($destinationPath), $profileImage);
            $input['image'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('image') && !$projectType->image) {
            unset($input['image']);
        }

        // if ($image_360 = $request->file('image_360')) {
        //     // Save locally first
        //     $destinationPath360 = 'images/projectType/image_360/';
        //     $timestamp = date('YmdHis');
        //     $profileImage360 = "image_360" . "-" . $timestamp . "." . $image_360->getClientOriginalExtension();
        //     $image_360->move(public_path($destinationPath360), $profileImage360);
        //     $localImagePath = $destinationPath360 . $profileImage360;

        //     // Then read the saved file for external upload
        //     $imagePath = public_path($localImagePath);
        //     $response = Http::attach('image_360', file_get_contents($imagePath), $profileImage360)
        //         ->post(env('APP_URL_FRONT') . 'api/upload-image-360', ['timestamp' => $timestamp]);

        //     Log::info('Response from frontend server:', ['response' => $response->body()]);

        //     if ($response->successful()) {
        //         $externalImagePath = $response->json('path');
        //         $input['image_360'] = $localImagePath; // Use locally saved path for consistency
        //         $input['image_360_external'] = $externalImagePath;
        //     } else {
        //         return redirect()->route('projectType.index')->with(['error' => 'Failed to upload 360 image to frontend server!']);
        //     }
        // } elseif (!$request->hasFile('image_360') && !$projectType->image_360) {
        //     unset($input['image_360']);
        // }

        $projectType->update($input);

        return redirect()->route('projectType.index')
            ->with('success', 'ProjectType updated successfully');
    }

    public function destroy(ProjectType $projectType)
    {
        try {
            // Delete images on admin server
            if (!empty($projectType->image)) {
                $imagePath = public_path($projectType->image);

                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }

            // Delete image on frontend server if it exists
            // if (!empty($projectType->image_360)) {
            //     $response = Http::delete(env('APP_URL_FRONT') . 'api/delete-image-360', [
            //         'image_path' => $projectType->image_360 // Assuming this is the path on frontend server
            //     ]);

            //     if ($response->successful()) {
            //         // Delete local image after successful deletion on frontend server
            //         $imagePath2 = public_path($projectType->image_360);
            //         if (file_exists($imagePath2)) {
            //             unlink($imagePath2);
            //         }
            //     }
            // }

            // Delete the ProjectType record
            $projectType->delete();

            return redirect()->route('projectType.index')->with('success', 'ProjectType deleted successfully');
        } catch (\Exception $e) {
            Log::error('Delete ProjectType Error: ' . $e->getMessage());
            return redirect()->route('projectType.index')->with('error', 'Internal Server Error');
        }
    }
}
