<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeLeadsNotification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'click_action',
        'read',
    ];

    protected $casts = [
        'read' => 'boolean',
    ];

    // relation (optional but useful)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
