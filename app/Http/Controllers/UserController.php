<?php

namespace App\Http\Controllers;

use App\Http\Middleware\AdminGroup;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * This is a constructor function
     */
    public function __construct()
    {
        return $this->middleware(AdminGroup::class, [
            'except' => [
                'update', 
                'view_profile',
                'view_password',
                'reset_password'
            ]
        ]);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::all();
        return view('users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles=Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'string|max:50|min:5',
            'mobile' => 'required|min:10|max:10',
            'address' => 'required',
            'email' => 'email|required|unique:users',
            'role' => 'required',
            'image'=>'mimes:png,jpg,jpeg,bmp|nullable|max:1999'
        ])->validate();

        $image='null';
        
        if ($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = $filename . '_' . time() . '.' . $extension;
            $request->file('image')->storeAs('public/profile_images', $image);
        }
        $user = new User;
        $user->email = $request->get('email');
        $user->password = bcrypt("user12345");
        $user->role_id = $request->get('role');
        $user->name = $request->get('name');
        $user->mobile = $request->get('mobile');
        $user->address = $request->get('address');
        if($image!='null')
            $user->profile=$image;
        $user->save();

        return redirect()->route('users.index')->with('success', 'User has been registered!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $roles=Role::all();
        return view('users.edit', compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */    
    public function update(Request $request, $id)
    {
        Validator::make($request->all(), [
            'name' => 'string|max:50|min:5',
            'mobile' => 'required|min:10|max:10',
            'address' => 'required',
            'email' => 'email|required|unique:users,email,'.$id,
            //'role' => 'required',
            'image'=>'mimes:png,jpg,jpeg,bmp|nullable|max:1999'
        ])->validate();

        $image='null';
        
        if ($request->hasFile('image')) {
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $image = $filename . '_' . time() . '.' . $extension;
            $request->file('image')->storeAs('public/profile_images', $image);
        }
        $user =  User::find($id);
        $user->email = $request->get('email');
        if(!$request->get('updateProfile'))
            $user->role_id = $request->get('role');
        $user->name = $request->get('name');
        $user->mobile = $request->get('mobile');
        $user->address = $request->get('address');
        if($image!='null'){
            if($user->profile!=NULL)
                Storage::delete('public/profile_images/'.$user->profile);
            $user->profile=$image;
        }
        $user->save();

        if($request->get('updateProfile'))
            return redirect()->route('change-profile.view')->with('success', 'User has been successfully Updated!');
        else
            return redirect()->route('users.index')->with('success', 'User has been successfully Updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user=User::find($id);
        //kama picture ipo ataifuta 
        if($user->profile!=NULL)
                Storage::delete('public/profile_images/'.$user->profile);
        //kama haipo picture atamfuta user peke yake
        User::destroy($id);
        return redirect()->route('users.index')->with('success','User has been successfully deleted!!');

    }
    public function view_password(){

        return view('users.change-password');
    }

    public function reset_password(Request $request){

        Validator::make($request->all(),[
            'password'=>'required|min:6',
            'newpassword'=>['required',
                Password::min(6)
                ->mixedCase()
                ->letters()
                ->numbers()
                ->symbols()
                ->uncompromised()
            ],
            'confirmpassword'=>'required'

        ])->validate();

        if(!(Hash::check($request->get('password'), Auth::user()->password)))    
            return redirect()->route('change-password.view')->with('customError', 'Invalid Current Password!');
       
        if($request->get('newpassword')!=$request->get('confirmpassword'))
            return redirect()->route('change-password.view')->with('customError', '  Password does not !');

        $user=User::find(Auth::user()->id);
        $user->password=bcrypt($request->get('newpassword'));
        $user->save();
        return redirect()->route('change-password.view')->with('success', 'Password has been successfully Changed!');

        }

        public function view_profile(){

            return view ('users.change-profile');
        }


}
