<?php

namespace App\Model;

class CustomerModel extends CommonModel
{
    //
    public $table           = 'customer';
    protected $primaryKey  = 'uid';

    public static function getAllCustomer(){
        $self = new self();
        $result = $self->get();
        return $result;
    }
    public static function getDetail(){
        $self = new self();
        $result = $self->first();
        return $result;
    }
}
