<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Job;
use App\Models\User;
use Illuminate\Support\Facades\Log;


class Message extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sender_id',
        'recipient_id',
        'sender_type',
        'content',
        'is_read',
        'subject'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function recipient()
    {
        return $this->belongsTo(User::class, 'recipient_id');
    }
    public function markAsRead()
    {
        Log::info('Marking message as read. Message ID: ' . $this->id);
        $this->update(['is_read' => true]);
    }

    public function job()
    {
    return $this->belongsTo(Job::class);
    }

  






}
