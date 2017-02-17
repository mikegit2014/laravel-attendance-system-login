<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
    	$identity = $request->session()->get('identity');

		// 如果是教师
    	if ($identity == 'teacher') {
    		$user = auth()->guard('teacher')->user();
    	// 学生
    	} else {
    		$user = auth()->guard('student')->user();
    	}
    	return view('user', [
    		'identity' => $request->session()->get('identity'),
    		'user' => $user['original']
    	]);
    }
}
