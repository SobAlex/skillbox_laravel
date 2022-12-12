<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class StatisticReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $postsCount;
    public $newsCount;
    public $tagsCount;
    public $commentsCount;
    public $usersCount;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->postsCount ? $data['postsCount'] : false;
        $this->newsCount ? $data['newsCount'] : false;
        $this->tagsCount ? $data['tagsCount'] : false;
        $this->commentsCount ? $data['commentsCount'] : false;
        $this->usersCount ? $data['usersCount'] : false;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo "кол-во постов: $postsCount, кол-во новостей: $newsCount, кол-во тегов: $tagsCount, кол-во комментов: $commentsCount, кол-во юзеров: $usersCount,";
    }
}
