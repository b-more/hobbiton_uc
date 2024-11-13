<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentIntent extends Model
{
    use HasFactory;

    protected $fillable = [
        "payment_method_id",
        "payment_status_id",
        "payment_channel_id",
        "feature_id",
        "transaction_number",
        "phone_number",
        "amount",
        "status"
    ];

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function paymentChannel()
    {
        return $this->belongsTo(PaymentChannel::class);
    }

    public function paymentStatus()
    {
        return $this->belongsTo(PaymentStatus::class);
    }

    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
}
