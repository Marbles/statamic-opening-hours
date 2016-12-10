<?php

namespace Statamic\Addons\OpeningHours;

use Statamic\Extend\Fieldtype;

class OpeningHoursFieldtype extends Fieldtype
{
    /**
     * The blank/default value
     *
     * @return array
     */
    public function blank()
    {
        return [
            "opening_hours" => [
                "monday" => [
                    ["from" => '09:00', "to" => '11:00']
                ],
                "tuesday" => [
                    ["from" => '', "to" => '']
                ],
                "wednesday" => [
                    ["from" => '', "to" => '']
                ],
                "thursday" => [
                    ["from" => '', "to" => '']
                ],
                "friday" => [
                    ["from" => '', "to" => '']
                ],
                "saturday" => [
                    ["from" => '', "to" => '']
                ],
                "sunday" => [
                    ["from" => '', "to" => '']
                ]
            ]
        ];
    }

    /**
     * Pre-process the data before it gets sent to the publish page
     *
     * @param mixed $data
     * @return array|mixed
     */
    public function preProcess($data)
    {
        return $data;
    }

    /**
     * Process the data before it gets saved
     *
     * @param mixed $data
     * @return array|mixed
     */
    public function process($data)
    {
        return $data;
    }
}
