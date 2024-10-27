<?php

declare(strict_types=1);

namespace App\Domain\Request\Event;

use App\Domain\Request\BaseRequest;

final class CreateEventRequest extends baseRequest
{
    public function rules(): array
    {
        return [
            'id'         => [self::required(), self::isInt()],
            'user_id'    => [self::required(), self::isInt()],
            'event_type' => [self::required(), self::isString()],
            'timestamp'  => [self::required(), self::isInt()],
            'metadata'   => [],
        ];
    }
}