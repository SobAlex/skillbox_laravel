<?php

namespace App\Console\Commands;

use App\Mail\SendEmailToUser;
use App\Models\Post;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

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

        foreach ($users as $user) {
            {
                Mail::fake()->to($user->email)->send(new SendEmailToUser($posts));
            }
        }
    }
}
