<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UssdGateway extends Model
{
    use HasFactory;

    protected $fillable = [
        "business_id",
        "digits",
        "short_code",
        "main_short_code",
        "destination_url",
        "app_name",
        "app_description",
        "is_live",
        "is_active",
        "is_deleted"
    ];
}
