<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficeFacebookIntegrations extends Model
{
    use HasFactory;
    
    protected $fillable = [
        "page_id",
        "page_name",
        "form_id",
        "form_name",
        "access_token",
        "folder_id",
        "integration_id",
        "type",
        "created_at",
        "updated_at",
    ];

    public function folder()
    {
        return $this->belongsTo(OfficeLeadsFolders::class, 'folder_id', 'id');
    }
}
