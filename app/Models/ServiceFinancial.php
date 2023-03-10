<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceFinancial extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_reference_id',
        'service_type_id',
        'service_value',
        'payment_method_id',
        'discount',
        'additional_expenses',
        'commission_value',
        'net_total',
    ];

    public function serviceReference()
    {
        return $this->belongsTo(SeviceReference::class);
    }

    public function serviceType()
    {
        return $this->belongsTo(ServiceType::class);
    }

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
