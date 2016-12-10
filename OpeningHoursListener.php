<?php

namespace Statamic\Addons\OpeningHours;

use Statamic\API\Nav;
use Statamic\Extend\Listener;

class OpeningHoursListener extends Listener
{
    /**
     * The events to be listened for, and the methods to call.
     *
     * @var array
     */
    public $events = [
        'cp.nav.created' => 'addNavItems'
    ];

    public function addNavItems($nav)
    {
        // Create the first level navigation item
        //dd(\Route::getRoutes());
        $store = Nav::item('Opening Hours')->route('addon.settings', 'opening-hours')->icon('calendar');

        // Finally, add our first level navigation item
        // to the navigation under the 'tools' section.
        $nav->addTo('content', $store);
    }
}
