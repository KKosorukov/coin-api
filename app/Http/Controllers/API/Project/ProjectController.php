<?php

namespace App\Http\Controllers\API\Project;

use App\Http\Controllers\Controller;
use Mockery\Exception;

use App\Http\Resources\ProjectResource;
use App\Models\Backoffice\Project;
use App\Http\Requests\CreateProject;
use App\Http\Requests\EditProject;

use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Project class for API access
 *
 * Class ProjectController
 * @package App\Http\Controllers\API\Project
 */

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', [
            'only' => [
                'getAllProjects',
                'createProject',
                'getProject',
                'updateProject',
                'deleteProject'
            ]
        ]);
    }

    /**
     * Display a listing of the advs
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getAllProjects()
    {
        return ProjectResource::collection(Project::all());
    }

    /**
     * Store a newly created resource in storage
     *
     * @param CreateProject $request
     * @return ProjectResource
     */
    public function createProject(CreateProject $request) {
        if($request->validated()) {

            $user = auth()->user();

            if($user->hasAccess('projects.create')) {

                $newProject = Project::create($request->all() + [
                    'user_id' => $user->id
                ]);

                return ProjectResource::make($newProject);
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Display the specified resource
     *
     * @param $project
     * @return ProjectResource
     */
    public function getProject($project)
    {
        $project = Project::where([
            'id' => $project,
            'user_id' => auth()->user()->id
        ])->first();

        return $project ? new ProjectResource($project) : [];
    }

    /**
     * Update the specified resource in storage
     *
     * @param EditProject $request
     * @return array
     */
    public function updateProject(EditProject $request)
    {
        if($request->validated()) {
            $user = auth()->user();

            $updatedProject = Project::where([
                'id' => $request->project,
                'user_id' => $user->id
            ])->first();

            if(!$updatedProject) {
                throw new NotFoundHttpException('Project not found');
            }

            if($user->hasAccess('projects.edit') || ($user->hasAccess('projects.edit-own') && $user->id == $updatedProject->user_id)) {
                $updatedProject->update($request->all());
                return [
                    'success' => (bool)$updatedProject,
                    'data' => ProjectResource::make($updatedProject)
                ];
            } else {
                return $this->returnForbidden();
            }
        }
    }

    /**
     * Remove the specified adv from storage.
     *
     * @param $id
     * @return array
     */
    public function deleteProject($id)
    {
        $user = auth()->user();

        $projectModel = Project::find($id);
        if(!$projectModel) {
            throw new NotFoundHttpException('Project not found');
        }

        if($user->hasAccess('projects.delete') || ($user->hasAccess('projects.delete-own') && $user->id == $projectModel->user_id)) {
            $answer = ProjectResource::make($projectModel);
            $projectModel->delete();
            return [
                'success' => (bool)$answer,
                'data' => $answer
            ];
        } else {
            return $this->returnForbidden();
        }
    }
}