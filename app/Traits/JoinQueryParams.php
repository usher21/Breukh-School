<?php

namespace App\Traits;

trait JoinQueryParams
{
    public function resolve($model, $relations)
    {
        $relationArray = explode(",", $relations);
        $related = null;

        for ($i = 0; $i < count($relationArray); $i++) {
            if (method_exists($model, trim($relationArray[$i]))) {
                $related[] = trim($relationArray[$i]);
            }
        }

        return !is_null($related) ? $model::with($related) : null;
    }
}

