<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\User;
use DB;
use Mail;


class UsersController extends Controller
{

    /**
     * Register api.
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
      $validator = Validator::make($request->all(), [
          'email' => 'required|email|unique:users',
          'phone' => 'required|unique:users',
          'fname' => 'required',
          'lname' => 'required',
          'password' => 'required',
      ]);
      if ($validator->fails()) {
        return response()->json([
          'success' => false,
          'message' => $validator->errors(),
        ], 401);
      }

        //cloudinary upload
        $userImg = cloudinary()->upload($request->file('avatar')->getRealPath())->getSecurePath();

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $input['avatar'] = $userImg;
        
        $user = User::create($input);
        
        $data=array( 'fname'=>$request->fname, 'lname'=>$request->lname);
        $email = $request->email;

        // Mail::send('emails.welcome', $data, function($message) use($email)
        //         {
        //           $message->from('no-reply@headfortfoundation.com', 'Lawyers NowNow');
        //           $message->to($email)->subject('Welcome to Lawyers NowNow');
        //         });
        $success['token'] = $user->createToken('appToken')->accessToken;

        return response()->json([
          'success' => true,
          'token' => $success,
          'user' => $user,
          'message' => 'User Created Successfully'
      ]);
    }

    
  /**
     * Admin Login api.
     *
     * @return \Illuminate\Http\Response
     */
    public function adminLogin()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
          if(Auth::user()->user_level == 1){
                $user = Auth::user();
                $success['token'] = $user->createToken('appToken')->accessToken;
              //After successfull authentication, notice how I return json parameters
                return response()->json([
                  'success' => true,
                  'token' => $success,
                  'user' => $user,
                  'message' => 'Log In Successful',
              ]);
            } else{
              return response()->json([
                'success' => false,
                'message' => 'UnAuthorized',
            ]);
            }
        } else {
       //if authentication is unsuccessfull, notice how I return json parameters
          return response()->json([
            'success' => false,
            'message' => 'Invalid Email or Password',
        ], 401);
        }
    }


    /**
     * Search api.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchUsers($query)
        {
            if($query != " "){
              $users =  DB::table('users')->where('fname', 'like', '%'.$query.'%')->orWhere('lname', 'like', '%'.$query.'%')->orWhere('email', 'like', '%'.$query.'%')->orderby('created_at', 'DESC')->get();
            } else {
              $users =  DB::table('users')->orderby('created_at', 'DESC')->get();
            }
            return response()->json([
                'success' => true,
                'users' => $users,
                'message' => 'Searched Users Listed Successfully',
            ]);
    }
    
    /**
     * Login api.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['token'] = $user->createToken('appToken')->accessToken;
           //After successfull authentication, notice how I return json parameters
            return response()->json([
              'success' => true,
              'token' => $success,
              'user' => $user,
              'message' => 'User Logged In Successfully',
          ]);
        } else {
            //if authentication is unsuccessfull, notice how I return json parameters
            $e = DB::table('users')->where("email", request('email'))->select('email')->get();
            if ($e != "[]"){
              if ($e[0]->email != ""){
                  return response()->json([
                    'success' => false,
                    'email' => $e[0]->email,
                    'message' => 'Incorrect Password',
                ], 401);
              }
          }
            if ($e == "[]"){
              return response()->json([
                  'success' => false,
                'message' => 'There is no account registered with this email',
            ], 401);
            }
        }
    }

    /**
     * Edit api.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewUser($id)
    {
      if (Auth::user()) {
            $user_id = $id;
            $user =  DB::table('users')->where('id', $user_id)->first();

            if($user != null){
              return response()->json([
                  'success' => true,  
                  'user' => $user,
                  'message' => 'User Listed Successfully',
              ]);
            } else{
              return response()->json([
                  'success' => false,
                  'message' => 'User not found',
              ]);
            }
        } else {
          return response()->json([
            'success' => false,
            'message' => 'Cannot Retrieve User'
        ], 401);
      }
    }


    /**
     * Update api.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateUser(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fname' => 'required',
            'lname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        if ($validator->fails()) {
          return response()->json([
            'success' => false,
            'message' => $validator->errors(),
          ], 401);
        }

        // Define Image Holder
        $imageUpload = '';
      
        // Perform Image Upload
        if ($request->hasFile('avatar')) {
            // get current time and append the upload file extension to it,
        // then put that name to $imageUpload variable.
        $imageUpload = "upload".rand(1, 1000000000).'.'.$request->file('avatar')->getClientOriginalExtension();

        /* take the select file and move it public directory and make avatars
          folder if doesn't exsit then give it that unique name.
          */
        if ($_SERVER['HTTP_HOST'] == "localhost") {
          $path=public_path().'/images/uploads';
        }
        else{
          $path='images/uploads';
        }

        $request->avatar->move($path, $imageUpload);

        $input = $request->all();

        if($request->password != null){
          $input['password'] = bcrypt($input['password']);
        }

        $input['avatar'] = env('APP_URL').'/images/uploads'.'/'.$imageUpload;
        

      } else{
        $input = $request->all();
        if($request->password != null){
          $input['password'] = bcrypt($input['password']);
        }
      }

        // update DB
        DB::table('users')->where('id', $id)->update($input);

        // Get Updated data
        $update =  DB::table('users')->where('id', $id)->get();

        // Return Response
        return response()->json([
          'success' => true,
          'user' => $update,
          'message' => 'User Updated Successfully'
      ]);
    }


    /**
     * List Users api.
     *
     * @return \Illuminate\Http\Response
     */
    public function listUsers()
    {
      // if (DB::table('users')->get() != "") {
      if (Auth::user()) {
          $users =  DB::table('users')->get();
          return response()->json([
            'success' => true,
            'users' => $users,
            'message' => 'All Users Listed Successfully',
        ]);
      } else {
    //if authentication is unsuccessfull, notice how I return json parameters
        return response()->json([
          'success' => false,
          'message' => 'Cannot Retrieve Users List',
      ], 401);
    }
  }

    /**
     * Logout api.
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $res)
    {
      if (Auth::user()) {
        $user = Auth::user()->token();
        $user->revoke();

        return response()->json([
          'success' => true,
          'message' => 'Logout successfully'
      ]);
      }else {
        return response()->json([
          'success' => false,
          'message' => 'Unable to Logout'
        ]);
      }
     }
}
