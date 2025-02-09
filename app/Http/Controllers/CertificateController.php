<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificateController extends Controller
{
    //
    public function generateCertificate($courseId)
{
    $course = Course::findOrFail($courseId);
    $user = Auth::user();
    $enrollment = Enrollment::where('user_id', $user->id)
    ->where('course_id', $course->id)
    ->first();
    $completionDate = Carbon::parse($enrollment->completed_at)->format('F j, Y');

    $pdf = FacadePdf::loadView('certificates.template', [
        'user' => $user,
        'course' => $course,
        'enrollment' => $enrollment,
        'completionDate' => $completionDate
    ]);


    return $pdf->download('certificado.pdf');
}
}
