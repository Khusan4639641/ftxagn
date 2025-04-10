<?php

namespace App\Console\Arguments;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class TriangleBuildArgument
{
    public int $count;

    public function __construct(array $arguments)
    {
        $validator = Validator::make($arguments, [
            'count' => ['required', 'integer', 'min:1'],
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $this->count = (int) $arguments['count'];
    }
}
