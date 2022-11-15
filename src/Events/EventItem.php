<?php

namespace Buildix\Timex\Events;

use Carbon\Carbon;
use Closure;

class EventItem
{
    protected $eventID;
    protected string $subject;
    protected ?string $body = null;
    public $start;
    public $end;
    protected Carbon $startTime;
    protected Carbon $endTime;


    final public function __construct($eventID)
    {
            $this->eventID($eventID);
    }

    public function eventID($eventID)
    {
        $this->eventID = $eventID;

        return $this;
    }

    public static function make($eventID): static
    {
        return app(static::class, ['eventID' => $eventID]);
    }

    public function start(Carbon $start): static
    {
        $this->start = $start->setHour(0)->setMinute(0)->setSeconds(0)->timestamp;

        return $this;
    }

    public function end(Carbon $end): static
    {
        $this->end = $end->setHour(0)->setMinute(0)->setSeconds(0)->timestamp;

        return $this;
    }

    public function subject(string $subject): static
    {
        $this->subject = $subject;

        return $this;
    }

    public function body(?string $body): static
    {
        $this->body = $body;

        return $this;

    }

    public function getSubject(): string
    {
        return $this->subject;
    }


    public function getBody(): ?string
    {
        return $this->body;
    }

    public function getStart(): Carbon
    {
        return $this->start;
    }

    public function getEnd(): Carbon
    {
        return $this->end;
    }

    public function getEventID()
    {
        return $this->eventID;
    }

}