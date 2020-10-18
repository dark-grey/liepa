<?php

namespace App\Console\Commands;

use App\Jobs\ParseRbcNewsJob;
use Illuminate\Console\Command;

class ParseRbcNewsCommand extends Command
{
    protected $signature = 'parse:rbc {--count=15 : Количество новостей, которые нужно спарсить}';

    protected $description = 'Парсинг новостей с сайта rbc.ru';

    public function handle()
    {
        $count = $this->option('count');

        if (!is_numeric($count)) {
            $this->error("{$count} not numeric value");
            return;
        }

        ParseRbcNewsJob::dispatch((int)$count);
    }
}
