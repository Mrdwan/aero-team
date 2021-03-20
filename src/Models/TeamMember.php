<?php

namespace Mradwan\AeroTeam\Models;

use Aero\Common\Concerns\HasTranslation;
use Aero\Common\Models\Image;
use Aero\Common\Models\Model;
use Aero\Common\Traits\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class TeamMember extends Model
{
    use HasTranslation,
        Sluggable,
        SoftDeletes;

    /**
     * The attributes which have dialect.
     *
     * @var array
     */
    public $translatable = [
        'name',
        'content',
    ];

    protected $fillable = [
        'name',
        'content',
        'image_id',
    ];

    public function slugAttribute(): string
    {
        return 'name';
    }

    /**
     * The url of the post.
     *
     * @return string
     */
    public function getUriAttribute(): string
    {
        return config('team.uri').'/'.$this->slug->slug;
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function getHasImageAttribute(): bool
    {
        return $this->image_id !== null;
    }
}
