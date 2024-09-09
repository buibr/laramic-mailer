<?php

namespace Laramic\Mailer\Models;

use Swift_Mailer;
use Swift_Transport;
use Swift_SmtpTransport;
use Illuminate\Mail\Mailer;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Laramic\Mailer\Enums\LaramicServerTypeEnum;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $uuid
 * @property string $type
 * @property string $mail_host
 * @property string $mail_port
 * @property string $mail_encryption
 * @property string $mail_username
 * @property string $mail_password
 * @property string $mail_from_address
 * @property string $mail_from_name
 * @property MailServerLog[] $logs
 * @property MailServerLog $lastTest
 */
class MailServer extends Model
{
    use HasFactory;

    public const CACHE_KEY = 'Laramic_servers_list';

    protected $fillable = [
        'uuid',
        'author_id',
        'type',
        'primary',
        'mail_host',
        'mail_port',
        'mail_encryption',
        'mail_username',
        'mail_password',
        'mail_from_address',
        'mail_from_name',
    ];

    protected $casts = [
        'type' => LaramicServerTypeEnum::class,
    ];

    public static function boot(): void
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string)Str::uuid();
        });

        static::created(function ($model) {
            Cache::forget(self::CACHE_KEY);
        });

        static::updated(function ($model) {
            Cache::forget(self::CACHE_KEY);
        });

        static::deleted(function ($model) {
            Cache::forget(self::CACHE_KEY);
        });
    }

    public function getTable()
    {
        return config('laramic.server_table_name', parent::getTable());
    }

    public function logs(): HasMany
    {
        return $this->hasMany(MailServerLog::class, 'server_id', 'id');
    }

    public function lastLog(): HasOne
    {
        return $this->hasOne(MailServerLog::class, 'server_id', 'id')->latest();
    }

    public function getTransport(): Swift_Transport
    {
        $transport = (new Swift_SmtpTransport($this->mail_host, $this->mail_port, $this->mail_encryption))
            ->setUsername($this->mail_username)
            ->setPassword($this->mail_password);

        return $transport;
    }

    public function getSwiftMail(): Swift_Mailer
    {
        // Create a Swift_SmtpTransport instance with the provided mail server settings
        $transport = $this->getTransport();

        // If the email is sent successfully, return true
        return new Swift_Mailer($transport);
    }

    public function getMailer()
    {
        $mailer = new Mailer(
            $this->mail_host,
            Mail::mailer('smtp')->getViewFactory(),
            $this->getSwiftMail()
        );

        $mailer->alwaysFrom($this->mail_username, $this->mail_from_name);
        $mailer->alwaysReplyTo($this->mail_username, $this->mail_from_name);
        $mailer->alwaysReturnPath($this->mail_username);

        return $mailer;
    }
}
