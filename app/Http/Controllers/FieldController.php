<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::all()
            ->groupBy('y')
            ->groupBy('x');

        return view('field.index', compact('countries'));
    }
}
