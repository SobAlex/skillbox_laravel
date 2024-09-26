<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Post;
use App\Services\Pushall;
use Illuminate\Support\Facades\Gate;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Post $post)
    {
        if (Gate::check('view-admin-part')) {
            $title = 'Контакты';

            return view('/contacts.index', compact('title'));
        }

        return 'Раздел для администратора';
    }

    public function store(Pushall $pushall)
    {
        $data = \request()->validate([
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Contact::create([
            'email' => request('email'),
            'message' => request('message'),
        ]);

        $pushall->send($data['email'], $data['message']);

        flash('Сообщение отправлено.');

        return back();
    }

    public function show(Post $post)
    {
        if (Gate::check('view-admin-part')) {
            $contacts = Contact::latest()->get();
            $posts = $post->with('tags')->latest()->paginate(5);

            return view('/contacts.show', compact('contacts', 'posts'));
        }

        return 'Раздел для администратора';
    }
}
