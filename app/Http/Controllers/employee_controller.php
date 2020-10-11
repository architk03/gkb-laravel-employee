<?php

namespace App\Http\Controllers;

use App\employee;
use Illuminate\Http\Request;

class employee_controller extends Controller
{
    //
    public function index()
    {
        return view('Employee');
    }
    public function store(Request $request)
    {
        $employee = new employee();
        $employee->FirstName= $request->input('FirstName');
        $employee->LastName= $request->input('LastName');
        $employee->Email= $request->input('Email');
        //$employee->Gender= $request->input('Gender');
        $employee->Gender=$request->get('Gender');
        $checkbox = implode(",", $request->get('Hobbies'));
        $employee->Hobbies = $checkbox;
        //$employee->Hobbies= $request->input('Hobbies');

        if($request->hasfile('Picture'))
        {
            $file= $request->file('Picture');
            $extension= $file->getClientOriginalExtension();
            $filename= time().'.'.$extension;
            $file->move('uploads/employee/',$filename);
            $employee->Picture= $filename;
        } else
            {
                return $request;
                $employee->Picture='';
            }

        $employee->save();
        return view('employee')->with('employee',$employee);


    }

}
