<?php

namespace Yoweli\LaravelScaffold\Http\Controllers;

use App\Http\Controllers\Controller;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use GuzzleHttp\Client;
use Yoweli\LaravelScaffold\Repositories\ProjectRepository;
use Yoweli\LaravelScaffold\Services\ScaffoldingService;

class ScaffoldingController extends Controller
{
    /**
     * @param $projectId
     */
    public static function processProject($projectId)
    {
        //user must be registered
        ScaffoldingService::clearMigrations();
        ScaffoldingService::backupRoutesFile();
        //push DB data to service provider

        $project = ProjectRepository::getProject($projectId);
        $models = ScaffoldingService::getPreparedModels($projectId);

//        $apiData = [
//            'project' => $project['name'],
//            'models' => $models
//        ];


        foreach (self::getData($models) as $data) {
            ScaffoldingService::CreateFile($data);
        }
    }

    /**
     * @param array $models
     * @return mixed
     * @throws GuzzleException
     */
    private static function getData(array $models)
    {
        $client = new Client();
        return json_decode($client->request('GET', "http://localhost:80001/api/get-models")->getBody()->getContents());
    }

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
