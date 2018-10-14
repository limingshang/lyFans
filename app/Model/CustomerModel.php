<?php

namespace App\Model;

class CustomerModel extends CommonModel
{
    //
    public $table                   = 'customer';
    protected $primaryKey           = 'uid';
    protected static $key          = 'uid';
    public $timestamps = true;
    protected static $fields = [
        'uid',
        'username',
        'nickanem',
        'password',
        'birthday',
        'sign',
        'regTime',
        'regIP',
        'source',
        'source',
        'sex',
        'status',
    ];
}
