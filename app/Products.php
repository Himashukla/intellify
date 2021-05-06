<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model
{
    use SoftDeletes;
    protected $data = 'deleted_at';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'merchant_id','name','description', 'price', 'quantity','status'
    ];

    public function merchant() {
		return $this->hasOne('App\User', 'id', 'merchant_id');
	}
}
