<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $fillable =[
        'name',
        'phone_number',
        'contact_group_id',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function ContactGroup()
    {
        return $this->belongsTo(ContactGroup::class);
    }
}
