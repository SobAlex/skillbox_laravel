<?php

namespace App\Console\Commands;

use App\Mail\SendEmailToUser;
use Illuminate\Console\Command;
use App\User;
use App\Post;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

class SendEmail extends Command
{
    protected $signature = 'send:email {from?} {to?}';

    protected $description = 'Send email to users';

    public function handle()
    {
        $users = User::all();

        $posts = $this->argument('from')
            ? $posts = DB::table('posts')->whereBetween('created_at', [
                $this->argument('from'),
                $this->argument('to')
            ])->get()
            : $posts = Post::all();

        foreach ($users as $user) { {
                Mail::to($user->email)->send(new SendEmailToUser($posts));
            }
        }
    }
}
