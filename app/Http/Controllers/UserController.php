<?php

namespace App\Http\Controllers;

use App\Models\User; // import User model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{

    public $rp = 10; //show user

    public function index()
    {
        // ดึงข้อมูลผู้ใช้ทั้งหมด
        $users = User::all();
        return view('user.index', compact('users'));
    }
    public function search(Request $request)
    {

        $query = $request->q;
        if ($query) {
            $users = User::where('id', 'like', '%' . $query . '%')->orWhere('name', 'like', '%' . $query . '%')->orWhere('email', 'like', '%' . $query . '%')->paginate($this->rp);
        } else {
            $users = User::paginate($this->rp);
        }return view('user/index', compact('users'));
    }

    public function edit($id = null)
    {
        $user = User::find($id);
        $Dropdown = [
            '' => 'เลือกรายการ',
            'admin' => 'admin',
            'employee' => 'employee',
            'customer' => 'customer',
        ];

        User::where('id', $id)->first();
        return view('user/edit')
            ->with('user', $user)
            ->with('Dropdown', $Dropdown);

    }

    public function update(Request $request)
    {
        $rules = array(
            'name' => 'required', 'email' => 'required',
            'level' => 'required',
        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
        :attribute ให้เป็นตัวเลข',
        );
        $id = $request->id;
        $temp = array(
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->level,
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('user/edit/' . $id)
                ->withErrors($validator)
                ->withInput();
        }


        
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->level = $request->level;

        $user->save();
        return redirect('user')
            ->with('ok', true)
            ->with('msg', 'แก้ไขข้อมูลลูกค้าเรียบร้อยแล้ว');

    }
    public function add($id = null)
    {
        $user = User::find($id);
        $Dropdown = [
            '' => 'เลือกรายการ',
            'admin' => 'admin',
            'employee' => 'employee',
            'customer' => 'customer',
        ];

        return view('user/add')->with('Dropdown', $Dropdown);
    }
    

    public function remove($id)
    {
        User::find($id)->delete();
        return redirect('user')->with('ok', true)->with('msg', 'ลบข้อมูลลูกค้าเรียบร้อยแล้ว');
    }


    public function insert(Request $request)
    {
        $rules = array(
            'name' => 'required', 'email' => 'required',
            'password' => 'required' , 'level' => 'required'
        );

        $messages = array(
            'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
        :attribute ให้เป็นตัวเลข',
        );
        $id = $request->id;
        $temp = array(
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'level' => $request->level,
        );
        
        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
            return redirect('user/add/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->level = $request->level;
        $user->save();
        return redirect('user')->with('ok', true)->with('msg', 'เพิ่มข้อมูลผู้ใช้เรียบร้อยแล้ว');
    }
}