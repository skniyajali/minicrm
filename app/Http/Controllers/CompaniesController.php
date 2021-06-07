<?php

namespace App\Http\Controllers;

use App\Models\Company;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;


class CompaniesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $company = Company::latest()->paginate(10);
        
        return view('companies',['comp' => $company]);
    }

    public function store(Request $request){
        $this->validate($request,[
            'com_name' => 'required|max:255',
            'com_email' => 'required|email',
            'com_web' => 'required|url',
            'com_logo' => 'file'
        ]);
        $data = [
            'name' => $request->com_name,
            'email' => $request->com_email,
            'website' => $request->com_web
        ];

        if($request->com_logo != ''){
            
            File::delete(public_path('image/'.$request->old_image));
        
            $image = $request->file('com_logo');
            $imageName = time().'.'.$image->extension();
            $image->move(public_path('image'),$imageName);
            $data['logo'] = $imageName;
        }
 

        Company::updateOrCreate(['id' => $request->id],$data);

        return back()->with('status','Company Added');
    }

    public function edit(Request $request){
        $comp = Company::find($request->id);

        return response()->json($comp);
    }

    public function delete(Request $request){
        $data = Company::where('id',$request->id)->first(['logo']);
        File::delete(public_path('image/'.$data->logo));
        Company::where('id',$request->id)->delete();
    }


}
