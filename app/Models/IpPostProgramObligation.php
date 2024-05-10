<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IpPostProgramObligation extends Model
{
    use HasFactory;

    protected $table = 'ip_post_program_obligations';

    protected $fillable = [
        'event_id',
        'user_id',
        'post_program_eval_report',
        'policy_brief',
        'group_terminal_report',
        'volunteer_work',
        'advocacy_plan',
        'files_link',
    ];

    public function ipEvents()
    {
        return $this->belongsTo(IpEvents::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
