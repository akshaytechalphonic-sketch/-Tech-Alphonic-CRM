<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UploadedExcel extends Model
{
    use HasFactory;


     protected $table = 'uploaded_excels';

    public $timestamps = false; 
    protected $fillable = [
        'file_name',
        'original_name',
        'total_rows',
        'total_columns',
        'uploaded_by',
        'UploadedExcel',
        'created_at' ,
        'updated_at',
        'status',
    ];


    public function lastDistribution()
{
    return $this->hasOne(ExcelDistribution::class, 'uploaded_excel_id')
                ->latestOfMany(); // Laravel 8+
}

  public function uploadedexcelrow(){
    return $this->hasMany(UploadedExcelRow::class,'uploaded_excel_id');
  }

}
