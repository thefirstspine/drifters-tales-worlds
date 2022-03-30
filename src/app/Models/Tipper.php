<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tipper
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Tipper newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tipper newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tipper query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tipper whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipper whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipper whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tipper whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Tipper extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
