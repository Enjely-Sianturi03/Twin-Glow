<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Booking extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'nama',
        'no_tlp',
        'email',
        'jenis_layanan',
        'tanggal',
        'waktu',
        'note',
        'status',
        'user_id',
        'service_id',
        'payment_method',
    ];

    /**
     * Cast attributes to specific types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tanggal' => 'date',  
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    
}
