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
        if (isset($data['postsCount'])) {
            $this->postsCount = Post::count();
        } else {
            $this->postsCount = "не отмечено";
        };

        if (isset($data['newsCount'])) {
            $this->newsCount = News::count();
        } else {
            $this->newsCount = "не отмечено";
        };

        if (isset($data['tagsCount'])) {
            $this->tagsCount = Tag::count();
        } else {
            $this->tagsCount = "не отмечено";
        };

        if (isset($data['commentsCount'])) {
            $this->commentsCount = Comment::count();
        } else {
            $this->commentsCount = "не отмечено";
        };

        if (isset($data['usersCount'])) {
            $this->usersCount = User::count();
        } else {
            $this->usersCount = "не отмечено";
        };
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        echo "кол-во постов: $this->postsCount, кол-во новостей: $this->newsCount, кол-во тегов: $this->tagsCount, кол-во комментов: $this->commentsCount, кол-во юзеров: $this->usersCount,";
    }
}
