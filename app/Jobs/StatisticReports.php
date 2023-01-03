<?php

namespace App\Jobs;

use App\Models\Comment;
use App\Models\News;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use App\Mail\SendReportsEmailToUser;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailables\Attachment;


class StatisticReports implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $userEmail;
    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userEmail, $data)
    {
        $this->userEmail = $userEmail;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $postsCount = "не отмечено";
        $newsCount = "не отмечено";
        $commentsCount = "не отмечено";
        $tagsCount = "не отмечено";
        $usersCount = "не отмечено";

        if (isset($this->data['postsCount'])) {
            $postsCount = Post::count();
        }

        if (isset($this->data['newsCount'])) {
            $newsCount = News::count();
        }

        if (isset($this->data['commentsCount'])) {
            $commentsCount = Comment::count();
        }

        if (isset($this->data['tagsCount'])) {
            $tagsCount = Tag::count();
        }

        if (isset($this->data['usersCount'])) {
            $usersCount = User::count();
        }

        $reports = [
            "кол-во постов" => $postsCount,
            "кол-во новостей" => $newsCount,
            "кол-во комментов" =>  $commentsCount,
            "кол-во тегов" =>  $tagsCount,
            "кол-во юзеров" => $usersCount,
        ];

        $columns = array('Title', 'Count');

        $callback = function () use ($reports, $columns) {
            $file = fopen('/storage/reports.scv', 'w');

            foreach ($reports as $key => $value) {
                $columns['Title'] = $key;
                $columns['Count'] = $value;

                fputcsv($file, array($columns['Title'], $columns['Count']));
            }

            fclose($file);

            Mail::to($this->userEmail)->send(new SendReportsEmailToUser('что-то'));
        };
    }

    public function attachments()
    {
        return [
            Attachment::fromPath('/storage/reports.scv'),
        ];
    }
}
