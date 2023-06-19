<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kelas;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mahasiswa extends Model
{
    use HasFactory;
    // protected $table = 'mahasiswas';

    protected $primaryKey = 'nim';
    public $timestamps = false;
    protected $fillable = [
        'nim',
        'nama',
        'kelas_id',
        'jurusan',
        'no_handphone',
        'email',
        'tanggal_lahir'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
