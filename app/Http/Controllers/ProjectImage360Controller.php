<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectType;
use App\Models\Project;
use App\Models\ProjectImage360;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProjectImage360Controller extends Controller
{
    public function index()
    {
        $projectTypeImage360 = ProjectImage360::all();
        $projectTypeImage360 = ProjectImage360::paginate(8);
        $jenisProject = ProjectType::all();

        return view('projectTypeImage360.index', compact('projectTypeImage360', 'jenisProject'));
    }

    public function create()
    {
        $projectId = ProjectType::all();
        return view('projectTypeImage360.create', compact('projectId'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'id_project_type' => 'required',
            'image_360' => 'required|image|mimes:jpg',
        ], [
            'id_project_type.required' => 'Project id is required.',
            'image_360.required' => 'Image is required.',
            'image_360.mimes' => 'Only JPG images are allowed.',
        ]);

        $input = $request->all();

        if ($image_360 = $request->file('image_360')) {
            // Save locally first
            $destinationPath360 = 'images/projectTypeImage360/image_360/';
            $timestamp = date('YmdHis');
            $profileImage360 = "image_360" . "-" . $timestamp . "." . $image_360->getClientOriginalExtension();
            $image_360->move(public_path($destinationPath360), $profileImage360);
            $localImagePath = $destinationPath360 . $profileImage360;

            // Then read the saved file for external upload
            $imagePath = public_path($localImagePath);
            $response = Http::attach('image_360', file_get_contents($imagePath), $profileImage360)
                ->post(env('APP_URL_FRONT') . 'api/upload-image-360', ['timestamp' => $timestamp]);

            Log::info('Response from frontend server:', ['response' => $response->body()]);

            if ($response->successful()) {
                $externalImagePath = $response->json('path');
                $input['image_360'] = $localImagePath; // Use locally saved path for consistency
                $input['image_360_external'] = $externalImagePath;
            } else {
                return redirect()->route('projectTypeImage360.index')->with(['error' => 'Failed to upload 360 image to frontend server!']);
            }
        }

        ProjectImage360::create($input);

        return redirect()->route('projectTypeImage360.index')->with(['success' => 'Data successfully saved!']);
    }



    public function show(string $id)
    {
        $projectType = ProjectImage360::findOrFail($id);

        return view('projectTypeImage360.show', compact('projectType'));
    }

    public function edit(ProjectImage360 $projectTypeImage360)
    {
        $projectTypeImageAll = ProjectType::all();

        return view('projectTypeImage360.update', compact('projectTypeImage360', 'projectTypeImageAll'));
    }

    public function update(Request $request, ProjectImage360 $projectTypeImage360)
    {
        $request->validate([
            'id_project_type' => 'required',
            'image_360' => ($request->hasFile('image_360') || !$projectTypeImage360->image_360) ? 'image|mimes:jpg' : '', // Check if image is required
        ], [
            'id_project_type.required' => 'Project id is required.',
            'image_360.required' => 'Image is required.',
            'image_360.mimes' => 'Only JPG images are allowed.',
        ]);

        $input = $request->except(['_token', '_method']);

        if (!empty($projectTypeImage360->image_360) && $request->hasFile('image_360')) {
            $imagePath2 = public_path($projectTypeImage360->image_360);

            if (File::exists($imagePath2)) {
                File::delete($imagePath2);
            }
        }

        if (!empty($projectTypeImage360->image_360) && $request->hasFile('image_360')) {
            $response = Http::delete(env('APP_URL_FRONT') . 'api/delete-image-360', [
                'image_path' => $projectTypeImage360->image_360 // Assuming this is the path on frontend server
            ]);

            if ($response->successful()) {
                // Delete local image after successful deletion on frontend server
                $imagePath2 = public_path($projectTypeImage360->image_360);
                if (file_exists($imagePath2)) {
                    unlink($imagePath2);
                }
            }
        }

        if ($image_360 = $request->file('image_360')) {
            // Save locally first
            $destinationPath360 = 'images/projectTypeImage360/image_360/';
            $timestamp = date('YmdHis');
            $profileImage360 = "image_360" . "-" . $timestamp . "." . $image_360->getClientOriginalExtension();
            $image_360->move(public_path($destinationPath360), $profileImage360);
            $localImagePath = $destinationPath360 . $profileImage360;

            // Then read the saved file for external upload
            $imagePath = public_path($localImagePath);
            $response = Http::attach('image_360', file_get_contents($imagePath), $profileImage360)
                ->post(env('APP_URL_FRONT') . 'api/upload-image-360', ['timestamp' => $timestamp]);

            Log::info('Response from frontend server:', ['response' => $response->body()]);

            if ($response->successful()) {
                $externalImagePath = $response->json('path');
                $input['image_360'] = $localImagePath; // Use locally saved path for consistency
                $input['image_360_external'] = $externalImagePath;
            } else {
                return redirect()->route('projectTypeImage360.index')->with(['error' => 'Failed to upload 360 image to frontend server!']);
            }
        } elseif (!$request->hasFile('image_360') && !$projectTypeImage360->image_360) {
            unset($input['image_360']);
        }

        $projectTypeImage360->update($input);

        return redirect()->route('projectTypeImage360.index')
            ->with('success', 'Project Type Image 360 updated successfully');
    }

    public function destroy(ProjectImage360 $projectTypeImage360)
    {
        try {
            // Delete image on frontend server if it exists
            if (!empty($projectTypeImage360->image_360)) {
                $response = Http::delete(env('APP_URL_FRONT') . 'api/delete-image-360', [
                    'image_path' => $projectTypeImage360->image_360 // Assuming this is the path on frontend server
                ]);

                if ($response->successful()) {
                    // Delete local image after successful deletion on frontend server
                    $imagePath2 = public_path($projectTypeImage360->image_360);
                    if (file_exists($imagePath2)) {
                        unlink($imagePath2);
                    }
                }
            }

            // Delete the ProjectType record
            $projectTypeImage360->delete();

            return redirect()->route('projectTypeImage360.index')->with('success', 'Project Type Image 360 deleted successfully');
        } catch (\Exception $e) {
            Log::error('Delete Project Type Image Error: ' . $e->getMessage());
            return redirect()->route('projectTypeImage360.index')->with('error', 'Internal Server Error');
        }
    }

}
