<?php

namespace App\Providers;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class GameEventServiceProvider extends ServiceProvider
{

    public const TIME_THRESHOLD = 60;

    /**
     * Bounce an event
     * @param string $name
     * @return Event
     */
    public function bounce(string $name): Event
    {
        $event = Event::firstWhere([
            'name' => $name,
            [
                'created_at',
                '>',
                Carbon::createFromTimestampUTC(time() - self::TIME_THRESHOLD)->toDateTimeString(),
            ]
        ]);

        if ($event instanceof Event)
        {
            $event->registered_at = Carbon::now()->toDateTimeString();
            $event->bounced ++;
        }
        else
        {
            $event = Event::create([
                'name' => $name,
            ]);
            $event->refresh();
        }

        $event->save();

        return $event;
    }

}
