<?php

namespace App\Providers;

use App\Models\Tipper;
use Illuminate\Support\ServiceProvider;

class TipperServiceProvider extends ServiceProvider
{

    public function addTipper(string $name): Tipper
    {
        $existingTipper = Tipper::whereName($name)->first();
        if (!($existingTipper instanceof Tipper))
        {
            $tipper = Tipper::create([
                'name' => $name,
            ]);
            $tipper->refresh();
        }
        return $existingTipper instanceof Tipper ? $existingTipper : $tipper;
    }

}
