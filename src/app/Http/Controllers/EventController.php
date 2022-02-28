<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventPostRequest;
use App\Models\Event;
use App\Models\MonarchName;
use App\Providers\GameEventServiceProvider;
use App\Providers\MessagingServiceProvider;
use App\Rules\SaveData;

class EventController extends Controller
{

    /**
     * @param EventPostRequest $request
     * @param GameEventServiceProvider $gameEventServiceProvider
     * @param MessagingServiceProvider $messagingServiceProvider
     * @return \Illuminate\Http\JsonResponse
     */
    public function bounce(
        EventPostRequest $request,
        GameEventServiceProvider $gameEventServiceProvider,
        MessagingServiceProvider $messagingServiceProvider,
    )
    {
        // Get validated fields
        $validated = $request->validated();
        $validated['save'] = SaveData::unserializeSaveData($validated['save']);

        // Bounce the event
        $event = $gameEventServiceProvider->bounce(
            $validated['name']
        );

        // Send message on only first boucned event
        if ($event->bounced === 1)
        {
            $messagingServiceProvider->sendMessage(
                '*',
                "DrifterTales:connectedworld:{$validated['name']}",
                [
                    'user' => $request->attributes->get('user_id'),
                    'username' => $validated['save']['username'],
                ]
            );
        }

        // On event named "monarchKilled", store it
        if ($event->name === Event::EVENT_NAME__MONARCH_KILLED)
        {
            MonarchName::create([
                'name' => $validated['save']['username'],
            ]);
        }

        return response()->json($event->attributesToArray());
    }

}
