<?php
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Validator,Redirect,Response,File;
Use App\Document;
 
class DocumentController extends Controller
{
 
    public function index()
    {
        return view('document');
    }
 
    public function store(Request $request)
    {
        request()->validate([
            'file' => 'required',
            'file.*' => 'mimes:doc,pdf,docx,txt,zip,jpeg,jpg,png'
        ]);
        if($request->hasfile('file')) { 
            foreach($request->file('file') as $file)
            {
                $fileName = time().rand(0, 1000).pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $fileName = $fileName.'.'.$file->getClientOriginalExtension();
                $file->move(public_path(),$fileName);
                $input['file'] = $fileName;
                Document::create($input);
            }
        }         
                
        \Session::put('success', 'Document will be uploaded.');
        return redirect()->route('document'); 
    }
}   
