<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

/**
 * Class RbcNews
 * @package App\Models
 *
 * @property int id
 * @property string rbc_id
 * @property string $title
 * @property string $description
 * @property string $url
 * @property string $image_url
 * @property Date $date
 * @property Date $created_at
 * @property Date $updated_at
 *
 */
class RbcNews extends Model
{
    protected $fillable = [
        'rbc_id',
        'title',
        'description',
        'url',
        'image_url',
        'date'
    ];

    protected $casts = [
        'date',
    ];
}
