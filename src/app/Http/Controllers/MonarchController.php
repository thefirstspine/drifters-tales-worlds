<?php

namespace App\Http\Controllers;

use App\Models\MonarchName;
use Carbon\Carbon;

class MonarchController extends Controller
{

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getName()
    {
        $latestMonarchName = MonarchName::orderByDesc('id')->first();
        return response()->json(
            $latestMonarchName instanceof MonarchName ?
                $latestMonarchName->attributesToArray() :
                [
                    'id' => 0,
                    'name' => 'Hierald',
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString(),
                ]
        );
    }

}
