<?php

namespace App\Http\Controllers;

use App\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $title = 'Контакты';

        return view('/contacts.index', compact('title'));
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
        $title = 'Обращения';

        $contacts = Contact::latest()->get();

        return view('/contacts.show', compact( 'title', 'contacts'));
    }

}
