<?php

namespace Ecjia\App\Affiliate\Models;

use Royalcms\Component\Database\Eloquent\Model;

class AffiliateStoreRecordModel extends Model
{

    protected $table = 'affiliate_store_record';

    /**
     * 可以被批量赋值的属性。
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * 该模型是否被自动维护时间戳
     *
     * @var bool
     */
    public $timestamps = false;


}