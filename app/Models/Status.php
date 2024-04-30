<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['accepted', 'rejected', 'pending'];

    /**
     * Scope a query to only include pending requests.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePending($query)
    {
        return $query->whereNull('accepted')->whereNull('rejected');
    }

    /**
     * Approve the request.
     *
     * @return void
     */
    public function approve()
    {
        $this->update([
            'accepted' => true,
            'pending' => false, // Assuming pending is set to false when approved
        ]);
    }

    /**
     * Reject the request.
     *
     * @return void
     */
    public function reject()
    {
        $this->update([
            'rejected' => true,
            'pending' => false, // Assuming pending is set to false when rejected
        ]);
    }
}
