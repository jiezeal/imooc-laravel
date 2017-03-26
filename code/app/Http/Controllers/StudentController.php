<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    /**
     * 学生列表
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $students = Student::paginate(20);
        
        return view('student.index', compact('students'));
    }

    /**
     * 新增界面
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Request $request){
        $student = new Student();
        return view('student.create', compact('student'));
    }

    /**
     * 新增学生
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request){
        // 控制器验证
        $this->validate($request, [
            'Student.name' => 'required|min:2|max:20',
            'Student.age' => 'required|integer',
            'Student.sex' => 'required|integer'
        ], [
            'required' => ':attribute 为必填项',
            'min' => ':attribute 长度不符合要求',
            'integer' => ':attribute 必须为整数'
        ], [
            'Student.name' => '姓名',
            'Student.age' => '年龄',
            'Student.sex' => '性别',
        ]);

        // Validator类验证
        /*$validator = \Validator::make($request->input(), [
            'Student.name' => 'required|min:2|max:20',
            'Student.age' => 'required|integer',
            'Student.sex' => 'required|integer'
        ], [
            'required' => ':attribute 为必填项',
            'min' => ':attribute 长度不符合要求',
            'integer' => ':attribute 必须为整数'
        ], [
            'Student.name' => '姓名',
            'Student.age' => '年龄',
            'Student.sex' => '性别',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }*/

        $data = $request->input('Student');

        if(Student::create($data)){
            return redirect('/student')->with('success', '添加成功');
        }else{
            return redirect()->back();
        }
    }

    /**
     * 修改界面
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id){
        $student = Student::find($id);
        return view('student.edit', compact('student'));
    }

    /**
     * 修改操作
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|string
     */
    public function update(Request $request, $id){
        $student = Student::find($id);

        // 控制器验证
        $this->validate($request, [
            'Student.name' => 'required|min:2|max:20',
            'Student.age' => 'required|integer',
            'Student.sex' => 'required|integer'
        ], [
            'required' => ':attribute 为必填项',
            'min' => ':attribute 长度不符合要求',
            'integer' => ':attribute 必须为整数'
        ], [
            'Student.name' => '姓名',
            'Student.age' => '年龄',
            'Student.sex' => '性别',
        ]);

        $data = $request->input('Student');
        $student->name = $data['name'];
        $student->age = $data['age'];
        $student->sex = $data['sex'];

        if($student->save()){
            return redirect('/student')->with('success', '修改成功');
        }else{
            return redirect('/student/' . $id . '/edit').with('error', '修改失败');
        }
    }

    /**
     * 学生详情
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id){
        $student = Student::find($id);
        return view('student.show', compact('student'));
    }

    public function destroy($id){
        $student = Student::find($id);
        if($student->delete()){
            return response()->json(['ServerTime' => time(), 'ServerNo' => 'SN000', 'ResultData' => '删除成功']);
        }else{
            return response()->json(['ServerTime' => time(), 'ServerNo' => 'SN400', 'ResultData' => '删除失败']);
        }
    }
}
