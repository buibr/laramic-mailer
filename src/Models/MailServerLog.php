<?php

namespace Laramic\Mailer\Models;

use App\Models\MailServer;
use Illuminate\Database\Eloquent\Model;
use Laramic\Mailer\Enums\LaramicLogTypeEnum;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $type
 * @property string $success
 * @property string $rawResponse
 * @property MailServer $mailServer
 */
class MailServerLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'server_id',
        'author_id',
        'success',
        'rawResponse',
        'rawHeaders'
    ];

    protected $casts = [
        'type' => LaramicLogTypeEnum::class,
        'success' => 'boolean',
    ];

    public function getTable()
    {
        return config('laramic.logs_table_name', parent::getTable());
    }

    public function server(): BelongsTo
    {
        return $this->belongsTo(MailServer::class, 'server_id', 'id');
    }
}
