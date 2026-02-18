<?php

namespace App\Http\Controllers;

use App\Mail\SendEmail;
use App\Models\AssignmentModel;
use App\Models\CourseModel;
use App\Models\MaterialsModel;
use App\Models\SubmissionModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class CourseController extends Controller
{
    public function index(){
        try {

        if (!Auth::check()) {
            return redirect()->route('login')->with('alert', [
                'type' => 'warning',
                'title' => 'Unauthorized',
                'text' => 'Anda harus login untuk mengakses halaman ini.'
            ]);
        }

        $user = Auth::user();
        $userId = $user->id;
        $role = $user->role;

        $courseQuery = CourseModel::query();
        if ($role === 'mahasiswa') {
            $courses = $courseQuery->get(); 
        }

        if ($role === 'dosen') {
            $courseQuery->where('user_id', $userId);
        }

        $course = $courseQuery->get();
        return view('after-login.course.index', [
            'course' => $course
        ]);

        } catch (\Exception $e) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'title' => 'Show Course',
                'text' => $e->getMessage()
            ]);
        }
    }

    public function store(Request $request){
        $course = CourseModel::create([
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'user_id' => auth()->user()->id
        ]);

        // Kirim email
        $data = [
            'text' => "Ada Mata Kuliah Baru!",
            'jenis' => "Mata Kuliah"
        ];
        $subject = '[Info] Ada Mata Kuliah Baru nih !';
        $users = User::where('role', 'mahasiswa')->get();
        foreach ($users as $user) {
            if (!empty($user->email)) {
                Mail::to($user->email)->send(new SendEmail($subject, $data));
            }
        }

        return redirect()->back()
            ->with(
                'alert',
                [
                    'type' => 'success',
                    'title' => 'Insert',
                    'text' => 'Data berhasil ditambahkan!'
                ]
            );
    }

    public function update(Request $request, $id){
        $course = CourseModel::findOrFail($id);
        $data = [
            'nama' => $request->edtNama,
            'deskripsi' => $request->edtDeskripsi
        ];
        $course->update($data);
        return redirect()->back()
            ->with(
                'alert',
                [
                    'type' => 'success',
                    'title' => 'Update',
                    'text' => 'Data berhasil diperbarui!'
                ]
            );
    }

    public function destroy(Request $request, $id){
        $course = CourseModel::findOrFail($id);
        $course->delete();
        return redirect()->back()
            ->with(
                'alert',
                [
                    'type' => 'success',
                    'title' => 'Delete',
                    'text' => 'Data berhasil dihapus!'
                ]
            );
    }

    public function detail($id)
    {
        $course = CourseModel::findOrFail($id);
        $materials = MaterialsModel::where('course_id', $id)->get();
        $assignment = AssignmentModel::where('course_id', $id)->get();

        return view('after-login.course.detail', [
            'course' => $course,
            'materials' => $materials,
            'assignment' => $assignment
        ]);
    }

    public function materials_store(Request $request, $id){
        $filename = null;
        if ($request->hasFile('file_path')) {
            $file_path = $request->file('file_path');
            $filename = time() . '-' . str_replace(' ', '-', $file_path->getClientOriginalName());
            $file_path->storeAs('public/materials', $filename);
        }

        $materials = MaterialsModel::create([
            'title' => $request->title,
            'file_path' => $filename,
            'course_id' => $id,
        ]);

        // Kirim email
        $data = [
            'text' => "Ada Materi Baru!",
            'jenis' => "Materi"
        ];
        $subject = '[Info] Ada Materi Baru nih !';
        $users = User::where('role', 'mahasiswa')->get();
        foreach ($users as $user) {
            if (!empty($user->email)) {
                Mail::to($user->email)->send(new SendEmail($subject, $data));
            }
        }

        return redirect()->back()
            ->with(
                'alert',
                [
                    'type' => 'success',
                    'title' => 'Insert',
                    'text' => 'Data berhasil ditambahkan!'
                ]
            );
    }

    public function assignment_store(Request $request, $id){
        $assignment = AssignmentModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'deadline' => $request->deadline,
            'course_id' => $id,
        ]);

        // Kirim email
        $data = [
            'text' => "Ada Tugas Baru!",
            'jenis' => "Tugas"
        ];
        $subject = '[Info] Ada Tugas Baru nih !';
        $users = User::where('role', 'mahasiswa')->get();
        foreach ($users as $user) {
            if (!empty($user->email)) {
                Mail::to($user->email)->send(new SendEmail($subject, $data));
            }
        }

        return redirect()->back()
            ->with(
                'alert',
                [
                    'type' => 'success',
                    'title' => 'Insert',
                    'text' => 'Data berhasil ditambahkan!'
                ]
            );
    }

    public function detail_assignment($id)
    {
        $assignment = AssignmentModel::findOrFail($id);
        $course = $assignment->course;
        $submissions = SubmissionModel::where('assignment_id', $assignment->id)->get();
        return view('after-login.course.detail_assignment', compact('assignment', 'course', 'submissions'));
    }
}
