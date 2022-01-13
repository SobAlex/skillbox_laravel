<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Post;
use App\Mail\SendEmailToUser;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:email
    {users?* : Пользователи}
    {--date1 : Начало периода}
    {--date2 : Конец периода}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email to users';

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

        $users = $this->argument('users')
            ? User::findOrFail($this->argument('users'))
            : User::all();

        $posts = $this->arguments('date1', 'date2')
            ? Post::whereBetween('created_at', [$this->argument('date1'), $this->argument('date2')])->get()
            : Post::all();

        $users->map->notify(new SendEmailToUser($posts));
    }
}
