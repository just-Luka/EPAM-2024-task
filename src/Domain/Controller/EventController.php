<?php

declare(strict_types=1);

namespace App\Domain\Controller;

use App\Attributes\ValidateWith;
use App\Domain\Request\Event\CreateEventRequest;
use App\Facade\App;
use App\Model\Event;
use Pecee\SimpleRouter\SimpleRouter;

final readonly class EventController
{
    public function __construct()
    {

    }

    #[ValidateWith(CreateEventRequest::class)]
    public function create(): void
    {
        $input = SimpleRouter::request()->getInputHandler()->all();

        $event = new Event(
            $input['id'],
            $input['user_id'],
            $input['event_type'],
            $input['timestamp'],
            $input['metadata'] ?? []
        );
    }

    public function fetch(): void
    {
        App::jsonResponse('workspace');
    }
}