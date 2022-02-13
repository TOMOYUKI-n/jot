<?php

namespace App\Http\Controllers;

use App\Http\Resources\Contact as ResourcesContact;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function index()
    {
        $data = request()->validate([
            'searchTerm' => 'required',
        ]);

        $contacts = Contact::search($data['searchTerm'])
            ->where('user_id', request()->user()->id)    
            ->get();

        return ResourcesContact::collection($contacts);
    }
}
