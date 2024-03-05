<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ClassDivision;
use App\Models\Division;
use Illuminate\Support\Facades\DB;
use Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Hash;
use App\Models\Organisation;
use Mail;
use App\Mail\MyTestEmail;

use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;

class StudentController extends Controller
{
    
    public function get_student(){

        $usertype = Auth::user()->role;
        //dd(usertype);
        $userId = Auth::id();
        $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
        $school_id = $get_org->id;
        if($usertype == '2'){
         
          $title = "Student";
         //$data = DB::table('users')->where('role', 2)->orderBy('id', 'desc')->paginate(10);
         $data = DB::table('students')
        ->select('*')
        //->join('organisations','organisations.admin_id','=','users.id')
        ->where('school_id','=', $school_id)
        ->orderBy('id', 'desc')
        ->paginate(10);
        
        $class_data = DB::table('classes')->where('school_id', $school_id)->get();
        return view('admin.students', compact('title', 'data', 'class_data'));
        
        }
        else {
      
        //dd("login user not admin");
         
         return redirect('/');
        }
      
      }


      public function add_student(Request $req){

        $usertype = Auth::user()->role;
          // Hash::make($request->newPassword)
        if($usertype == '2'){
        
         $admin_id = Auth::id();
         $get_org = DB::table('organisations')->where('admin_id', $admin_id)->first();
         $school_id = $get_org->id;
  
          $validated = $req->validate([
            
            'admission_no' => 'required|unique:students',
            'father_mobile' => 'required|digits:10',
            'mother_mobile' => 'required|digits:10',
            'father_name' => 'required',
            'father_name' => 'required',
            'dob' => 'required|date_format:d-m-Y',
            'address' => 'required',
            'gender' => 'required'
                   
        ]);
  
        $student = array(

          'school_id' => $school_id,
          'admin_id' => $admin_id,
          'class' => $req->class,
          'division' => $req->division,
          'admission_no' => $req->admission_no,
          'roll_no' => $req->roll_no,
          'first_name' => $req->first_name,
          'middle_name' => $req->middle_name,
          'last_name' => $req->last_name,
          'gender' => $req->gender,
          'dob' => $req->dob,
          'blood_group' => $req->blood_group,
          'father_name' => $req->father_name,
          'father_mobile' => $req->father_mobile,
          'mother_name' => $req->mother_name,
          'mother_mobile' => $req->mother_mobile,
          'student_house' => $req->student_house,
          'address' => $req->address

        );
  
        
    $insert = DB::table('students')->insertGetId($student);
  
    if($insert){
  
      Alert::success('Success','Student successfully added.');
     
    }
  
      return redirect()->back();
        
      }
        else {
         
          //dd("login user not admin");
          return redirect('/');
  
        }
    
    }

    public function get_division_by_id(Request $request){
        
      $id = $request->cat; 
      // $data = ClassDivision::where('class_id', $id)->get();
      // echo json_encode($data);

      $data = DB::table('class_divisions')
        ->select('*')
        ->join('divisions','divisions.id','=','class_divisions.division_id')
        ->where('class_divisions.class_id','=', $id)
        ->get();
        echo json_encode($data);

      }


      public function edit_student(Request $req, $id){

        $usertype = Auth::user()->role;
          // Hash::make($request->newPassword)
        if($usertype == '2'){
          
          $title = "Edit Student";

          $usertype = Auth::user()->role;
        //dd(usertype);
        $userId = Auth::id();
        $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
        $school_id = $get_org->id;

          $data = DB::table('students')
        ->select('*')
        //->join('organisations','organisations.admin_id','=','users.id')
        ->where('school_id','=', $school_id)
        ->where('id','=', $id)
        ->orderBy('id', 'desc')
        ->first();

        $class_data = DB::table('classes')->where('school_id', $school_id)->get();
        $div = DB::table('divisions')->where('school_id', $data->school_id)->get();
          return view('admin.edit_student', compact('title', 'data', 'class_data', 'div'));

        }
        else{
          return redirect('/');
        }

    }


    public function update_student(Request $req){

      $usertype = Auth::user()->role;
      
        // Hash::make($request->newPassword)
      if($usertype == '2'){
      
       $admin_id = Auth::id();
       $sdata = DB::table('students')->where('id', $req->student_id)->first();
       $get_org = DB::table('organisations')->where('admin_id', $admin_id)->first();
       $school_id = $get_org->id;

        $validated = $req->validate([
          
          'admission_no' => 'required|unique:students,admission_no,'.$sdata->id,
          'father_mobile' => 'required|digits:10',
          'mother_mobile' => 'required|digits:10' 
                 
      ]);

      $student = array(

        'school_id' => $school_id,
        'admin_id' => $admin_id,
        'class' => $req->class,
        'division' => $req->division,
        'admission_no' => $req->admission_no,
        'roll_no' => $req->roll_no,
        'first_name' => $req->first_name,
        'middle_name' => $req->middle_name,
        'last_name' => $req->last_name,
        'gender' => $req->gender,
        'dob' => $req->dob,
        'blood_group' => $req->blood_group,
        'father_name' => $req->father_name,
        'father_mobile' => $req->father_mobile,
        'mother_name' => $req->mother_name,
        'mother_mobile' => $req->mother_mobile,
        'student_house' => $req->student_house,
        'address' => $req->address

      );

      
  $update = DB::table('students')->where('id', $req->student_id)->update($student);

  //dd($update);

  if($update){

    Alert::success('Success','Student successfully updated.');

  }

    return redirect()->back();
      
    }
      else {
       
        //dd("login user not admin");
        return redirect('/');

      }
  
  }


  public function import_student(Request $req){

    $usertype = Auth::user()->role;
      
    if($usertype == '2'){
      
      $title = "Import Student";

      $usertype = Auth::user()->role;
    
    $userId = Auth::id();
    $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
    $school_id = $get_org->id;
    $class_data = DB::table('classes')->where('school_id', $school_id)->get();
    return view('admin.import_student', compact('title',  'class_data'));

    }
    else{
      return redirect('/');
    }

}

public function student_list_add(Request $req) 
{


 $admin_id = Auth::id();
 $get_org = DB::table('organisations')->where('admin_id', $admin_id)->first();
 $school_id = $get_org->id;
 $class =$req->class;
 $division =$req->division;

//   $data = [

//     'admin_id' => $admin_id, 
//     'school_id' => $school_id,
//     'class' => $req->class,
//     'division' => $req->division
    
//  ];
 
 //print_r($data); exit();

    Excel::import(new StudentImport($admin_id, $school_id, $class, $division),request()->file('file'));
    return back()->with('success', 'Student Imported Successfully.');
}


public function student_list_add_old(Request $req){

  $usertype = Auth::user()->role;
    //Hash::make($request->newPassword)
  if($usertype == '2'){
  
   $admin_id = Auth::id();
   $get_org = DB::table('organisations')->where('admin_id', $admin_id)->first();
   $school_id = $get_org->id;
   
   // csv upload logic starts

   $file = $req->file('file');
   $fileContents = file($file->getPathname());

    $array = [];
    $errors = [];
    $row = 1;
    foreach ($fileContents as $line) {
        $data = str_getcsv($line);
        if($row == 1){ $row++; continue; }

        $get_duplicate_admission_no = DB::table('students')->where('admission_no', $data[0])->where('school_id', $school_id)->first();

        //dd($get_duplicate_admission_no);
        //duplicate admin number
        if($get_duplicate_admission_no){  $row++; continue; }

        $student = array(

          'class' => $req->class,
          'division' => $req->division,
          'school_id' => $school_id,
          'admin_id' => $admin_id,
          'admission_no' => $data[0],
          'roll_no' => $data[1],
          'first_name' => $data[2],
          'middle_name' => $data[3],
          'last_name' => $data[4],
          'gender' => $data[5],
          'dob' => $data[6],
          'blood_group' => $data[7],
          'student_house' => $data[8],
          'father_name' => $data[9],
          'father_mobile' => $data[10],
          'mother_name' => $data[11],
          'mother_mobile' => $data[12],
          'address' => $data[13]
      
        );
        
       $insert = DB::table('students')->insert($student);

    } // endforeach

    Alert::success('Success','Student successfully added.');
    return redirect()->back();
   // dd($array);
   // csv upload logic ends

  }

}

public function get_assign(){

  $usertype = Auth::user()->role;
  //dd(usertype);
  $userId = Auth::id();
  $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
  $school_id = $get_org->id;
  if($usertype == '2'){
   
    $title = "Student";
   //$data = DB::table('users')->where('role', 2)->orderBy('id', 'desc')->paginate(10);
   $data = DB::table('assigns')
  ->select('classes.name as class_name', 'assigns.id as id', 'divisions.name as division_name', 'users.name as teacher_name')
  ->join('users','assigns.teacher','=','users.id')
  ->join('classes','classes.id','=','assigns.class')
  ->join('divisions','divisions.id','=','assigns.division')
  ->where('assigns.school_id','=', $school_id)
  ->orderBy('assigns.id', 'desc')
  ->paginate(10);
  
  $class_data = DB::table('classes')->where('school_id', $school_id)->get();
  $teacher_data = DB::table('users')->where('admin_id', $userId)->get();

  return view('admin.assigns', compact('title', 'data', 'class_data', 'teacher_data'));
  
  }
  else {

  //dd("login user not admin");
   
   return redirect('/');
  }

}


public function post_assign(Request $req){

  $usertype = Auth::user()->role;
 
  //dd($req);
    // Hash::make($request->newPassword)
  $userId = Auth::id();
  $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
  $school_id = $get_org->id;

  if($usertype == '2'){

  $user = array(

    'admin_id' => Auth::id(),
    'school_id' => $school_id,
    'class' => $req->class,
    'division' => $req->division,
    'teacher' => $req->teacher
    
  );

$is_already_present = DB::table('assigns')->where('school_id', $school_id)->where('class', $req->class)->where('division', $req->division)->where('teacher', $req->teacher)->first();
$present = DB::table('assigns')->where('school_id', $school_id)->where('teacher', $req->teacher)->first();
//dd($is_already_present);

if($is_already_present != "" || $present != "") {

  Alert::error('Error','Teacher is already assigned to this class and division.');
  return redirect()->back();

}
else {

$insert = DB::table('assigns')->insertGetId($user);

if($insert){

Alert::success('Success','Teacher successfully Assigned.');

}

  return redirect()->back();
}
  }
  else {
   
   // dd("login user not admin");
      return redirect('/');

  }

}

public function edit_assign(Request $req, $id){

  $usertype = Auth::user()->role;
    // Hash::make($request->newPassword)
  if($usertype == '2'){
    
    $title = "Edit Teacher Assignment";

    $usertype = Auth::user()->role;
  //dd(usertype);
  $userId = Auth::id();
  $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
  $school_id = $get_org->id;

    $data = DB::table('assigns')
  ->select('*')
  //->join('organisations','organisations.admin_id','=','users.id')
  ->where('school_id','=', $school_id)
  ->where('id','=', $id)
  ->orderBy('id', 'desc')
  ->first();

  $class_data = DB::table('classes')->where('school_id', $school_id)->get();
  $div = DB::table('divisions')->where('school_id', $data->school_id)->get();
  $teacher_data = DB::table('users')->where('admin_id', $userId)->get();
    return view('admin.edit_assign', compact('title', 'data', 'class_data', 'div', 'teacher_data'));

  }
  else{
    return redirect('/');
  }

}

   
public function delete_student(Request $req){

  $usertype = Auth::user()->role;
  
    // Hash::make($request->newPassword)
  if($usertype == '2'){
  
   $admin_id = Auth::id();
   $sdata = DB::table('students')->where('id', $req->student_id)->first();
   $get_org = DB::table('organisations')->where('admin_id', $admin_id)->first();
   $school_id = $get_org->id;

   $delete = DB::table('students')->where('id', $req->student_id)->delete();

//dd($update);

if($delete){

Alert::warning('Success','Student successfully deleted.');

}

return redirect()->back();
  
}
  else {
   
    //dd("login user not admin");
    return redirect('/');

  }

}


public function view_student(Request $req, $id){

  $usertype = Auth::user()->role;
    // Hash::make($request->newPassword)
  if($usertype == '2'){
    
    $title = "View Student";
    $usertype = Auth::user()->role;
  //dd(usertype);
  $userId = Auth::id();
  $get_org = DB::table('organisations')->where('admin_id', $userId)->first();
  $school_id = $get_org->id;

    $data = DB::table('students')
  ->select('*')
  //->join('organisations','organisations.admin_id','=','users.id')
  ->where('school_id','=', $school_id)
  ->where('id','=', $id)
  ->orderBy('id', 'desc')
  ->first();

  $class_data = DB::table('classes')->where('school_id', $school_id)->get();
  $div = DB::table('divisions')->where('school_id', $data->school_id)->get();
  return view('admin.edit_student', compact('title', 'data', 'class_data', 'div'));

  }
  else{
    return redirect('/');
  }

}



}
