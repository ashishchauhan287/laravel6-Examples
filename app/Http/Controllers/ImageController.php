<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Storage;
 
class ImageController extends Controller
{
    public function index()
    {
//https://iihbucket.s3.eu-west-2.amazonaws.com/images/1584441772Screenshot+from+2020-03-02+10-21-20.png
       $url = 'https://'. env('AWS_BUCKET') .'.s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/';
       $images = [];
       $files = Storage::disk('s3')->files('images');
           foreach ($files as $file) {
               $images[] = [
                   'name' => str_replace('images/', '', $file),
                   'src' => $url . $file
               ];
           }

        return view('image',compact('images'));
    }
    public function store(Request $request)
    {
        $this->validate($request, ['image' => 'required|image']);
        if($request->hasfile('image'))
         {
            $file = $request->file('image');
            $name=time().$file->getClientOriginalName();
            $filePath = 'images/' . $name;
            Storage::disk('s3')->put($filePath, file_get_contents($file));
            return back()->with('success','Image Uploaded successfully');
         }
    }
       public function destroy($image)
   {
       Storage::disk('s3')->delete('images/' . $image);
       return back()->withSuccess('Image was deleted successfully');
   }
}