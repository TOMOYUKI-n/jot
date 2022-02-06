<?php

namespace App\Http\Controllers;

use App\Http\Resources\Contact as ResourcesContact;
use Illuminate\Http\Request;

class BirthdayController extends Controller
{
    public function index()
    {
        $contacts = request()->user()->contacts()->birthdays()->get();

        return ResourcesContact::collection($contacts);
    }
}
