<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrefixController extends Controller
{
    public function autoPrefix($type,$objModel,$columnName)
   	{
   		return generatePrefix($type,$objModel,$columnName);
   	}
}
