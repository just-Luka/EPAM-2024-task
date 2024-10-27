<?php

declare(strict_types=1);

namespace App\Domain\Request;

use App\Trait\Validatable;
use Pecee\Http\Request;

abstract class BaseRequest extends Request
{
    use Validatable;

    protected array $errors = [];

    public function validate(array $data): array
    {
        $rules = $this->rules();

        foreach ($rules as $field => $validators) {
            $value = $data[$field] ?? null;

            foreach ($validators as $validator) {
                $rule = $validator['rule'];
                $message = $validator['message'];

                if (!$rule($value)) {
                    $this->errors[$field][] = $message;
                }
            }
        }

        return $this->errors;
    }

    abstract public function rules(): array;
}