<?php
/**
 * Created by PhpStorm.
 * User: chengjian
 * Date: 2018/12/26
 * Time: 上午11:23
 */

namespace App\Common\Services;

use App\Common\Services\BaseService;
use Illuminate\Support\Facades\Log;
use App\Common\Repositories\CommomRepositories;
use App\Common\Models\Menu;
use App\Common\Models\RelQuestionTag;

class CommomService extends BaseService
{
    protected $commomRepositories;

    public function __construct(CommomRepositories $commomRepositories)
    {
        $this->commomRepositories = $commomRepositories;
    }

    public function labels()
    {
        $theme = $this->commomRepositories->getLabels(['is_delete' => 0,'type' => 1],['id','name']);

        $category = $this->commomRepositories->getLabels(['is_delete' => 0,'type' => 2],['id','name']);

        $data = ['theme' => $theme,'category' => $category];

        return $data;
    }

    public function getLabels()
    {
        $labels = $this->commomRepositories->getLabels(['is_delete' => 0],['id','name','type']);
        foreach ($labels as $key => $val ) {
            $relQuestion = RelQuestionTag::where(['label_id'=>$val['id']])->get();
            $labels[$key]['relation_question_number'] = (string)count($relQuestion);
            $labels[$key]['type'] = (string)$labels[$key]['type'];
        }

        $data = [
            'data_list' => $labels,
        ];
        return $data;
    }

    public function addLabel($params,$operator_id)
    {
        try {
            $id = $this->commomRepositories->addLabel(['name'=>$params['name'],'type'=>(int)$params['type'],'operator_id'=>$operator_id,'create_time'=>time()]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $data = ['id'=>$id];
        return $data;
    }

    public function updateLabel($params,$id)
    {
        $updateParams = [];
        if (!empty($params['name']))
        {
            $updateParams['name'] = $params['name'];
        }

        if (!empty($params['type']))
        {
            $updateParams['type'] = $params['type'];
        }

        try {
            $this->commomRepositories->updateLabel(['id'=>$id],$updateParams);
        }catch (\Exception $e) {
            return $e->getMessage();
        }

        return $data = [];
    }

    public function deleteLabel($id)
    {
        try {
            $this->commomRepositories->updateLabel(['id'=>$id],['is_delete'=>time()]);
        }catch (\Exception $e) {
            return $e->getMessage();
        }
        return $data = [];
    }

    public function getRegions()
    {
        $regions = $this->commomRepositories->getRegions(['is_delete'=>0]);
        $data = [
            'data_list' => $regions,
        ];
        return $data;
    }

    public function getMenus()
    {
        $select = ['id','menu_name','parent_id','menu_url'];
        $parent_data =  Menu::where('parent_id', 0)
            ->select($select)
            ->orderby('sort','asc')
            ->get()
            ->toArray();

        $children_data =  Menu::where('parent_id','>', 0)
            ->select($select)
            ->orderby('sort','asc')
            ->get()
            ->toArray();

        foreach ($parent_data as $key => $val ){
            foreach ($children_data as $k => $v ){
                if ($val['id'] == $v['parent_id']) {
                    $parent_data[$key]['children'][] = $v;
                }
            }

            if($val['parent_id'] == null) {
                $parent_data[$key]['parent_id'] = 0;
            }
        }

        $data = [
            'data_list' => $parent_data,
        ];
        return $data;
    }
}