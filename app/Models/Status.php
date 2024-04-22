<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = ['accepted', 'rejected', 'loading'];

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
            'loading' => false, // Assuming loading is set to false when approved
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
            'loading' => false, // Assuming loading is set to false when rejected
        ]);
    }
}
