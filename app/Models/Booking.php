<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Service;

class Booking extends Model
{
    use SoftDeletes;
    use HasFactory;
// =======
//     use SoftDeletes, HasFactory;
// >>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $dates = ['deleted_at'];
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
// =======
//         'payment_method',
// >>>>>>> fffb39338c68f80768a0eb6627658f0545b222cb
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

// =======
// // =======
// // >>>>>>> c6ea0260a8d50d634a3ad16d55310cda8cc865b5
// >>>>>>> fffb39338c68f80768a0eb6627658f0545b222cb
}
