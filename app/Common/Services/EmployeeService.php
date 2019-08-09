<?php
/**
 * Created by PhpStorm.
 * User: chengjian
 * Date: 2018/12/18
 * Time: 下午5:17
 */

namespace App\Common\Services;

use App\Common\Services\BaseService;
use Illuminate\Support\Facades\Log;
use App\Common\Models\Region;
use App\Common\Repositories\EmployeeRepository;

class EmployeeService extends BaseService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getEmployee($params)
    {
        $data = ['uid'=>$params['uid']];
        return $this->employeeRepository->getEmployee($data);
    }

    public function insertEmployee($params)
    {
        if (!empty($params['uid']) && !empty($params['dealer_code'])) {
            $data['name'] = $params['last_name'].' '.$params['first_name'];
            $data['last_name'] = $params['last_name'];
            $data['uid'] = $params['uid'];
            $data['first_name'] = $params['first_name'];
            $data['job_code'] = $params['job_code'];
            $data['employee_category_id'] = 2;
            $data['subdivide_category_id'] = 3;
            $data['dealer_code'] = $params['dealer_code'];
            $data['email'] = $params['email'];
            $data['create_time'] = time();
            $data['update_time'] = time();
            $data['last_login_time'] = time();
            $data['region_id'] = 0;
            if (!empty($params['region_code'])) {
                $region = Region::where(['code' => $params['region_code']])->first();
                if (!empty($region)) {
                    $data['region_id'] = $region['id'];
                }
            }
            return $this->employeeRepository->insert($data);
        }
        else {
            $data['name'] = $params['last_name'].' '.$params['first_name'];
            $data['last_name'] = $params['last_name'];
            $data['uid'] = $params['uid'];
            $data['first_name'] = $params['first_name'];
            $data['job_code'] = $params['job_code'];
            $data['employee_category_id'] = 1;
            $data['subdivide_category_id'] = 5;
            $data['email'] = $params['email'];
            $data['create_time'] = time();
            $data['update_time'] = time();
            $data['last_login_time'] = time();
            $data['region_id'] = 0;
            if (!empty($params['region_code'])) {
                $region = Region::where(['code' => $params['region_code']])->first();
                if (!empty($region)) {
                    $data['region_id'] = $region['id'];
                }
            }
            return $this->employeeRepository->insert($data);
        }
    }

    public function updateEmployee($params)
    {
        if (!empty($params['uid']) && !empty($params['dealer_code'])) {
            $condition = ['uid' => $params['uid']];
            $data['name'] = $params['last_name'].' '.$params['first_name'];
            $data['last_name'] = $params['last_name'];
            $data['first_name'] = $params['first_name'];
            $data['job_code'] = $params['job_code'];
            $data['dealer_code'] = $params['dealer_code'];
            $data['employee_category_id'] = 2;
            $data['subdivide_category_id'] = 3;
            $data['email'] = $params['email'];
            $data['update_time'] = time();
            $data['last_login_time'] = time();
            $data['region_id'] = 0;
            if (!empty($params['region_code'])) {
                $region = Region::where(['code' => $params['region_code']])->first();
                if (!empty($region)) {
                    $data['region_id'] = $region['id'];
                }
            }
            return $this->employeeRepository->update($condition,$data);
        }
        else {
            $condition = ['uid' => $params['uid']];
            $data['name'] = $params['last_name'].' '.$params['first_name'];
            $data['last_name'] = $params['last_name'];
            $data['first_name'] = $params['first_name'];
            $data['job_code'] = $params['job_code'];
            $data['dealer_code'] = $params['dealer_code'];
            $data['employee_category_id'] = 1;
            $data['subdivide_category_id'] = 5;
            $data['email'] = $params['email'];
            $data['update_time'] = time();
            $data['last_login_time'] = time();
            $data['region_id'] = 0;
            if (!empty($params['region_code'])) {
                $region = Region::where(['code' => $params['region_code']])->first();
                if (!empty($region)) {
                    $data['region_id'] = $region['id'];
                }
            }

            return $this->employeeRepository->update($condition,$data);
        }
    }
}