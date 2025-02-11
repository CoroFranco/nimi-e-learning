<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\Stripe;
use Stripe\Checkout\Session;

class PaymentController extends Controller
{
    //
    public function createCheckoutSession(Request $request, $courseId)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $course = Course::find($courseId);

        // Crear sesión de pago
        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd', // Cambia la moneda si es necesario
                        'product_data' => [
                            'name' => $course->title,
                        ],
                        'unit_amount' => $course->price * 100, // Precio en centavos
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => route('payment.success', ['courseId' => $courseId]),
            'cancel_url' => route('payment.cancel'),
        ]);

        return redirect($session->url);
    }

    public function success($courseId)
{
    // Aquí puedes marcar al usuario como inscrito en el curso
    $course = Course::findOrFail($courseId);

    // Verificar si el usuario ya está inscrito en el curso
    $existingEnrollment = Enrollment::where('user_id', Auth::id())
        ->where('course_id', $courseId)
        ->first();

    if ($existingEnrollment) {
        return response()->json([
            'success' => false,
            'message' => 'Ya estás inscrito en este curso.'
        ], 400);
    } else {
        // Crear una nueva inscripción
        $enrollment = new Enrollment();
        $enrollment->user_id = Auth::id();
        $enrollment->course_id = $courseId;
        $enrollment->save();

        return redirect()->route('courses.show', ['course' => $courseId])
        ->with('success', 'Te has inscrito exitosamente en el curso.');

}
}

public function cancel($courseId)
{
    return redirect()->route('courses.show', ['course' => $courseId])
        ->with('error', 'Nos has completado el pago.');
}
}
