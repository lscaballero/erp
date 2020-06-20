<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ContractIndefinite;


class ContractIndefiniteController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
    }
}
