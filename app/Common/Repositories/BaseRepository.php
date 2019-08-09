<?php
/**
 * Created by PhpStorm.
 * User: 3N
 * Date: 2018/9/14
 * Time: 14:31
 */

namespace App\Common\Repositories;


class BaseRepository
{

    protected function page($page_no = NULL, $page_size = NULL)
    {
        empty($page_no) && $page_no = empty($_REQUEST['page_no']) ? 1 : $_REQUEST['page_no'];
        empty($page_size) && $page_size = empty($_REQUEST['page_size']) ? 10 : $_REQUEST['page_size'];
        $offset = ($page_no - 1) * $page_size;
        $offset = max(0, $offset);
        $page_size = max(0, $page_size);
        //"$offset,$page_num";
        return ['offset'=>$offset, 'limit'=>$page_size];
    }

}