<?php

namespace App\Http\Controllers;

use App\Http\Resources\Contact as ContactResources;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Contact::class);

        return ContactResources::collection(request()->user()->contacts);
    }

    public function store()
    {
        $this->authorize('create', Contact::class);

        request()->user()->contacts()->create(array_merge(['user_id' => request()->user()->id], $this->validateData()));
    }

    public function show(Contact $contact)
    {
        $this->authorize('view', $contact);

        return new ContactResources($contact);
    }

    public function update(Contact $contact)
    {
        $this->authorize('update', $contact);

        $contact->update($this->validateData());
    }

    public function destroy(Contact $contact)
    {
        $this->authorize('delete', $contact);

        $contact->delete();
    }

    private function validateData(): array
    {
        return request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'birthday' => 'required',
            'company' => 'required',
        ]);
    }
}
