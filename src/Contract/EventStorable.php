<?php

declare(strict_types=1);

namespace App\Contract;

use App\Model\BaseModel;

interface EventStorable
{
    public function process(BaseModel $model): void;
    public function store(BaseModel $model): void;
}