<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\MyTestEmail;
use Illuminate\Support\Str;
 
class ApiController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login', 'register']]);
    }
 
    public function register() {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
        ]);
 
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
 
        $user = new User;
        $user->name = request()->name;
        $user->email = request()->email;
        $user->password = bcrypt(request()->password);
        $user->save();
 
        return response()->json($user, 201);
    }
 
    
    public function login(Request $req)
    {
        
       //print_r($req->email); exit();
       if(!empty($req->email) && !empty($req->password)  ){

        $is_email_present = DB::table('users')->where('email', $req->email)->where('role', 3)->first();
        if($is_email_present){

            if(Hash::check($req->password, $is_email_present->password)){

                $assigns = DB::table('assigns')->where('teacher', $is_email_present->id)->first();

                if($assigns != ''){
                $classes = DB::table('classes')->where('id', $assigns->class)->first();
                $division = DB::table('divisions')->where('id', $assigns->division)->first();
                $school = DB::table('organisations')->where('id', $assigns->school_id)->first();
                }
                else {

                    $classes = ""; $division = ""; $school = "";
                }

                if($classes != ''){ $class_name = $classes->name; } else { $class_name = "";  }
                if($division != ''){ $division_name = $division->name; } else { $division_name = "";  }
                if($school != ''){ $school_name = $school->org_name; } else { $school_name = "";  }

                $send_data = array(
                'user_id' => $is_email_present -> id,
                'name' => $is_email_present -> name,
                'class' => $class_name,
                'divison' => $division_name,
                'school' => $school_name
                
                );


                return response()->json([
                    "message" => "Login Successfully.",
                    "status" => 200,
                    "data" => $send_data
                ]);

            } 
            else {
        return response()->json(["status" => 404, "message" => "Password Not match"]);
            }

        }
        else {
        return response()->json(["status" => 404, "message" => "Email Not Found"]);
        }
            
       }

       else {

        return response()->json(["status" => 404, "message" => "Please fill in all the required fields"]);

       }
        
    }

    public function forget_password(Request $req)
    {
        //echo(Hash::make('123456')); exit();
       //print_r($req->email); exit();

       if(!empty($req->email)){
       
        $is_email_present = DB::table('users')->where('email', $req->email)->where('role', 3)->first();
        if($is_email_present){             
        
         //Mail::to($to)->send(new MyTestEmail($is_email_present->name, $password));

         $token = Str::random(64);
  
         Mail::send('email.forgetPassword', ['password' => $is_email_present->password_text], function($message) use($req){
            
             $message->to($req->email);
             $message->subject('Reset Password');
        
         });
        
        }

        else {
        return response()->json(["status" => 404, "message" => "Email Not Found"]);
       }

      }

       else {
        return response()->json(["status" => 404, "message" => "Please fill in all the required fields"]);
       }
        
    }


    public function get_student(Request $req)
    {
        
       //print_r($req->email); exit();
       if(!empty($req->id) ){

        $is_email_present = DB::table('users')->where('id', $req->id)->where('role', 3)->first();
        if($is_email_present){

            $assigns = DB::table('assigns')->where('teacher', $is_email_present->id)->first();

            if($assigns != '') {

           
            $get_org = DB::table('organisations')->where('admin_id', $is_email_present->admin_id)->first();
            $school_id = $get_org->id;  
           
            
            $get_student = DB::table('students')->where('school_id', $school_id)->get();

            if(count($get_student) > 0){

            return response()->json([
                "message" => "success",
                "status" => 200,
                "data" => $get_student
            ]);

            }
            else {
            // no student
            return response()->json(["status" => 404, "message" => "No data available."]);

            }
    }

    else {

        return response()->json(["status" => 404, "message" => "Not Assign any class"]);

    }

}
        else {
        return response()->json(["status" => 404, "message" => "User Not Found"]);
        }
            
       }

       else {

        return response()->json(["status" => 404, "message" => "Please fill in all the required fields"]);

       }
        
    }



    public function student_details(Request $req)
    {
        
       //print_r($req->email); exit();
       if(!empty($req->id) && !empty($req->student_id)  ){

        $is_email_present = DB::table('users')->where('id', $req->id)->where('role', 3)->first();
        if($is_email_present){

            $assigns = DB::table('assigns')->where('teacher', $is_email_present->id)->first();

            if($assigns != '') {

           
            $get_org = DB::table('organisations')->where('admin_id', $is_email_present->admin_id)->first();
            $school_id = $get_org->id;  
           
            $get_student = DB::table('students')->where('school_id', $school_id)->where('id', $req->student_id)->first();

            if($get_student != ''){

                $student= array(

                    'id' => $get_student->id,
                    'school_id' => $get_student->school_id,
                    'admin_id' => $get_student->admin_id,
                    'class' => $get_student->class,
                    'division' => $get_student->division,
                    'admission_no' => $get_student->admission_no,
                    'roll_no' => $get_student->roll_no,
                    'first_name' => $get_student->first_name,
                    'middle_name' => $get_student->middle_name,
                    'last_name' => $get_student->last_name,
                    'gender' => $get_student->gender,
                    'dob' => $get_student->dob,
                    'blood_group' => $get_student->blood_group,
                    'father_name' => $get_student->father_name,
                    'father_mobile' => $get_student->father_mobile,
                    'mother_name' => $get_student->mother_name,
                    'mother_mobile' => $get_student->mother_mobile,
                    'address' => $get_student->address,
                    'photo' => url('/')."/".$get_student->photo
                    
                );

            return response()->json([
                "message" => "success",
                "status" => 200,
                "data" => $student
            ]);

            }
            else {
            // no student
            return response()->json(["status" => 404, "message" => "No data available."]);

            }
    }

    else {

        return response()->json(["status" => 404, "message" => "Not Data Found."]);

    }
  
}
        else {
        return response()->json(["status" => 404, "message" => "User Not Found"]);
        }
            
       }

       else {

        return response()->json(["status" => 404, "message" => "Please fill in all the required fields"]);

       }
        
    }


    public function update_student(Request $req)
    {
        
       //print_r($req->email); exit();
       if(!empty($req->id) && !empty($req->student_id) && !empty($req->roll_no) && !empty($req->first_name) && !empty($req->middle_name) && !empty($req->last_name) && !empty($req->gender) && !empty($req->dob) && !empty($req->blood_group) && !empty($req->student_house)  &&  !empty($req->address)   ){
        
        $is_email_present = DB::table('users')->where('id', $req->id)->where('role', 3)->first();
        if($is_email_present){
        
            $assigns = DB::table('assigns')->where('teacher', $is_email_present->id)->first();
            
            if($assigns != '') {
           
            $get_org = DB::table('organisations')->where('admin_id', $is_email_present->admin_id)->first();
            $school_id = $get_org->id;  
            
            $get_student = DB::table('students')->where('school_id', $school_id)->where('id', $req->student_id)->first();

            if($get_student != ''){
            
                $path = "";
                if ($req->hasFile('file')) {
                  
                  $image = $req->file('file');
                 // $name = time().'.'.$image->getClientOriginalExtension();
                  $name = $get_student->admission_no.'.'.$image->getClientOriginalExtension();
                  $destinationPath = public_path('/images/student/');
                  $image->move($destinationPath, $name);
                  $path = 'images/student/'.$name;
                  //$image = url('/')."/".$path;
                  $image = $path;

               }
               else {
            
                $image = $get_student->photo;

               }

            
            // update student
             
             $roll_no = $req->roll_no;
             $first_name = $req->first_name;
             $middle_name = $req->middle_name;
             $last_name = $req->last_name;
             $gender = $req->gender;
             $dob = $req->dob;
             $blood_group = $req->blood_group;
             $student_house = $req->student_house;
             $father_name = $req->father_name;
             $father_mobile = $req->father_mobile;
             $mother_name = $req->mother_name;
             $mother_mobile = $req->mother_mobile;
             $address = $req->address;

             $data = array(
                'roll_no' => $roll_no,
                'first_name' => $first_name,
                'middle_name' => $middle_name,
                'last_name' => $last_name,
                'gender' => $gender,
                'dob' => $dob,
                'blood_group' => $blood_group,
                'student_house' => $student_house,
                'father_name' => $father_name,
                'father_mobile' => $father_mobile,
                'mother_name' => $mother_name,
                'mother_mobile' => $mother_mobile,
                'address' => $address,
                'photo' => $image
             );
             
             $update = DB::table('students')->where('id', $req->student_id)->update($data);

             if($update){

                return response()->json([
                    "message" => "success",
                    "status" => 200,
                    "data" => $data
                ]);

             }
             else{

                return response()->json([
                    "message" => "failed",
                    "status" => 400,
                    "data" => $data
                ]);

             }

            // update student ends
            

            }
            else {
            // no student
            return response()->json(["status" => 404, "message" => "Wrong data input"]);

            }
    }

    else {

        return response()->json(["status" => 404, "message" => "Not Data Found."]);

    }
  
}
        else {
        return response()->json(["status" => 404, "message" => "User Not Found"]);
        }
            
       }

       else {

        return response()->json(["status" => 404, "message" => "Please fill in all the required fields"]);

       }
        
    }


    public function showResetPasswordForm($token) { 
        return view('auth.forgetPasswordLink', ['token' => $token]);
     }

    
    
}