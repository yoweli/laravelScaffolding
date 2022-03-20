<?php

namespace Yoweli\LaravelScaffold\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Yoweli\LaravelScaffold\Repositories\ModelRepository;
use Yoweli\LaravelScaffold\Repositories\ProjectRepository;
use Yoweli\LaravelScaffold\Services\ModelService;

class ModelController extends Controller
{

    /**
     * @param int $modelId
     * @return Application|RedirectResponse|Redirector
     */
    public static function deleteModel(int $modelId)
    {
        $model = ModelRepository::getModel($modelId);
        ModelService::deleteModel($modelId);
        return redirect('view-project/' . $model['project_id']);
    }

    /**
     * @param Request $request
     * @param int $projectId
     * @return Application|Factory|View|RedirectResponse|Redirector
     */
    public static function addModel(Request $request, int $projectId)
    {
        if ($request->isMethod('post')) {

            $modelSaved = ModelService::saveModel($request->all(), $projectId);
            if ($modelSaved !== false) {
                return redirect('view-project/' . $projectId)->with('status', 'Model created.');
            }

        }

        return view('LaravelScaffold::add-model', [
            'project' => ProjectRepository::getProject($projectId),
        ]);
    }
}
