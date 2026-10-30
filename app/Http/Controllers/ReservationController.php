<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ReservationController extends Controller
{
    // The logged-in user's own reservations
    public function index(Request $request)
    {
        $reservations = $request->user()->reservations()->with('product')->orderByDesc('start_date')->get();

        return view('reservations.index', ['reservations' => $reservations]);
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'start_date' => ['required', 'date', 'after_or_equal:today'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
        ], [
            'start_date.after_or_equal' => 'Je kunt niet in het verleden reserveren.',
            'end_date.after_or_equal' => 'De einddatum moet op of na de begindatum liggen.',
        ]);

        if (!$product->is_available) {
            return back()->withErrors(['start_date' => 'Dit product is op dit moment niet te leen.']);
        }
        if ($product->user_id === $request->user()->id) {
            return back()->withErrors(['start_date' => 'Je kunt je eigen product niet reserveren.']);
        }

        $start = Carbon::parse($request->start_date)->startOfDay();
        $end = Carbon::parse($request->end_date)->startOfDay();

        // No two reservations of the same product on the same day
        $taken = $product->reservations()
            ->where('start_date', '<=', $end)
            ->where('end_date', '>=', $start)
            ->exists();
        if ($taken) {
            return back()->withInput()->withErrors(['start_date' => 'In die periode is het product al gereserveerd. Kies andere dagen.']);
        }

        $product->reservations()->create([
            'user_id' => $request->user()->id,
            'start_date' => $start,
            'end_date' => $end,
        ]);

        return redirect()->route('reservations.index')->with('status', 'Gereserveerd: ' . $product->name . ' van ' . $start->format('d-m') . ' t/m ' . $end->format('d-m') . '.');
    }

    public function destroy(Request $request, Reservation $reservation)
    {
        abort_unless($reservation->user_id === $request->user()->id, 403);
        $reservation->delete();

        return back()->with('status', 'Je reservering is geannuleerd.');
    }
}
