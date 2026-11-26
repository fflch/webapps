<?php

namespace App\Services;

use App\Models\AppVariable;
use App\Models\ImageVariable;
use Illuminate\Support\Facades\DB;
use App\Models\Webapp;
use Illuminate\Support\Collection;

class VariableService
{
    public function handleVariableStore(array $request)
    {
        $imageVariable = DB::transaction(function () use ($request) {
            $imageVariable = ImageVariable::create([
                'name' => $request['name'],
                'image_id' => $request['image_id']
            ]);

            $dockerimage = $imageVariable->image;
            $webapps = $dockerimage->apps;

            foreach ($webapps as $webapp) {
                AppVariable::create([
                    'app_id' => $webapp->id,
                    'image_variable_id' => $imageVariable->id
                ]);
            }

            return $imageVariable;
        });

        return $imageVariable;
    }

    public function refreshAppVariables(Webapp $webapp)
    {
        return DB::transaction(function () use ($webapp) {
            $app = Webapp::whereKey($webapp->id)->lockForUpdate()->firstOrFail();

            $missing = $this->getMissingVariables($app);

            if ($missing->isEmpty()) {
                return collect();
            }

            return $missing->map(
                fn(ImageVariable $imageVariable) =>
                $app->AppVariables()->create([
                    'image_variable_id' => $imageVariable->id
                ])
            );
        });
    }

    public function hasAllVariables(Webapp $webapp): bool
    {
        return ! $this->missingQuery($webapp)->exists();
    }

    public function getMissingVariables(Webapp $webapp): Collection
    {
        return $this->missingQuery($webapp)->get();
    }

    private function missingQuery(Webapp $webapp)
    {
        return ImageVariable::where('image_id', $webapp->image_id)
            ->whereDoesntHave('appVariables', fn($q) => $q->where('app_id', $webapp->id));
    }
}
