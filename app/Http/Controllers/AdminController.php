<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Division;
use Illuminate\Support\Facades\DB;
use Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Models\Organisation;
use Mail;
use App\Mail\MyTestEmail;
class AdminController extends Controller
{
    
    
    public function dashboard(){

        $usertype = Auth::user()->role;
        //dd(usertype);

        if($usertype != '0'){
        
         $title = "Dashboard";
         return view('admin.dashboard', compact('title'));

        }
        else {
         
          dd("login user not admin");
         //return redirect('auth.login');

        }
    
    }


    public function get_admin(){

        $usertype = Auth::user()->role;
        //dd(usertype);

        if($usertype == '1'){
        
         $title = "Admin";
         //$data = DB::table('users')->where('role', 2)->orderBy('id', 'desc')->paginate(10);
         $data = DB::table('users')
        ->select('users.id as user_id', 'users.name', 'users.mobile', 'users.email' , 'users.status', 'users.created_at', 'organisations.id', 'organisations.org_name', 'organisations.org_email', 'organisations.org_mobile', 'organisations.org_address', 'organisations.org_photo')
        ->join('organisations','organisations.admin_id','=','users.id')
        ->where('users.role','=', 2)
        ->where('users.deleted_at','=', NULL)
        ->orderBy('organisations.id', 'desc')
        ->paginate(10);

         return view('admin.admin-list', compact('title', 'data'));

        }
        else {
         
         //dd("login user not admin");
         return redirect('/');

        }
    
    }


  
    public function add_school(Request $req){

        $usertype = Auth::user()->role;
       
          // Hash::make($request->newPassword)

        if($usertype == '1'){

          $validated = $req->validate([
            
            'org_name' => 'required|min:3',
            'org_email' => 'required|email',
            'org_address' => 'required|min:10',
            'org_mobile' => 'digits:10',
            'mobile' => 'digits:10',
            'username' => 'required|min:3',
            'email' => 'required|unique:users|email',
            'password' => 'min:8'
        ]);

        $user = array(
          'name' => $req->username,
          'admin_id' => 1,
          'mobile' => $req->mobile,
          'email' => $req->email,
          'password' => Hash::make($req->password),
          'password_text' => $req->password,
          'role' => 2
        );

        

    $insert = DB::table('users')->insertGetId($user);

    if($insert){

      // send email to user after registration 
         $password = $req->password;
         $to = $req->email; 
         $name = $req->email;

        Mail::to($to)->send(new MyTestEmail($name, $password));
      // send email ends
        
      $image = $req->org_photo;
      $imagename = time().'.'.$image->getClientOriginalExtension();
      $req->org_photo->move('images/school', $imagename);

      $organization = array(
        'admin_id' => $insert,
        'org_name' => $req->org_name,
        'org_email' => $req->org_email,
        'org_mobile' => $req->org_mobile,
        'org_address' => $req->org_address,
        'org_photo' => $imagename
      );

      $insert2 = DB::table('organisations')->insertGetId($organization);

      Alert::success('Success','organization successfully created');
     
    }

        return redirect()->back();
        }
        else {
         
          dd("login user not admin");
         //return redirect('auth.login');

        }
    
    }


    public function update_school(Request $request, $id){

      $data = organisation::find($id);

      $data->org_name = $request->org_name;
      $data->org_email = $request->org_email;
      $data->org_mobile = $request->org_mobile;
      $data->org_address = $request->org_address;
      
      $org_photo = $request->org_photo;
      if($org_photo != '') {
      $imagename = time().'.'.$org_photo->getClientOriginalExtension();
      $request->org_photo->move('images/school', $imagename);
      $data->org_photo = $imagename;
      }
      else {
      $data->org_photo = $request->old_photo;
      }
      
      $data->save();
      Alert::success('Success','Record Updated Successfully');
      return redirect()->back();
  
  }


  public function update_teacher(Request $request, $id){

    $data = user::find($id);
    $data->name = $request->name;
    $data->email = $request->email;
    $data->mobile = $request->mobile;
    $data->save();

    Alert::success('Success','Record Updated Successfully.');
    return redirect()->back();

}



public function change_admin_status(Request $req){

  $usertype = Auth::user()->role;
  if($usertype == '1'){
  try{

   $update = DB::table('users')->where('id', $req->id)->update(['status' => $req->status]);

    if($update === 1){
       Alert::success('Success','Status Updtated Successfully');
    }
    
}

catch(Exception $e){

  dd($e->getMessage());
   Alert::error('Error','some database  error occured');
}

   return redirect()->back();
   

  }

  else {

  return redirect('auth.login');

  }

}


public function delete_admin(Request $req){

  $usertype = Auth::user()->role;
  //dd(usertype);
  if($usertype == '1'){
  
    try{

  // $update = DB::table('user')->where('user_id', $req->id)->delete();
     // dd($req->id);
      $id = user::find($req->id);
      $delete  = $id->delete();

    if($delete === true){

      Alert::success('Success','User Deleted Successfully');

    }
    else if($delete === false){

       Alert::warning('Warning','Some Error Occured.');

      }

}


catch(Exception $e){

  //dd($e->getMessage());

   Alert::error('Error','some database  error occured');

}

   return redirect()->back();
   
  }

  else {
   
  return redirect('auth.login');
   
  }

}


public function get_teacher(){

  $usertype = Auth::user()->role;
  //dd(usertype);
  if($usertype == '1' || $usertype == '2'){
  
   if($usertype == '1'){


    $title = "Teacher";
   $data = DB::table('users')
  ->select('*')
  ->where('role','=', 3)
  ->where('deleted_at','=', NULL)
  ->orderBy('id', 'desc')
  ->paginate(10);


   }

   else if($usertype == '2'){

    $admin_id = Auth::id();
    $title = "Teacher";
   $data = DB::table('users')
  ->select('*')
  ->where('role','=', 3)
  ->where('deleted_at','=', NULL)
  ->where('admin_id','=', $admin_id)
  ->orderBy('id', 'desc')
  ->paginate(10);

   }

   return view('admin.teacher-list', compact('title', 'data'));

  }
  else {

    dd("login user not admin");
   //return redirect('auth.login');
  }

}


public function add_teacher(Request $req){

        $usertype = Auth::user()->role;
       
        //dd($req);
          // Hash::make($request->newPassword)

        if($usertype == '1' || $usertype == '2'){

         // generate password
         $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
         $pass = array(); //remember to declare $pass as an array
         $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
         for ($i = 0; $i < 8; $i++) {
         $n = rand(0, $alphaLength);
         $pass[] = $alphabet[$n];
         }
        $randomPass =  implode($pass); //turn the array into a string
         
         // generate password

        $user = array(

          'name' => $req->name,
          'mobile' => $req->mobile,
          'email' => $req->email,
          'admin_id' => Auth::id(),
          'role' => 3,
          'password' => Hash::make($randomPass),
          'password_text' => $randomPass

        );

    $insert = DB::table('users')->insertGetId($user);

    if($insert){

      // send email to user after registration 
         $password = $randomPass;
         $to = $req->email; 
         $name = $req->email;

        Mail::to($to)->send(new MyTestEmail($name, $password));
      // send email ends

      Alert::success('Success','Teacher successfully created.');
     
    }

        return redirect()->back();
        }
        else {
         
          dd("login user not admin");
         //return redirect('auth.login');

        }
    
    }

   
    public function get_division(){

      $usertype = Auth::user()->role;
      //dd(usertype);
      $userId = Auth::id();
      $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
      $school_id = $get_org->id;
      if($usertype == '2'){
       $title = "Divisions";
       //$data = DB::table('users')->where('role', 2)->orderBy('id', 'desc')->paginate(10);
       $data = DB::table('divisions')
      ->select('*')
      //->join('organisations','organisations.admin_id','=','users.id')
      ->where('school_id','=', $school_id)
      ->orderBy('id', 'desc')
      ->paginate(10);
       
       return view('admin.division', compact('title', 'data'));
       
      }
      else {
        
        dd("login user not admin");
       //return redirect('auth.login');
      }
    
    }

    public function add_division(Request $req){

      $usertype = Auth::user()->role;
      
        // Hash::make($request->newPassword)

      if($usertype == '2'){

       $userId = Auth::id();
       $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
       $school_id = $get_org->id;
       
       //Alert:warning

        $validated = $req->validate([
          'name' => 'required',        
      ]);

      $is_already_present = DB::table('divisions')->where('name', $req->name)->where('school_id', $school_id)->first();

     // dd($is_already_present);

      if($is_already_present !== null){

       Alert::warning('Error', 'this division is already present');
       return redirect()->back();
      }

      $division = array(
        'name' => $req->name,
        'school_id' => $school_id
      );

      
  $insert = DB::table('divisions')->insertGetId($division);

  if($insert){

    Alert::success('Success','Division successfully created');
   
  }

      return redirect()->back();
      }
      else {
       
        //dd("login user not admin");
        return redirect('/');

      }
  
  }

  
  public function delete_division(Request $req){

    $usertype = Auth::user()->role;
    //dd(usertype);
    if($usertype == '2'){
  
      try{
  
    // $update = DB::table('user')->where('user_id', $req->id)->delete();
       // dd($req->id);
        $id = division::find($req->id);
        $delete  = $id->delete();
  
      if($delete === true){
       
        Alert::success('Success','Division Deleted Successfully');
  
      }
      else if($delete === false){
  
         Alert::warning('Warning','Some Error Occured.');
  
        }
  
  }
  
  catch(Exception $e){
  
     Alert::error('Error','some database  error occured');
  
    }
     return redirect()->back();
    }
  
    else {
    return redirect('/');
    }
  
  }
  

  public function update_division(Request $req){

    $usertype = Auth::user()->role;

    if($usertype == '2'){

      $userId = Auth::id();
      $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
      $school_id = $get_org->id;

    try{

     $present = DB::table('divisions')->where('id', '<>', $req->id)->where('name', $req->name)->where('school_id', $school_id)->first();
     
     
     if($present){
      Alert::warning('Warning','this division is already present .');
      return redirect()->back();
     }
      
     $update = DB::table('divisions')->where('id', $req->id)->update(['name' => $req->name ]);
      if($update === 1){
      Alert::success('Success','Division Updtated Successfully');
      }
      else if($update === 0){
      Alert::warning('Warning','Please Edit Data to Update');
      }
      

  }


  catch(Exception $e){
     dd($e->getMessage());
     Alert::error('Error','some database  error occured');
  }

     return redirect()->back();
    }

    else {
    return redirect('auth.login');
    }

}

public function get_classes(){

  $usertype = Auth::user()->role;
  //dd(usertype);
  $userId = Auth::id();
  $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
  $school_id = $get_org->id;
  
  $divisions = DB::table('divisions')->where('school_id', $school_id)->get();
  if($usertype == '2'){
   $title = "Classes";
   //$data = DB::table('users')->where('role', 2)->orderBy('id', 'desc')->paginate(10);
   $data = DB::table('classes')
  ->select('*')
  //->join('organisations','organisations.admin_id','=','users.id')
  ->where('school_id','=', $school_id)
  ->orderBy('id', 'desc')
  ->paginate(10);
  
  return view('admin.class', compact('title', 'data', 'divisions'));
  
  }
  else {
   // dd("login user not admin");
   return redirect('/');
  }

}


public function add_class(Request $req){

  $usertype = Auth::user()->role;
    // Hash::make($request->newPassword)
  if($usertype == '2'){

  //echo count($req->divisions); exit();
   $userId = Auth::id();
   $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
   $school_id = $get_org->id;

    $validated = $req->validate([
      'name' => 'required',        
  ]);


  $is_already_present = DB::table('classes')->where('name', $req->name)->where('school_id', $school_id)->first();

  // dd($is_already_present);

   if($is_already_present !== null){

    Alert::warning('Error', 'this class is already present');
    return redirect()->back();

   }

  $classdata = array(
    'name' => $req->name,
    'school_id' => $school_id
  );

  
$classid = DB::table('classes')->insertGetId($classdata);

if($classid){

  for($i=0; $i< count($req->divisions) ; $i++){
    
    $division = array(
       
      'division_id' => $req->divisions[$i],
      'class_id' => $classid
      
    );
  
  $insert = DB::table('class_divisions')->insert($division);
 
  }

Alert::success('Success','Class successfully created');

}

  return redirect()->back();
  }
  else {
   
    //dd("login user not admin");
    return redirect('/');

  }

}


public function view_profile(){
 
  $usertype = Auth::user()->role;
  if($usertype != '0'){
    
    $title = "View profile";
    return view('admin.view_profile', compact('title'));
    
   }
   else {
     
     dd("login user not admin");
      
    //return redirect('auth.login');
 
   }
}


public function reset_password(Request $req){

  $usertype = Auth::user()->role;
  //dd(usertype);
  $userId = Auth::id();
  
  $present = DB::table('users')->where('id', $userId)->first();
  
  if($present){

  if(Hash::check($req->old_password, $present->password)){ 
  
    if($req->new_password === $req->re_password){
    
    $new_password =  Hash::make($req->new_password);
    $update = DB::table('users')->where('id', $userId)->update(['password' => $new_password, 'password_text' => $req->new_password]);
    if($update === 1){
       Alert::success('error','Status Updtated Successfully');
       return redirect()->back();
    }
    
    }
    else {

    Alert::warning('error','New password and reenter password does not match.');
    return redirect()->back();
    }

  } 
  else {
    Alert::warning('error','Old Password is wrong');
    return redirect()->back();
  }


} }


public function edit_class($id){

  $usertype = Auth::user()->role;
  //dd(usertype);
  $userId = Auth::id();
  $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
  $school_id = $get_org->id;
  $divisions = DB::table('divisions')->where('school_id', $school_id)->orderBy('name', 'ASC')->get();
  
  $div = DB::table('class_divisions')->where('class_id', $id)->get();
  $data = DB::table('classes')->where('id', $id)->first();
  if($usertype != '0'){
   
   $title = "Edit Class";
   return view('admin.edit_class', compact('title','divisions','data','div'));
   
  }
  else {
   
    dd("login user not admin");
   //return redirect('auth.login');
    
  }

}

public function update_class(Request $req){

   //dd($req);
  
  $usertype = Auth::user()->role;
    // Hash::make($request->newPassword)
  if($usertype == '2'){
    
    $class_id= $req->class_id;
    
  //echo count($req->divisions); exit();
   $userId = Auth::id();
   $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
   $school_id = $get_org->id;

    $validated = $req->validate([
      'name' => 'required',        
  ]);


  // $is_already_present = DB::table('classes')->where('name', $req->name)->where('school_id', $school_id)->first();


  //  if($is_already_present !== null){

  //   Alert::warning('Error', 'this class is already present');
  //   return redirect()->back();

  //  }

  $classdata = array(
    'name' => $req->name,
    'school_id' => $school_id
  );

$classid = DB::table('classes')->update($classdata);

if($classid){

  $delete = DB::table('class_divisions')->where('class_id', $class_id)->delete();

  for($i=0; $i< count($req->divisions) ; $i++){
    
    $division = array(
      
      'division_id' => $req->divisions[$i],
      'class_id' => $classid
      
    );
  
  $insert = DB::table('class_divisions')->insert($division);
 
  }

Alert::success('Success','Class successfully Updated');

}

  return redirect()->back();
  }
  else {
   
    //dd("login user not admin");
    return redirect('/');

  }

}



}
