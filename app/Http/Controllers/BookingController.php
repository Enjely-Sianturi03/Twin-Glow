<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\OperationalHours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class BookingController extends Controller
{
public function index(Request $request)
{
    // Ambil input tanggal dari form pencarian
    $tanggal = $request->input('tanggal');

    // Jika ada input tanggal, filter berdasarkan tanggal
    if ($tanggal) {
        $bookings = Booking::whereDate('tanggal', $tanggal)
            ->orderBy('tanggal', 'desc')
            ->get();
    } else {
        // Kalau tidak ada pencarian, ambil semua data booking
        $bookings = Booking::orderBy('tanggal', 'desc')->get();
    }

    return view('admin.booking.index', compact('bookings'));
}


    public function store(Request $request)
    {
        // Check if user is admin (red@gmail.com)
        if (Auth::check() && Auth::user()->email === 'red@gmail.com') {
            abort(403, 'Akses ditolak. Admin tidak diperbolehkan melakukan booking.');
        }

        // Check if user is logged in
        if (!Auth::check()) {
            return redirect('/login')->with('message', 'You need to login to book a service.');
        }

        // Get current user
        $user = Auth::user();

        // Get current date and time
        $now = Carbon::now();
        
        // Get the booking date and time
        $bookingDate = Carbon::parse($request->tanggal);
        $bookingTime = Carbon::parse($request->waktu);
        
        // Combine booking date and time
        $bookingDateTime = Carbon::create(
            $bookingDate->year,
            $bookingDate->month,
            $bookingDate->day,
            $bookingTime->hour,
            $bookingTime->minute,
            0
        );

        // Check if booking time is at least 1 hour from now (use full datetime comparison)
        if ($bookingDateTime->lessThanOrEqualTo($now->copy()->addHour())) {
            return back()->withErrors([
                'waktu' => 'Waktu booking harus minimal 1 jam dari waktu sekarang.'
            ])->withInput();
        }

        // Check if booking time has passed
        if ($bookingDateTime->isPast()) {
            return back()->withErrors([
                'waktu' => 'Tidak dapat melakukan booking untuk waktu yang sudah berlalu.'
            ])->withInput();
        }

        // Get the day name in Indonesian
        $dayName = $this->getDayName($bookingDate->format('l'));
        
        // Get operational hours for the selected day
        $operationalHours = OperationalHours::where('day', $dayName)->first();
        
        if (!$operationalHours || !$operationalHours->is_open) {
            return back()->withErrors(['tanggal' => 'Salon tutup pada hari yang dipilih.'])->withInput();
        }

        // Convert booking time to Carbon for comparison
        $openTime = Carbon::parse($operationalHours->open_time);
        $closeTime = Carbon::parse($operationalHours->close_time);

        // Check if booking time is within operational hours
        if ($bookingTime->lt($openTime) || $bookingTime->gt($closeTime)) {
            return back()->withErrors([
                'waktu' => "Waktu booking harus antara {$openTime->format('H:i')} - {$closeTime->format('H:i')} pada hari {$dayName}."
            ])->withInput();
        }

        // Check if booking time is on exact hour
        if ($bookingTime->format('i') !== '00') {
            return back()->withErrors([
                'waktu' => "Waktu booking harus tepat pada jam (contoh: 10:00, 11:00)."
            ])->withInput();
        }

        // Validation rules - only validate service-related fields
        $validated = $request->validate([
            'jenis_layanan' => 'required|string',
            'tanggal' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->lt(Carbon::today())) {
                        $fail('Tidak dapat melakukan booking untuk tanggal yang sudah berlalu.');
                    }
                },
            ],
            'waktu' => [
                'required',
                'string',
                'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):00$/' // Only allow exact hours
            ],
            'note' => 'nullable|string',
        ]);

        // Create new booking with user data
        $booking = new Booking();
        $booking->nama = $user->name;
        $booking->email = $user->email;
        $booking->no_tlp = $user->no_tlp;

        $booking->jenis_layanan = $validated['jenis_layanan'];
        $booking->tanggal = Carbon::parse($validated['tanggal'])->format('Y-m-d');
        $booking->waktu = $validated['waktu'];
        $booking->note = $validated['note'] ?? null;
        $booking->user_id = $user->id;
        $booking->status = 'pending';

        $booking->save();

        return redirect()->route('checkout.show', $booking->id)
            ->with('booking_success', 'Booking berhasil! Silakan lakukan pembayaran.');
    }

    public function create()
    {
        // Check if user is admin (red@gmail.com)
        if (Auth::check() && Auth::user()->email === 'red@gmail.com') {
            abort(403, 'Akses ditolak. Admin tidak diperbolehkan melakukan booking.');
        }

        $operationalHours = OperationalHours::all();
        return view('admin.booking.create', compact('operationalHours')); 

    }

    public function edit(Booking $booking)
    {
        $operationalHours = OperationalHours::all();
        return view('admin.booking.edit', compact('booking', 'operationalHours'));
    }

    public function update(Request $request, Booking $booking)
    {
        // Get current date and time
        $now = Carbon::now();
        
        // Get the booking date and time
        $bookingDate = Carbon::parse($request->tanggal);
        $bookingTime = Carbon::parse($request->waktu);

        $bookingDateTime = Carbon::create(
            $bookingDate->year,
            $bookingDate->month,
            $bookingDate->day,
            $bookingTime->hour,
            $bookingTime->minute,
            0
        );

        if ($bookingDateTime->isPast()) {
            return back()->withErrors([
                'waktu' => 'Tidak dapat melakukan booking untuk waktu yang sudah berlalu.'
            ])->withInput();
        }

        // Get the day name in Indonesian
        $dayName = $this->getDayName($bookingDate->format('l'));
        
        // Get operational hours for the selected day
        $operationalHours = OperationalHours::where('day', $dayName)->first();
        

        if (!$operationalHours || !$operationalHours->is_open) {
            return back()->withErrors(['tanggal' => 'Salon tutup pada hari yang dipilih.'])->withInput();
        }

        // Convert booking time to Carbon for comparison
        $openTime = Carbon::parse($operationalHours->open_time);
        $closeTime = Carbon::parse($operationalHours->close_time);

        if ($bookingTime->lt($openTime) || $bookingTime->gt($closeTime)) {
            return back()->withErrors([
                'waktu' => "Waktu booking harus antara {$openTime->format('H:i')} - {$closeTime->format('H:i')} pada hari {$dayName}."
            ])->withInput();
        }

        if ($bookingTime->format('i') !== '00') {
            return back()->withErrors([
                'waktu' => "Waktu booking harus tepat pada jam (contoh: 10:00, 11:00)."
            ])->withInput();
        }

        // Only validate editable fields
        $validated = $request->validate([
            'jenis_layanan' => 'required|string',
            'tanggal' => [
                'required',
                'date_format:Y-m-d',
                function ($attribute, $value, $fail) {
                    if (Carbon::parse($value)->lt(Carbon::today())) {
                        $fail('Tidak dapat melakukan booking untuk tanggal yang sudah berlalu.');
                    }
                },
            ],
            'waktu' => [
                'required',
                'string',
                'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):00$/' // Only allow exact hours

            ],
        ]);

        // Only update editable fields
        $booking->update([
            'jenis_layanan' => $validated['jenis_layanan'],
            'tanggal' => Carbon::parse($validated['tanggal'])->format('Y-m-d'),
            'waktu' => $validated['waktu']
        ]);

        return redirect()->route('admin.booking.index')
            ->with('booking_success', 'Booking berhasil diperbarui.');
    }

    private function getDayName($englishDay)
    {
        $days = [
            'Sunday' => 'Minggu',
            'Monday' => 'Senin',
            'Tuesday' => 'Selasa',
            'Wednesday' => 'Rabu',
            'Thursday' => 'Kamis',
            'Friday' => 'Jumat',
            'Saturday' => 'Sabtu'
        ];

        return $days[$englishDay] ?? $englishDay;
    }

    public function riwayat()
{
    $bookingRiwayat = Booking::onlyTrashed()->latest()->get();
    return view('admin.riwayat.index', compact('bookingRiwayat'));
}

public function destroy($id)
{
    $booking = Booking::findOrFail($id);
    $booking->delete(); // soft delete
    return redirect()->route('admin.booking.index')->with('success', 'Booking dipindahkan ke riwayat.');
}


}
