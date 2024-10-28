<?php

declare(strict_types=1);

namespace App\Domain\Request\Event;

use App\Domain\Request\BaseRequest;

final class CreateEventRequest extends baseRequest
{
    public function rules(): array
    {
        return [
            'id'         => [self::required(), self::isInt(), self::minInt(0)],
            'user_id'    => [self::required(), self::isInt(), self::minInt(0)],
            'event_type' => [self::required(), self::isString(), self::isInOptions(['click', 'view', 'purchase'])],
            'timestamp'  => [self::required(), self::isInt(), self::isTimestamp()],
            'metadata'   => [],
        ];
    }
}