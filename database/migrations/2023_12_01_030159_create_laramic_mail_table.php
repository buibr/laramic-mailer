<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaramicMailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $serverTable = config('laramic.server_table_name', 'laramic_servers');

        Schema::create($serverTable, function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->enum('type', \Laramic\Mailer\Enums\LaramicServerTypeEnum::toArray())->nullable();
            $table->boolean('primary')->default(0)->index();
            $table->string('mail_host')->nullable();
            $table->string('mail_port')->nullable();
            $table->string('mail_username')->nullable();
            $table->string('mail_password')->nullable();
            $table->string('mail_encryption')->nullable();
            $table->string('mail_from_address')->nullable();
            $table->string('mail_from_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        $logsTable = config('laramic.logs_table_name', 'laramic_server_logs');

        Schema::create($logsTable, function (Blueprint $table) use ($serverTable) {
            $authorTable = config('laramic.author_table', 'users');
            $authorPrimaryKey = config('laramic.author_primary_key', 'id');

            $table->id();
            $table->enum('type', \Laramic\Mailer\Enums\LaramicLogTypeEnum::toArray())->index();
            $table->foreignId('server_id')->nullable()
                ->constrained($serverTable)->onDelete('cascade');
            $table->foreignId('author_id')->nullable()
                ->constrained($authorTable, $authorPrimaryKey)->onDelete('cascade');
            $table->text('success')->nullable();
            $table->text('rawResponse')->nullable();
            $table->text('rawHeaders')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $serverTable = config('laramic.server_table_name', 'laramic_servers');
        $logsTable = config('laramic.logs_table_name', 'laramic_server_logs');

        Schema::dropIfExists($serverTable);
        Schema::dropIfExists($logsTable);
    }
}
