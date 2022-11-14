<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SearchResource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\SplFileInfo;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;

        // just for demonstration, you can exclude models from the searches here
        $toExclude = [\App\Models\Email::class];

        // getting all the model files from the model folder
        $files = File::allFiles(app()->basePath() . '/app/Models');

        // to get all the model classes
        $results = collect($files)->map(function (SplFileInfo $file) {
            $filename = $file->getRelativePathname();
            if (substr($filename, -4) !== '.php') return null; // Check If File Is PHP File
            return substr($filename, 0, -4); // Removing .php

        })->filter(function (?string $classname) use ($toExclude) {
            if ($classname === null)  return false;
            // using reflection class to obtain class info dynamically
            $reflection = new \ReflectionClass($this->modelNamespacePrefix() . $classname);
            // making sure the class extended eloquent model
            $isModel = $reflection->isSubclassOf(Model::class);
            // making sure the model implemented the searchable trait
            $searchable = $reflection->hasMethod('search');
            // filter model that has the searchable trait and not in exclude array
            return $isModel && $searchable && !in_array($reflection->getName(), $toExclude, true);

        })->map(function ($classname) use ($keyword) {
            // for each class, call the search function
            $model = app($this->modelNamespacePrefix() . $classname);

            return $model::search($keyword)->get()->map(function ($modelRecord) use ($keyword, $classname) {
                // joining the fields together
                $serializedValues = collect($modelRecord->toSearchableArray())->join('<br>');

                $text = str_replace($keyword, "<b class='search-keyword'>$keyword</b>", $serializedValues);
                // use $slice as the match, otherwise if undefined we use the first 20 character of serialisedValues
                $modelRecord->setAttribute('match', $text);
                // setting the model name
                $modelRecord->setAttribute('model', $classname);
                // setting the resource link
                $modelRecord->setAttribute('link', $this->link($modelRecord, $keyword));

                return $modelRecord;
            });
        });

        $arr = [];
        foreach ($results as $data) {
            if ($data->count() == 0) continue;
            $arr[$data->first()->getTable()] = SearchResource::collection($data);
        }
        return $arr;
        // using a standardised site search resource
    }

    /** Helper function to retrieve resource URL
     * @param Model $model
     * @return string|string[]
     */
    private function link(Model $model, $keyword)
    {
        $modelName = $model->getTable();
        if (Route::has(ROUTE_PREFIX."$modelName.show"))
                return routeHelper("$modelName.show", $model->id);
        $route = routeHelper("$modelName.index");

        $fields = array_keys($model->toSearchableArray());
        foreach ($fields as $filed)
            $route .= (reset($fields) == $filed ? '?' : '&')."{$filed}={$keyword}";

        return $route;
    }

    /** A helper function to generate the model namespace
     * @return string
     */
    private function modelNamespacePrefix()
    {
        return app()->getNamespace() . 'Models\\';
    }
}
