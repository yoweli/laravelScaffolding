<?php

namespace Yoweli\LaravelScaffold\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Session;
use Yoweli\LaravelScaffold\Repositories\ProjectRepository;
use Yoweli\LaravelScaffold\Repositories\ModelRepository;
use Yoweli\LaravelScaffold\Services\ModelService;
use Yoweli\LaravelScaffold\Services\ProjectService;

class ProjectController extends Controller
{

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public static function addProject(Request $request)
    {
        if ($request->getMethod() === "POST") {

            $projectSaved = ProjectService::saveProject($request->all());
            if ($projectSaved !== false) {
                return redirect('scaffold')->with('status', 'Project created.');
            }

            Session::flash('status', 'A project with that name exists. Choose another name!');
        }

        return view('LaravelScaffold::add-project');
    }

    /**
     * @param $projectId
     * @return Application|RedirectResponse|Redirector
     */
    public static function deleteProject($projectId)
    {
        ProjectService::delete($projectId);
        ModelService::deleteModels($projectId);
        return redirect('scaffold');
    }

    /**
     * @param Request $request
     * @param $projectId
     * @return Application|RedirectResponse|Redirector
     */
    public static function editProject(Request $request, $projectId)
    {
        if ($request->isMethod("POST")) {
            ProjectService::update($request['name'], $projectId);
            return redirect('scaffold');
        }

        $project = ProjectRepository::getProject($projectId);
        return view('LaravelScaffold::edit-project', ['project' => $project]);
    }

    /**
     * @param $projectId
     * @return Application|Factory|View
     */
    public static function viewProject($projectId)
    {
        return view('LaravelScaffold::view-project', [
            'project' => ProjectRepository::getProject($projectId),
            'models' => ModelRepository::getModelsForProject($projectId)
        ]);
    }

    /**
     * @param $projectId
     */
    public static function processProject($projectId)
    {
        dd(file_get_contents('https://yoweli-kachala.com/'));
        foreach (ModelRepository::getModelsForProject($projectId) as $model) {
            dd($model['name']);
        }
        //make API to process this
    }
}
