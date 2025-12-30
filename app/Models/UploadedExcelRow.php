<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadedExcelRow extends Model
{
    use HasFactory;

    protected $table = 'uploaded_excel_rows';

    public $timestamps = false; // sirf created_at hai

    protected $fillable = [
        'uploaded_excel_id',
        'excel_row_no',
        'client_name',
        'client_mobile',
        'client_email',
        'raw_json',
        'is_assigned',
        'created_at',
    ];

    protected $casts = [
        'raw_json'   => 'array',
        'is_assigned'=> 'boolean',
        'created_at'=> 'datetime',
    ];

    /**
     * Relation: belongs to uploaded excel
     */
    public function uploadedExcel()
    {
        return $this->belongsTo(UploadedExcel::class, 'uploaded_excel_id');
    }
}
