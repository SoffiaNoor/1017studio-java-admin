<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectType;
use App\Models\ProjectTypeImage;
use Illuminate\Support\Facades\File;

class ProjectTypeImageController extends Controller
{
    public function index()
    {
        $projectTypeImage = ProjectTypeImage::all();
        $projectTypeImage = ProjectTypeImage::paginate(8);
        $jenisImage = ProjectType::all();
        $projectTypeImages = ProjectTypeImage::with('projectType.projectTypes')->get();

        return view('projectTypeImage.index', compact('projectTypeImage', 'jenisImage', 'projectTypeImages'));
    }

    public function create()
    {
        $projectId = ProjectType::all();
        return view('projectTypeImage.create', compact('projectId'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_project_type' => 'required',
            'image' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ], [
            'id_project_type.required' => 'Project id is required.',
            'image.required' => 'Image is required.',
            'image.mimes' => 'Only JPEG, JPG, and PNG images are allowed.',
            'image.max' => 'The image size should not exceed 2048 KB.',
        ]);

        $input = $request->all();
        if ($image = $request->file('image')) {
            $destinationPath = 'images/projectTypeImage/image/';
            $profileImage = "image" . "-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $destinationPath . $profileImage;
        }

        ProjectTypeImage::create($input);

        return redirect()->route('projectTypeImage.index')->with(['success' => 'Data successfully saved!']);
    }

    public function show(string $id)
    {
        $projectTypeImage = ProjectTypeImage::findOrFail($id);

        return view('projectTypeImage.show', compact('projectTypeImage'));
    }

    public function edit(ProjectTypeImage $projectTypeImage)
    {
        $projectTypeImageAll = ProjectType::all();

        return view('projectTypeImage.update', compact('projectTypeImage', 'projectTypeImageAll'));
    }

    public function update(Request $request, ProjectTypeImage $projectTypeImage)
    {

        $request->validate([
            'id_project_type' => 'required', // Ensure the project type ID exists
            'image' => ($request->hasFile('image') || !$projectTypeImage->image) ? 'image|mimes:jpeg,jpg,png|max:2048' : '',
        ], [
            'id_project_type.required' => 'Project id is required.',
            'id_project_type.exists' => 'The selected project type does not exist.',
            'image.required' => 'Image is required.',
            'image.mimes' => 'Only JPEG, JPG, and PNG images are allowed.',
            'image.max' => 'The image size should not exceed 2048 KB.',
        ]);

        $input = $request->except(['_token', '_method']);

        if (!empty($projectTypeImage->image) && $request->hasFile('image')) {
            $imagePath = $projectTypeImage->image;

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        if ($image = $request->file('image')) {
            $destinationPath = 'images/projectTypeImage/image/';
            $profileImage = "projectTypeImage" . "-" . date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = $destinationPath . $profileImage;
        } elseif (!$request->hasFile('image') && !$projectTypeImage->image) {
            unset($input['image']);
        }

        // Update the project type image record
        $projectTypeImage->update($input);

        return redirect()->route('projectTypeImage.index')
            ->with('success', 'Project Type Image updated successfully');
    }

    public function destroy(ProjectTypeImage $projectTypeImage)
    {
        if (!empty($projectTypeImage->image)) {
            $imagePath = $projectTypeImage->image;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }

        $projectTypeImage->delete();

        return redirect()->route('projectTypeImage.index')
            ->with('success', 'ProjectTypeImage deleted successfully');
    }
}
