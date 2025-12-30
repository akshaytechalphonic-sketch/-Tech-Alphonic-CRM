<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'destination',
        'destination_amount',
        'amount_hr',
        'bonus',
        'edli',
        'epf_admin_charge',
        'optional_allowance1',
        'optional_allowance2',
        'optional_allowance3',
        'overtime_hours',
        'overtime_remuneration',
        'esi',
        'provident_fund',
        'my_profit',
    ];


    public function getClient()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }


}
