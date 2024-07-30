<?php

namespace App\Http\Controllers\RestAPI;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return ProjectResource::collection(Project::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        //
        $project = new Project();
        $project->fill($request->validated());
        $project->save();

        return new ProjectResource($project);
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //
        if ($project) {
            # code...
            return new ProjectResource($project);
        }
        return response()->json(['message' => 'Project not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        //
        if ($project) {
            # code...
            $project->update($request->validated());

            return new ProjectResource($project);
        }
        return response()->json(['message' => 'Project not found'], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
        if ($project) {
            # code...
            $project->delete();

            return response()->json(['message' => 'Project deleted successfully'], 200);
        }
        return response()->json(['message' => 'Project not found'], 404);
    }
}
