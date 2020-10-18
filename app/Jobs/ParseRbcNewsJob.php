<?php

namespace App\Jobs;

use App\Parsers\RbcNewsParser;
use App\Service\RbcNewsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ParseRbcNewsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $count;

    public function __construct(int $count)
    {
        $this->count = $count;
    }

    public function handle(RbcNewsParser $parser, RbcNewsService $service)
    {
        $data = $parser->parse($this->count);
        $service->updateOrCreateModels($data);
    }
}
