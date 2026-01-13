<?php

namespace App\Http\Controllers;

use App\Models\MentorSlot;
use Illuminate\Http\Request;

class MentorSlotController extends Controller
{
    // Dashboard ментора
    public function index()
    {
        $slots = MentorSlot::where('mentor_id', auth()->id())
            ->orderBy('starts_at')
            ->get();

        return view('mentor.slots.index', compact('slots'));
    }

    // Ментор создаёт слот
    public function store(Request $request)
    {
        $request->validate([
            'starts_at' => 'required|date',
            'ends_at'   => 'required|date|after:starts_at',
            'price'     => 'required|integer|min:1000'
        ]);

        MentorSlot::create([
            'mentor_id' => auth()->id(),
            'starts_at' => $request->starts_at,
            'ends_at'   => $request->ends_at,
            'price'     => $request->price,
            'is_booked' => false,
        ]);

        return back();
    }

    // Ментор удаляет слот
    public function destroy(MentorSlot $slot)
    {
        abort_if($slot->mentor_id !== auth()->id(), 403);
        abort_if($slot->is_booked, 403);

        $slot->delete();
        return back();
    }
}
