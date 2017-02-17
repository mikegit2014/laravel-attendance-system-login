<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;

class TestController extends Controller
{
    public function index()
    {
    	$stu = DB::connection('tmp')->table('user')->select('id', 'name', 'class')->get();
    	foreach ($stu as $key => $value) {
    		User::create([
    			'id' => $value->id, 
    			'name' => $value->name, 
    			'class' => $value->class,
    			'password' => bcrypt($value->id)
    		]);
    	}
    	/*$user = User::all();
    	dump($user);*/
    }
}
