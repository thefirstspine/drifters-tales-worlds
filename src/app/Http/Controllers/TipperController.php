<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddTipperRequest;
use App\Providers\TipperServiceProvider;

class TipperController extends Controller
{

    public function addTipper(
        AddTipperRequest $request,
        TipperServiceProvider $tipperServiceProvider
    )
    {
        $tipper = $tipperServiceProvider->addTipper($request->post('name'));
        return response()->json($tipper->attributesToArray());
    }

}
