<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Config, Validator;

class CategoryController extends Controller
{
    public function index() {
        // $products = Product::all(); // get all Product Data
        $category = Category::paginate($this->rp);
        return view('category/index', compact('category'));
    }

    var $rp = 5; //show product 

    public function search(Request $request){
        $query = $request->q;
        if($query){
            $category = Category::where('id','like','%'.$query.'%')->orWhere('name','like','%'.$query.'%')->paginate($this->rp);;
        } else {
            $category = Category::paginate($this->rp);
        } return view('category/index', compact('category'));
    }
    // $id ใช้เมื่อไม่มีฟอร์ม
    public function edit($id = null){
        $categories = Category::pluck('name','id')->prepend('เลือกรายการ',"");
        if($id){
            $category = Category::where('id',$id)->first();
            return view('category/edit')->with('category',$category)->with('categories',$categories);
        } else {
            return view('category/add')->with('categories',$categories);
        }
    }
    // Request ใช้เอาข้อมูลจาก Form
    public function update(Request $request) {
        $rules = array(
        'id' => 'required',
        'name' => 'required', 
        );
        
        $messages = array(
        'required' => 'กรุณากรอกข้อมูล :attribute ให้ครบถ้วน', 'numeric' => 'กรุณากรอกข้อมูล
        :attribute ให้เป็นตัวเลข',
        );
        
        $id = $request->id;
        $temp = array(
        'id' => $request->id,
        'name' => $request->name,
        );

        $validator = Validator::make($temp, $rules, $messages);
        if ($validator->fails()) {
        return redirect('category/edit/'.$id)
        ->withErrors($validator)
        ->withInput();
        }
        $category = Category::find($id);
        $category->id = $request->id;
        $category->name = $request->name;
        $category->save();
        return redirect('category')
        ->with('ok', true)
        ->with('msg', 'บันทึกข้อมูลเรียบร้อยแล้ว');
        }

        public function insert(Request $request){
            $category = new Category();
            $category->id = $request->id;
            $category->name = $request->name;
            $category->save();

            
            return redirect('category')->with('ok',true)->with('msg','เพิ่มข้อมูลเรียบร้อยแล้ว');
        }

        public function remove($id){
            Category::find($id)->delete();
            return redirect('category')->with('ok',true)->with('msg','ลบข้อมูลสำเร็จ');
        }
    
}