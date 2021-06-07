<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $comp = Company::latest()->get();

        $employee = Employee::latest()->with('companies')->paginate(10);
        //dd($employee);
        return view('employees',['emp' => $employee,'com' => $comp]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'com_name' => 'required',
            'emp_fname' => 'required|max:255',
            'emp_lname' => 'required|max:255',
            'emp_email' => 'required|email',
            'emp_phone' => 'required',
        ]);
        
        Employee::updateOrCreate(['id' => $request->emp_id],[
            'company_id' => $request->com_name,
            'first_name' => $request->emp_fname,
            'last_name' => $request->emp_lname,
            'email' => $request->emp_email,
            'phone' => $request->emp_phone
        ]);

        return back()->with('status','Employee Added');
    }

    public function edit(Request $request){
        $emp = Employee::find($request->id);

        return response()->json($emp);
    }

    public function delete(Request $request){        
        Employee::where('id',$request->id)->delete();
    }

}
