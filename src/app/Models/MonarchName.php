<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MonarchName
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MonarchName newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonarchName newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MonarchName query()
 * @method static \Illuminate\Database\Eloquent\Builder|MonarchName whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonarchName whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonarchName whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MonarchName whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class MonarchName extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
}
