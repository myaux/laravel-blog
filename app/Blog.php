<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    //
    protected $table = 'blogs';

    protected $primaryKey = 'id';

    //设置时间戳自动维护，通过模型来添加个修改数据库时，created_at  和 updated_at  都会对应的变动
    public $timestamps = true;

    //设置填充的黑白名单
    protected $guarded = ['id', 'created_at', 'updated_at'];
}
