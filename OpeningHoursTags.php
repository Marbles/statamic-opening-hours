<?php

namespace Statamic\Addons\OpeningHours;

use Carbon\Carbon;
use Spatie\OpeningHours\OpeningHours;
use Spatie\OpeningHours\OpeningHoursForDay;
use Statamic\Extend\Tags;

class OpeningHoursTags extends Tags
{
    protected $openingHours;

    public function init()
    {
        $hours = collect($this->getConfig('hours'))->map(function ($days) {
            return collect($days)->map(function ($day) {
                if ($day['from'] && $day['to']) {
                    return $day['from'] . '-' . $day['to'];
                }

                return '';
            })->filter(function ($day) {
                return $day != "";
            });
        });

        $formattedExceptions = [];
        foreach ($this->getConfig('exceptions') as $exception) {
            $date = $exception['date'];
            if (!isset($formattedExceptions[$date])) {
                $formattedExceptions[$date] = [];
            }

            $formattedExceptions[$date][] = $exception['from'] . '-' . $exception['to'];
        }

        $hours->put('exceptions', $formattedExceptions);

        $this->openingHours = OpeningHours::create($hours->toArray());
    }

    /**
     * The {{ opening_hours }} tag
     * @return array|string
     * @throws \Exception
     */
    public function index()
    {
        throw new \Exception("Opening Hours always requires a parameter.");
    }

    public function forDay()
    {
        return $this->parseLoop($this->displayDay($this->openingHours->forDay($this->getParam('day'))));
    }

    public function forWeek()
    {
        return $this->displayWeek($this->openingHours->forWeek());
    }

    public function forDate()
    {
        $date = Carbon::parse($this->getParam('date'));

        return $this->parseLoop($this->displayDay($this->openingHours->forDate($date)));
    }

    public function exceptions()
    {
        return $this->parseLoop($this->displayExceptions($this->openingHours->exceptions()));
    }

    public function isOpenOn()
    {
        if ($this->openingHours->isOpenOn($this->getParam('day'))) {
            return $this->content;
        }

        return false;
    }

    public function isClosedOn()
    {
        if ($this->openingHours->isClosedOn($this->getParam('day'))) {
            return $this->content;
        }

        return false;
    }

    public function isOpenAt()
    {
        $date = Carbon::parse($this->getParam('date'));

        if ($this->openingHours->isOpenAt($date)) {
            return $this->content;
        }

        return false;
    }

    public function isClosedAt()
    {
        $date = Carbon::parse($this->getParam('date'));

        if ($this->openingHours->isClosedAt($date)) {
            return $this->content;
        }

        return false;
    }

    public function isOpen()
    {
        if ($this->openingHours->isOpen()) {
            return $this->content;
        }

        return false;
    }

    public function isClosed()
    {
        if ($this->openingHours->isClosed()) {
            return $this->content;
        }

        return false;
    }

    protected function displayDay(OpeningHoursForDay $day)
    {
        $times = collect();

        foreach ($day as $time) {
            $times->push([
                'from' => (string) $time->start(),
                'to' => (string) $time->end()
            ]);
        }

        if (!$times->count()) {
            $times->push([
                'from' => '',
                'to' => ''
            ]);
        }

        return $times->toArray();
    }

    protected function displayWeek(array $week)
    {
        $days = collect();

        foreach ($week as $name => $day) {
            $days->put($name, $this->displayDay($day));
        }

        return $days->toArray();
    }

    protected function displayExceptions(array $exceptions)
    {
        $days = collect();

        foreach ($exceptions as $date => $day) {
            $hours = [];

            foreach ($day as $h) {
                $hours[] = ['from' => $h->start(), 'to' => $h->end()];
            }

            $days->push([
                'date' => $date,
                'hours' => $hours
            ]);
        }

        return $days->toArray();
    }
}
