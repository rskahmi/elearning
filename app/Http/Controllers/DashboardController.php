<?php

namespace App\Http\Controllers;

use App\Models\CourseModel;
use App\Models\SubmissionModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMahasiswa = User::where('role', 'mahasiswa')->count();
        $totalAssignNilai = SubmissionModel::whereNotNull('score')->count();
        $totalAssignNonNilai = SubmissionModel::whereNull('score')->count();
        $totalMataKuliah = CourseModel::count();

        return view('after-login.dashboard.index', [
            'total_mahasiswa' => $totalMahasiswa,
            'total_assign_nilai' => $totalAssignNilai,
            'total_assign_nonnilai' => $totalAssignNonNilai,
            'total_mata_kuliah' => $totalMataKuliah
        ]);
    }

}
