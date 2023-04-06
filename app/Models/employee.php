<?php

namespace App\Models;
use App\Models\market;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;
	protected $table="employees";
	protected $guarded=[];

    /**
     * Get the user that owns the employee
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function market()
    {
        return $this->belongsTo(market::class);
    }
}
