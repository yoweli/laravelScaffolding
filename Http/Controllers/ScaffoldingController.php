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
use Yoweli\LaravelScaffold\Repositories\BaseRepository;
use Yoweli\LaravelScaffold\Services\ProjectService;

class ScaffoldingController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('LaravelScaffold::index', [
            'projects' => BaseRepository::getAllProjects()
        ]);
    }

    /**
     * @param Request $request
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public function addProject(Request $request)
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
    public function deleteProject($projectId)
    {
        ProjectService::delete($projectId);
        ProjectService::deleteModels($projectId);
        return redirect('scaffold');
    }

    /**
     * @param $modelId
     * @return Application|RedirectResponse|Redirector
     */
    public function deleteModel($modelId)
    {
        $model = ProjectService::getModel($modelId);
        ProjectService::deleteModel($modelId);
        return redirect('view-project/' . $model['project_id']);
    }

    /**
     * @param Request $request
     * @param $projectId
     * @return Application|RedirectResponse|Redirector
     */
    public function editProject(Request $request, $projectId)
    {
        if ($request->isMethod("POST")) {
            ProjectService::update($request['name'], $projectId);
            return redirect('scaffold');
        }

        $project = BaseRepository::getProject($projectId);
        return view('LaravelScaffold::edit-project', ['project' => $project]);
    }

    /**
     * @param $projectId
     * @return Application|Factory|View
     */
    public function viewProject($projectId)
    {
        return view('LaravelScaffold::view-project', [
            'project' => BaseRepository::getProject($projectId),
            'models' => BaseRepository::getModelsForProject($projectId)
        ]);
    }

    /**
     * @param Request $request
     * @param $projectId
     * @return Application|Factory|View
     */
    public function addModel(Request $request, $projectId)
    {
        if ($request->isMethod('post')) {

            $modelSaved = ProjectService::saveModel($request->all(), $projectId);
            if ($modelSaved !== false) {
                return redirect('view-project/' . $projectId)->with('status', 'Model created.');
            }

        }

        return view('LaravelScaffold::add-model', [
            'project' => BaseRepository::getProject($projectId),
        ]);
    }

    /**
     * @param $projectId
     */
    public function processProject($projectId)
    {
        foreach(BaseRepository::getModelsForProject($projectId) as $model) {
            dd($model['name']);
        }
        //make API to process this
    }

}
