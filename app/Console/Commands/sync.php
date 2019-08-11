<?php

namespace App\Console\Commands;

use App\Common\Services\MsgService;
use App\Modules\Common\Http\Controllers\MsgContentControllers;
use App\Services\WechatService;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


set_time_limit(0); //解除PHP脚本时间30s限制
ini_set('memory_limit','128M');//修改内存值
class sync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sync {param?} {--func=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description: 调用示例,联系人同步:
php artisan command:sync contacts or php artisan command:sync --func=contacts ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        // 入口方法
        $param = $this->argument('param'); // argument不指定参数名的情况下用 file
        $func = $this->option('func'); // option用--开头指定参数名 --func=file
        $method =  isset($param) ? $param : $func;//兼容两种传参方式调用
        //本类中是否存在传来的方法
        if(!method_exists(new self,$method)){
            echo '不存在的方法，请确认输入是否有误！';
        }else{
            self::$method();
        }

    }
    //同步
    public static function index(){
        $s = 0;//从0开始
        $e = 10; //取10条数据
        while(true){//死循环模拟分页执行代码

            if($s >=100){//满足条件跳出死循环
                exit('success');
            }
            //执行代码
            file_put_contents('./test.log',$s.'--'.$e."\n",FILE_APPEND);

            $s = $s+$e; //下次分页开始
        }
    }

    //发送微信消息
    public static  function sendWxMsg(){
        (new MsgService())->handle();
    }
    //文件同步
    public static  function file(){
        echo"文件同步";

    }

    //会员同步
    public static  function user(){
        echo"会员同步";

    }
    //联系人同步
    public static function contacts(){
        echo "联系人同步";
    }

}
