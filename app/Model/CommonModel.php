<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CommonModel extends Model
{
    //
    public static function getResultList($condition, $where, $fields, $order, $limit){
        $self = new self();
        $result = $self->get();
        return $result;
    }
}
