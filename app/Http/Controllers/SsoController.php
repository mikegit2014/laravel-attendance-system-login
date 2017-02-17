<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class SsoController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/test';

    // 修改默认guard的认证字段
	/*public function username()
    {
    	return 'username';
    }*/

    // 登录控制器
    public function login(Request $requests)
    {
        // 获取输入
        $username = $requests->input('username');
        $password = $requests->input('password');

        // 如果没获取到callback，赋值 /user
        $callback = $requests->old('callback') ?: '/user';

        // 判断输入的是否是纯数字
        if (is_numeric($username)) {
            $teacher_condition = ['workid' => $username, 'password' => $password];
            $student_condition = ['stuid' => $username, 'password' => $password];
        } else {
            $teacher_condition = ['username' => $username, 'password' => $password];
            $student_condition = ['username' => $username, 'password' => $password];
        }

        // 先验证是否是 教师
    	if (Auth::guard('teacher')->attempt($teacher_condition)) {
            // 将身份存入session
            $requests->session()->put('identity', 'teacher');
    		return redirect()->intended($callback);

        // 在验证是否是 学生
    	} elseif (Auth::guard('student')->attempt($student_condition)) {
            // 将身份存入session
            $requests->session()->put('identity', 'student');
            return redirect()->intended($callback);

        // 都无法通过验证
        } else {
            return back()->with('error', '账号或密码错误');
        }   
    }

    public function logout(Request $requests)
    {
        $requests->session()->forget('identity');
        auth()->guard('student')->logout();
        auth()->guard('teacher')->logout();
        return redirect('/');
    }

    // 首页
    public function index(Request $requests)
    {
        // 把当前参数闪存
        $requests->flash();

        // 显示视图
    	return view('login');
    }
}
