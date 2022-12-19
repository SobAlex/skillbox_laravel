<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Notifications\ReportsCreate;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;


class StatisticReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    // public $data = [];

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userEmail, $data)
    {
        $this->$userEmail = $userEmail;
        $this->$data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dataD = json_decode($this->$data);
        dd($dataD);
        $postsCount = $dataD['postsCount'];
        $newsCount = $dataD['newsCount'];
        $tagsCount = $dataD['tagsCount'];
        $commentsCount = $dataD['commentsCount'];
        $usersCount = $dataD['usersCount'];

        if (!isset($data['postsCount'])) {
            $postsCount = "не отмечено";
        }

        if (!isset($data['newsCount'])) {
            $newsCount = "не отмечено";
        }

        if (!isset($data['tagsCount'])) {
            $tagsCount = "не отмечено";
        }

        if (!isset($data['commentsCount'])) {
            $commentsCount = "не отмечено";
        }

        if (!isset($data['usersCount'])) {
            $usersCount = "не отмечено";
        }

        dd($this->$data);

        Mail::to($this->$userEmail)->send(new ReportsCreate("отчет тест значение"));

        echo "кол-во постов: $this->postsCount, кол-во новостей: $this->newsCount, кол-во тегов: $this->tagsCount, кол-во комментов: $this->commentsCount, кол-во юзеров: $this->usersCount,";
    }
}
