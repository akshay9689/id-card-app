<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class StudentImport implements  ToCollection, WithHeadingRow//ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $data; 

    public function __construct($admin_id, $school_id, $class, $division)
    {
        $this->admin_id= $admin_id;
        $this->school_id= $school_id;
        $this->class= $class;
        $this->division= $division;
    }


    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.admission_no' => 'required| unique:students',
            '*.roll_no' => 'required',
            '*.first_name' => 'required',
           // '*.middle_name' => 'regex:/^[a-zA-Z]+$/u|max:255',
            '*.last_name' => 'required',
            '*.gender' => 'required',
            '*.dob' => 'required|date_format:d-m-Y',
            //'*.blood_group' => 'required',
            //'*.student_house' => 'required',
            '*.father_name' => 'required',
            '*.father_mobile' => 'required|digits:10',
            '*.mother_name' => 'required',
            '*.mother_mobile' => 'required|digits:10',
            '*.address' => 'required'

        ])->validate();
 
       foreach ($rows as $row) {
       /* Student::create([
            
               'admission_no' => $row['admission_no'],
               'roll_no' => $row['roll_no'],
               'first_name' => $row['first_name'],
               'middle_name' => $row['middle_name'],
               'last_name' => $row['last_name'],
               'gender' => $row['gender'],
               'dob' => $row['dob'],
               'blood_group' => $row['blood_group'],
               'student_house' => $row['student_house'],
               'father_name' => $row['father_name'],
               'father_mobile' => $row['father_mobile'],
               'mother_name' => $row['mother_name'],
               'mother_mobile' => $row['mother_mobile'],
               'address' => $row['address']
            
           ]);
           */

           $data =array(

                'admin_id' => $this->admin_id, 
                'school_id' => $this->school_id,
               'class' => $this->class,
               'division' => $this->division,
               'admission_no' => $row['admission_no'],
               'roll_no' => $row['roll_no'],
               'first_name' => $row['first_name'],
               'middle_name' => $row['middle_name'],
               'last_name' => $row['last_name'],
               'gender' => $row['gender'],
               'dob' => date('Y-m-d', strtotime($row['dob'])),
               'blood_group' => $row['blood_group'],
               'student_house' => $row['student_house'],
               'father_name' => $row['father_name'],
               'father_mobile' => $row['father_mobile'],
               'mother_name' => $row['mother_name'],
               'mother_mobile' => $row['mother_mobile'],
               'address' => $row['address']

           );

           $insert = DB::table('students')->insert($data);

       }
    }
}
