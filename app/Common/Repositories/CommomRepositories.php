<?php
/**
 * Created by PhpStorm.
 * User: chengjian
 * Date: 2018/12/26
 * Time: 上午11:26
 */

namespace App\Common\Repositories;

use App\Common\Repositories\BaseRepository;
use App\Common\Models\Label;

class CommomRepositories extends BaseRepository
{
    protected $label;

    public function __construct(Label $label)
    {
        $this->label = $label;

    }

    public function getLabels($condition,$select)
    {
        return $this->label
            ->where($condition)
            ->select($select)
            ->get();
    }

    public function addLabel($params)
    {
        return $this->label
            ->insertGetId($params);
    }

    public function updateLabel($condition,$params)
    {
        return $this->label
            ->where($condition)
            ->update($params);
    }
}