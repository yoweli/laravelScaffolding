<?php

namespace Yoweli\LaravelScaffold\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Yoweli\LaravelScaffold\Repositories\ProjectRepository;

class ScaffoldingController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('LaravelScaffold::index', [
            'projects' => ProjectRepository::getAllProjects()
        ]);
    }

}
