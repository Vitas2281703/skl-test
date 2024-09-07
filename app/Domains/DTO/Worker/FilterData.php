<?php

namespace App\Domains\DTO\Worker;

use Spatie\LaravelData\Data;

class FilterData extends Data
{
    /**
     * @param  int[]  $type_ids
     */
    public function __construct(
        public readonly ?array $type_ids = null,
        public readonly ?int $page = 1,
        public readonly ?int $per_page = 10,
    ) {}
}
