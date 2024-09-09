<?php

namespace Laramic\Mailer\Traits;

use Laramic\Mailer\Models\MailServer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasLaramicMail
{
    public static function bootHasLaramicMail()
    {
        static::deleting(function (Model $model) {
            if (in_array(SoftDeletes::class, class_uses_recursive($model))) {
                if (!$model->forceDeleting) {
                    return;
                }
            }

            $model->mailserver()->cursor()->each(fn(MailServer $setting) => $setting->delete());
        });
    }
    
    public function mailserver(): MorphMany
    {
        return $this->morphMany(config('laramic.server_model'), 'model');
    }
}
