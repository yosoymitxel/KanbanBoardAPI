<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class CreateApiResource extends Command
{
    /**
     * The name and signature of the command.
     *
     * @var string
     */
    protected $signature = 'make:api-resource {name : The name of the API resource}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Create an API resource (model, controller, and route)';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $name = $this->argument('name');

        // Crea el modelo
        $this->createModel($name);

        // Crea el controlador
        $this->createController($name);

        // Crea la ruta API
        $this->createRoute($name);

        $this->info("API resource '$name' created successfully!");
    }

    private function createModel($name)
    {
        $modelPath = app_path('Models/' . $name . '.php');

        if (file_exists($modelPath)) {
            $this->error("Model '$name' already exists!");
            return;
        }

        // Check for migration existence
        $migrationPath = database_path('migrations/*_create_' . strtolower($name) . '_table.php');

        if (!glob($migrationPath)) {
            $this->warn("No migration found for '$name'. Skipping model creation.");
            return;
        }

        // Extract table structure from migration (assuming basic structure)
        $tableName = null;
        $columns = [];
        foreach (glob($migrationPath) as $migrationFile) {
            $migrationContent = file_get_contents($migrationFile);
            preg_match('/\$table->(\w+)\(\)/', $migrationContent, $matches);
            if (isset($matches[1])) {
                $tableName = $matches[1];
            }
            preg_match_all('/\$table->(\w+)\((.*?)\)/', $migrationContent, $matches, PREG_SET_ORDER);
            foreach ($matches as $match) {
                $columns[$match[1]] = $match[2];
            }
        }

        // Generate model content based on extracted data (basic example)
        $modelContent = "<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class $name extends Model
{
    protected \$table = '$tableName';

    protected \$fillable = [";
        foreach ($columns as $column => $details) {
            $modelContent .= "'$column',";
        }
        $modelContent = rtrim($modelContent, ',') . "];
}
";

        // Save the generated model
        file_put_contents($modelPath, $modelContent);
        $this->info("Model '$name' created based on migration.");
    }


    private function createController($name)
    {
        $controllerPath = app_path('Http/Controllers/API/' . $name . 'Controller.php');

        if (file_exists($controllerPath)) {
            $this->error("Controller '$name' already exists!");
            return;
        }

        $this->call('make:controller', ['name' => 'API\\' . $name]);
    }

    private function createRoute($name)
    {
        $routeName = strtolower($name);

        $this->info("Adding route for API resource '$name'");

        Route::apiResource($routeName, 'API\\' . $name . 'Controller');
    }




}
