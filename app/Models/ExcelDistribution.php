<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExcelDistribution extends Model
{
    use HasFactory;

    protected $fillable = [
        'uploaded_excel_id',
        'folder_id',
        'start_row',
        'end_row',
        'run_at',
        'status'
    ];

    protected $casts = [
        'run_at' => 'datetime',
    ];


    public function uploadexcell(){
        return $this->belongsTo(UploadedExcel::class,'uploaded_excel_id');
    }

    public function employeefolder(){
        return $this->belongsTo(OfficeLeadsFolders::class,'folder_id');
    }
}
