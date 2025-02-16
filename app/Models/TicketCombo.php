<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketCombo extends Model
{
    use HasFactory;

    protected $table = 'ticketcombos';

    protected $fillable = [
        'combo_id',
        'quantity',
        'ticket_id',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id', 'id');
    }

    public function combo()
    {
        return $this->belongsTo(combo::class, 'combo_id', 'id');
    }
    
}
