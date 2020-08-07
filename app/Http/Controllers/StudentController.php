<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentController extends Controller
{
    //
    public function showall() {
        $students = new Student();
        $students = Student::all();

        return response()->json([
            'status' => true,
            'messages' => 'success get all students',
            'data' => $students
        ]);
    }

    public function showOne($id) {
        $student = new Student();
        $student = Student::where('id', $id)->first();

        if($student) {
            return response()->json([
                'status' => true,
                'messages' => 'success get student with id ' . $id,
                'data' => $student
            ]);
        } else {
            return response()->json([
                'status' => false,
                'messages' => 'id not found!'
            ]);
        }
    }

    public function addStudent(Request $req) {
        $students = new Student();
        $students->nama = $req->nama;
        $students->nim = $req->nim;
        $students->prodi = $req->prodi;

        $students->save();

        return response()->json([
            'status' => true,
            'messages' => 'success added student',
            'data' => $students
        ]);
    }

    public function editStudent($id, Request $req) {
        $student = new Student();
        $student = Student::where('id', $id)->first();

        if($student) {
            $student->nama = $req->nama ? $req->nama : $student->nama;
            $student->nim = $req->nim ? $req->nim : $student->nim;
            $student->prodi = $req->prodi ? $req->prodi : $student->prodi;
            $student->save();
            return response()->json([
                'status' => true,
                'success' => 'success edit student with id ' . $id,
                'data' => $student
            ]);
        } else {
            return response()->json([
                'status' => false,
                'messages' => 'id not found!'
            ]);
        }
    }

    public function deleteStudent(Request $req) {
        $student = new Student();
        $student = Student::where('id', $req->id)->first();

        if($student) {
            $student->delete();
            return response()->json([
                'status' => true,
                'messages' => 'data deleted with id ' . $req->id
            ]);
        } else {
            return response()->json([
                'status' => false,
                'messages' => 'id not found!'
            ]);
        }

    }
}
