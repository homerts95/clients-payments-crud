<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    public const TABLE_NAME = 'clients';
    public const NAME = 'name';
    public const SURNAME = 'surname';
    public const CREATED_AT = 'created_at';

    public const UPDATED_AT = 'updated_at';

    protected $fillable = [
        self::NAME,
        self::SURNAME,
    ];
    protected $casts = [
        self::CREATED_AT => 'datetime',
        self::UPDATED_AT => 'datetime',
    ];


    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
