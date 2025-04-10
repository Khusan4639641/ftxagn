<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\TriangleBuilderService;
use App\Console\Arguments\TriangleBuildArgument;
use Illuminate\Validation\ValidationException;

class BuildTriangle extends Command
{
    protected $signature = 'triangle:build {count}';
    protected $description = 'Проверка, можно ли построить равнобедренный треугольник из N элементов.';

    protected TriangleBuilderService $service;

    public function __construct(TriangleBuilderService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    public function handle()
    {
        try {
            $args = new TriangleBuildArgument($this->arguments());
            $result = $this->service->build($args->count);

            if (is_string($result)) {
                $this->error($result);
            } else {
                foreach ($result as $line) {
                    $this->line(implode(' ', $line));
                }
            }
        } catch (ValidationException $e) {
            foreach ($e->errors() as $messages) {
                foreach ($messages as $message) {
                    $this->error($message);
                }
            }
        }
    }
}
