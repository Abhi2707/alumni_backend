<?php


namespace App\Http\Controllers\Profile;


use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    public function bootstrap(){
        return response(['success' => true],200);
    }
}
