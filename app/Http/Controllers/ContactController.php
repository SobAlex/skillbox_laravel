<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Support\Facades\Gate;
use App\Post;

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

    public function store()
    {
        $this->validate(request(), [
            'email' => 'required|email',
            'message' => 'required',
        ]);

        Contact::create([
            'email' => request('email'),
            'message' => request('message'),
        ]);

        return redirect('/obrashcheniya');
    }

    public function show()
    {
        if (Gate::check('view-admin-part')) {

            $title = 'Обращения';

            $contacts = Contact::latest()->get();

            $posts = \App\Post::all();

            return view('/contacts.show', compact('title', 'contacts', 'posts'));
        }
        return 'Раздел для администратора';
    }
}
