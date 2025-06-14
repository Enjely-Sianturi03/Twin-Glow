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
    public function index()
    {
        $bookingsAktif = Booking::orderBy('tanggal', 'desc')->get();
        $bookingRiwayat = Booking::onlyTrashed()->orderBy('deleted_at', 'desc')->get();

        return view('admin.booking.index', compact('bookingsAktif', 'bookingRiwayat'));
    }

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect('/login')->with('message', 'You need to login to book a service.');
        }

        $user = Auth::user();
        $now = Carbon::now();
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

        $dayName = $this->getDayName($bookingDate->format('l'));
        $operationalHours = OperationalHours::where('day', $dayName)->first();

        if (!$operationalHours || !$operationalHours->is_open) {
            return back()->withErrors(['tanggal' => 'Salon tutup pada hari yang dipilih.'])->withInput();
        }

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
                'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):00$/'
            ],
            'note' => 'nullable|string',
        ]);

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
        $now = Carbon::now();
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

        $dayName = $this->getDayName($bookingDate->format('l'));
        $operationalHours = OperationalHours::where('day', $dayName)->first();

        if (!$operationalHours || !$operationalHours->is_open) {
            return back()->withErrors(['tanggal' => 'Salon tutup pada hari yang dipilih.'])->withInput();
        }

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

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
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
                'regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):00$/'
            ],
            'note' => 'nullable|string',
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);

        $booking->update($validated);

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

    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('admin.booking.index')->with('success', 'Booking berhasil dihapus.');
    }
}
