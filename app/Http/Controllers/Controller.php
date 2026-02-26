<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests; //trait to autorize request by users
use Illuminate\Foundation\Bus\DispatchesJobs; //trait for background jobs
use Illuminate\Foundation\Validation\ValidatesRequests; //trait to validate requests

use Illuminate\Routing\Controller as BaseController; //class base controller (basic methods)

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
