<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Proposal extends Model
{
    protected $fillable = [
        'proposal_code',
        'nama_kegiatan',
        'deskripsi_kegiatan',
        'kategori',
        'tanggal_kegiatan',
        'jam_mulai',
        'jam_selesai',
        'estimasi_peserta',
        'contact_name',
        'contact_phone',
        'contact_email',
        'organisasi',
        'kebutuhan_khusus',
        'proposal_file',
        'original_filename',
        'file_size',
        'status',
        'admin_notes',
        'submitted_at',
        'approved_at',
        'user_id'
    ];

    protected $casts = [
        'tanggal_kegiatan' => 'date',
        'jam_mulai' => 'datetime',
        'jam_selesai' => 'datetime',
        'submitted_at' => 'datetime',
        'approved_at' => 'datetime',
        'estimasi_peserta' => 'integer'
    ];

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($proposal) {
            if (empty($proposal->proposal_code)) {
                $proposal->proposal_code = static::generateProposalCode();
            }
            if (empty($proposal->submitted_at)) {
                $proposal->submitted_at = now();
            }
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Scopes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    // Accessors
    public function getKategoriLabelAttribute()
    {
        $labels = [
            'pelatihan' => 'Pelatihan',
            'kerja_sama' => 'Kerja Sama',
            'event' => 'Event'
        ];

        return $labels[$this->kategori] ?? $this->kategori;
    }

    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Persetujuan',
            'approved' => 'Disetujui',
            'rejected' => 'Ditolak',
            'cancelled' => 'Dibatalkan'
        ];

        return $labels[$this->status] ?? $this->status;
    }

    public function getStatusColorAttribute()
    {
        $colors = [
            'pending' => 'warning',
            'approved' => 'success',
            'rejected' => 'danger',
            'cancelled' => 'secondary'
        ];

        return $colors[$this->status] ?? 'primary';
    }

    public function getDurationHoursAttribute()
    {
        if ($this->jam_mulai && $this->jam_selesai) {
            return Carbon::parse($this->jam_selesai)->diffInHours(Carbon::parse($this->jam_mulai));
        }
        return 0;
    }

    public function getProposalFileUrlAttribute()
    {
        if ($this->proposal_file) {
            return asset('storage/' . $this->proposal_file);
        }
        return null;
    }

    public function getFileSizeFormattedAttribute()
    {
        if ($this->file_size) {
            $bytes = $this->file_size;
            if ($bytes >= 1048576) {
                return number_format($bytes / 1048576, 2) . ' MB';
            } elseif ($bytes >= 1024) {
                return number_format($bytes / 1024, 2) . ' KB';
            } else {
                return $bytes . ' bytes';
            }
        }
        return null;
    }

    // Helper methods
    public static function generateProposalCode()
    {
        do {
            $code = 'PROP-' . now()->format('Ymd') . '-' . strtoupper(Str::random(4));
        } while (static::where('proposal_code', $code)->exists());

        return $code;
    }

    public function canBeCancelled()
    {
        return in_array($this->status, ['pending']) && 
               $this->tanggal_kegiatan > now()->addDay();
    }

    public function cancel()
    {
        if (!$this->canBeCancelled()) {
            return false;
        }

        $this->update(['status' => 'cancelled']);
        return true;
    }

    public function approve($notes = null)
    {
        $this->update([
            'status' => 'approved',
            'approved_at' => now(),
            'admin_notes' => $notes
        ]);
    }

    public function reject($notes = null)
    {
        $this->update([
            'status' => 'rejected',
            'admin_notes' => $notes
        ]);
    }
}
