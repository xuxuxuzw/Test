<?php
/**
 * Created by PhpStorm.
 * User: chengjian
 * Date: 2018/12/18
 * Time: 下午5:25
 */

namespace App\Common\Repositories;

use App\Common\Repositories\BaseRepository;
use App\Common\Models\Employee;

class EmployeeRepository extends BaseRepository
{
    protected $employee;

    public function __construct(Employee $employee)
    {
        $this->employee = $employee;
    }

    public function update($condition,$params) {
        return $this->employee
                ->where($condition)
                ->update($params);
    }

    public function insert($params) {
        return $this->employee
                 ->insertGetId($params);
    }

    public function getEmployee($condition) {
        return $this->employee
                ->where($condition)
                ->first();
    }
}