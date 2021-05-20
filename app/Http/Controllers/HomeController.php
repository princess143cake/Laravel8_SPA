<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Validator as Valid;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home()
    {
        $users = User::all();

        return view('home.home', compact('users'));
     
    }

    public function inbound()
    {
        $users = User::all();

        return view('inbound.inbound');
     
    }

    public function outbound()
    {
        $users = User::all();

        return view('outbound.outbound');
     
    }

    public function store(Request $request){
        if( $request->hasFile('avatar')){

            // $request->validate([
            //     'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            // ]);

            // $imageName = time().'.'.$request->avatar->extension();  
     
            // return  $request->avatar->move(public_path('images'), $imageName);

            $file =  $request->file('avatar');
            $filename= $file->getClientOriginalName();
            $folder = uniqid(). '-' . now()->timestamp;
            $file->storeAs('/avatars/tmp' . $folder, $filename);
            

            // $request->file->store('users', 'storage/public/avatars/tmp');

            // // Store the record, using the new file hashname which will be it's new filename identity.
            // $user = new User([
                
            //     "image" => $request->avatar->hashName()
            // ]);
            // $user->save(); // Finally, save the record.

            return $folder;
        }
        return '';
    }


    public function employeeImageUpload()
    {
    	return view('pages.upload_image');
    }

    public function employeeImageUploadPost(Request $request)
    {

       $error = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        
        ]);

         $file =  $request->file('image');
         $img = $file->getClientOriginalName().'.'.$request->image->extension();
      
        $input['image'] =$file->getClientOriginalName().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $img);
        $data = ['name' => $request->name,
        'email' => $request->email,
        'password' => $request->password,
        'image'=> $img];  //or u can use this 'image'=>$input['image']];
        User::create($data);
        return response()->json([
            'success'   => 'Image Upload Successfully',
            'uploaded_image' => '<img src="/images/'.$img.'" class="img-thumbnail" width="300" />',
            'class_name'  => 'alert-success'
            ]);
      
    return response()->json(['error'=> $error]);
  }

}
