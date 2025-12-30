<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeIndiamartLeads extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "lead_id",
        "folder_id",
        "integration_id",
        "type",
        "response",
        "created_at",
        "updated_at",
    ];

    public function folder()
    {
        return $this->belongsTo(OfficeLeadsFolders::class, 'folder_id', 'id');
    }
}
