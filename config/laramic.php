<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Server model class
    |--------------------------------------------------------------------------
    |
    | You can extend and modify this class by your needs
    |
    */

    'server_model' => \Laramic\Mailer\Models\MailServer::class,


    /*
    |--------------------------------------------------------------------------
    | Database table name for servers
    |--------------------------------------------------------------------------
    |
    | By default we set up this table name but this can be changed if you
    | need so.
    |
    */
    'server_table_name' => 'laramic_servers',


    /*
    |--------------------------------------------------------------------------
    | Server model class
    |--------------------------------------------------------------------------
    |
    | You can extend and modify this class by your needs
    |
    */

    'logs_model' => \Laramic\Mailer\Models\MailServerLog::class,

    /*
    |--------------------------------------------------------------------------
    | Database table name for logs
    |--------------------------------------------------------------------------
    |
    | By default we set up this table name but this can be changed if you
    | need so.
    |
    */
    'logs_table_name' => 'laramic_server_logs',


    /*
    |--------------------------------------------------------------------------
    | Author
    |--------------------------------------------------------------------------
    |
    | Here you have to specify the model class that will be used as author
    | for the mail server logs ( usualy `users` table ).
    |
    */
    'author_table' => 'users',
    'author_primary_key' => 'id',
];
