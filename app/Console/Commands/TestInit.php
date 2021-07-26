<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Quote;
use App\Models\Article;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;


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
        Quote::truncate();
        Article::truncate();
        for($i = -1; $i < 9; ++$i){
            for($j = 0; $j < 9; ++$j){
                Quote::create(['text'=>(strval($i) . strval($j)), 'publisher_id'=>1, 'category'=>strval($i), 'author'=>'Великий Роман Анодин']);
            }
        }
        $disk = Storage::disk('public');
        if($disk->exists('articles')){ $disk->delete('articles'); }
        $disk->makeDirectory("articles");
        $disk->makeDirectory("articles/preview_photos");
        $preview_photo_urls = ["https://www.tailwind-kit.com/images/blog/1.jpg",
                               "https://www.tailwind-kit.com/images/blog/2.jpg",
                               "https://www.tailwind-kit.com/images/blog/3.jpg",
                               "https://www.tailwind-kit.com/images/blog/4.jpg",
                               "https://www.tailwind-kit.com/images/blog/5.jpg",
                               "https://www.tailwind-kit.com/images/blog/6.jpg"];
        $preview_photo_paths = [];
        foreach($preview_photo_urls as $i => $preview_photo_url){
            $disk->put('articles/preview_photos/' . strval($i + 1) . ".jpg", file_get_contents($preview_photo_url));
            array_push($preview_photo_paths, Storage::url('articles/preview_photos/' . strval($i + 1) . ".jpg"));
        }
        $categories = ["Video", "Oui", "Oul", "OEL", "Trust", "Test"];
        $titles = ["Work at home", "Cofe braking", "Bloging", "Writeln", "Beautifuling", "Sport"];
        $short_descriptions = ["Work at home, remote, is the new age of the job, every person can work at home....",
                               "The new supercar is here, 543 cv and 140 000$ !!",
                               "The new supercar is here, 543 cv and 140 000$ !!",
                               "The new supercar is here, 543 cv and 140 000$ !!",
                               "The new supercar is here, 543 cv and 140 000$ !!",
                               "The new supercar is here, 543 cv and 140 000$ !!"];
        $times_to_read = [ Carbon::create(0,1,1,0,1), Carbon::create(0,1,1,0,2), Carbon::create(0,1,1,0,3),
                          Carbon::create(0,1,1,0,4), Carbon::create(0,1,1,0,5), Carbon::create(0,1,1,0,6)];
        for($i = 0; $i < 10; ++$i){
            for($j = 0; $j < 6; ++$j){
                Article::create(['preview_photo_path'=>$preview_photo_paths[$j], 'category' => $categories[$j], 'title' => $titles[$j], 'short_description' => $short_descriptions[$j], 'publisher_id' => 1, 'time_to_read' => $times_to_read[$j], 'html'=>""]);
            }
        }
    }
}
