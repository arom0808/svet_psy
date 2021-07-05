<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Quote;
use App\Models\Category;

class TestInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Making test data in DB';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        for($i = -1; $i < 4; ++$i){
            for($j = 0; $j < 4; ++$j){
                Quote::create(['text'=>(strval($i) . strval($j)), 'publisher_id'=>1, 'category'=>strval($i), 'author'=>'Великий Роман Анодин']);
            }
        }
    }
}
