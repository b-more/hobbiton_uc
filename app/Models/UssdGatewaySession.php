<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UssdGatewaySession extends Model
{
    use HasFactory;

    protected $fillable = [
        "session_id",
        "network",
        "phone_number",
        "project_status",
        "main_short_code",
        "short_code"
    ];
}
