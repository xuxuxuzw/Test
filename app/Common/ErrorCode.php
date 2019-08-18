<?php

namespace App\Common;


class ErrorCode
{

    //==================================系统相关====================================
    /**
     * 预定义状态码，1为正确返回，小于0为对应的错误，
     * 自定义错误码必须从-1000以后开始定义，
     * 并以模块名称为前缀防止重名（如优惠券模块:COUPON_XX)
     */
    const SUCCESS = 1;                              // 成功状态
    const SYS_REQUEST_METHOD_ERROR = -1;            // 请求方法错误
    const SYS_REQUEST_PARAMS_ERROR = -2;            // 请求参数错误
    const SYS_REQUEST_PARAMS_MISSING = -3;          // 缺少请求参数
    const APP_ID_ERROR = -4;                        // appid错误
    const SYS_SYSTEM_ERROR = -100;                  // 系统异常
    const SYS_USER_TOKEN_EXPIRE = -401;             // 用户Token过期
    const SYS_USER_VERIFY_FAIL = -402;              // 用户认证失败，请重新登录
    const SALE_APP_NO_EXIST = -403;                 // 认证登录失败
    const SYS_INTERFACE_NOT_EXIST = -404;           // 接口不存在
    const SYS_DB_ERROR = -999;                      // 数据库操作错误
    const SYS_DATA_NOT_EXISTS = -1000;              // 您查找数据不存在


    //==================================公共====================================
    const PERMISSION_DENIED = -10000; //没有权限
    const PHONE_ERROR = -10001; //手机号码格式错误
    const PHONE_CODE_ERROR = -10003; //验证码错误
    const PHONE_BINDED = -10004; //该手机号码已绑定
    const TIME_RULE = -10005;     // 时间规则

    //==================================登录、用户====================================
    const ACCOUNT_CANT_BE_EMPTY = -20000; //账号不能为空
    const PASSWORD_CANT_BE_EMPTY = -20001; //密码不能为空
    const ACCOUNT_NO_EXIST = -20002; //账号不存在
    const ACCOUNT_OR_PASSWORD_ERROR = -20003; //账号或密码不正确
    const USER_IS_DISABLE = -20004; //账号暂时不能使用，请联系客服
    const PHONE_CODE_SEND_FAIL = -20005; //验证码发送失败
    const AGENT_EXISTS = -20006;     // 代理商名称或账号已存在
    const SUPPLIER_EXISTS = -20007;     // 供应商名称或账号已存在
    const HOUSEKEEPER_EXISTS = -20008;     // 管家名称或手机号码已存在
    const BASIC_ADMIN_EXISTS = -20009;     // 运营人员手机号码已存在

    //==================================商品相关====================================
    const PRODUCT_NOT_SALE = -30000;     // 商品已下架
    const PRODUCT_PRICE_EMPTY = -30001;     // 请填写售价信息
    const PRODUCT_INVENTORY_FORMAT_ERROR = -30002;     // 请填写正确的库存格式
    const INVENTORY_NOT_ENOUGH = -30003;     // 库存不足
    const CHECK_TIME_CANT_EMPTY = -30004;     // 请选择入住时间/离店时间
    const CHECKINTIME_MUST_EGT_NOWTIME = -30005;     // 入住时间不能小于当前时间
    const CHECKOUTTIME_MUST_EGT_CHECKINTIME = -30006;     // 离店时间必须大于入住时间
    const GOODS_RECOMMEND_CATEGORY_NAME_EXIST = -30007;     // 商品推荐分类名称已存在
    const COMMENT_CATEGORY_NAME_EXIST = -30008; //评价分类名称已存在
    const COMMENT_EXIST = -30009; //已评价

    const SECKILL_SCTIVITY_DISABLE = -31001; //秒杀活动禁用
    const SECKILL_SCTIVITY_NOT_BEGIN = -31002; //秒杀活动未开始
    const SECKILL_SCTIVITY_END = -31003; //秒杀活动已结束
    const SECKILL_SCTIVITY_LOW_STOCKS = -31004; //库存不足
    const SECKILL_SCTIVITY_LIMIT_ONE = -31005; //每次只能购买一件
    const SECKILL_SCTIVITY_BUY_LIMIT = -31006; //超过购买限制


    const GOODS_NOT_HAVEL_INTELLIGENT_DOOR_LOCK = -32001; //该门锁暂不支持获取密码intelligent_door_lock

    //==================================订单相关====================================
    const ORDER_SOURCE_IS_NULL = -40001;     // 请选择渠道来源
    const PAY_WAY_IS_NULL = -40002;     // 请选择支付方式
    const PRODUCT_GOODS_IS_NULL = -40003;     // 请选择房型
    const UNKNOW_WHO_HE_IS = -40004;     // 对不起，不知道你是谁
    const ORDER_STATUS_INCORRECT = -40005;     // 创建订单是失败，订单状态不正确
    const ORDER_CONTACT_NAME_IS_NULL = -40006;     // 请填写联系人
    const CHECK_IN_COUNT_IS_NULL = -40007;     // 请填写入住人数
    const ORDER_CONTACT_PHONE_IS_NULL = -40008;     // 请填写联系人手机号码
    const CHECK_IN_TIME_IS_NULL = -40009;     // 请选择入住时间
    const CHECK_OUT_TIME_IS_NULL = -40010;     // 请选择离店时间
    const ORDER_PAY_WAY_IS_NULL = -40011;     // 请选择支付方式
    const ORDER_TOTAL_FEE_IS_NULL = -40012;     // 订单总额只能为大于0的数字
    const ORDER_ADVANCE_CHARGE_IS_NULL = -40013;     // 预付款订单，预付款只能为大于0的数字
    const ORDER_AC_MBT_TOTAL_FEEE = -40014;     // 订单总额不能小于预付金
    const ORDER_CANT_PAY = -40015;     // 订单支付失败
    const NOT_PERMIT_TO_READ_ORDER_DETAIL = -40016;     // 不允许读取订单详情

    const WECHAT_MINIPROGRAM_CODE_IS_ERROR = -41008;     // code不正确


    const CHECK_IN_NOT_COMPLETED = -42001; //未完成入住登记
    const CHECK_IN_NOT_TODAY = -42002; //不是今天入住
    const CHECK_IN_NOT_READY = -42003; //未能办理入住
    const CHECK_IN_MSG_NOT_CONFIRM = -42003; //入住信息未确认
    const ORDER_ACTION_NOT_ALLOW_TIME = -42004;//管家动作不在允许完成时间内

    //==================================优惠促销相关====================================
    const COUPON_USED = -50001;     // 优惠券已使用
    const COUPON_OVERDUE = -50002;     // 优惠券已使用
    const COUPON_VOIDED = -50003;     // 优惠券已作废
    const COUPON_BINDED = -50004;     // 优惠券已绑定
    const COUPON_INEFFECTIVE = -50005;     // 优惠券未生效
    const PROMOTION_END = -50006;     // 活动已结束

    const RED_PACKET_IS_EMPTY = -51001;     // 来太晚了，领完啦（红包领完了）

    //==================================地区管理相关====================================
    const AREA_NAME_EXISTS = -60001;     // 该地区名称已存在

    //==================================微信相关====================================
    const ILLEGAL_UNIONID = -70001; //UNIONID 非法
    const PLEASE_OPEN_IN_WECHAT_BROWSER = -70002; //请在微信浏览器打开


    //==================================活动相关====================================
    const RULE_JSON = -1458;


    //==================================分销商相关相关====================================
    const DISTRIBUTOR_HAND_OVER = -80001;

    //=================================第三方对接报错================================
    const API_ERROR_IP_ADDRESS_NOT_IN_WHITE_LIST = -100001; //ip地址不在白名单内
    const API_ERROR_SIGN_SI_EXPIRED = -100002; //签名已过期
    const API_ERROR_APP_ID_IS_NOT_FOUND = -100003; //app_id不存在
    const API_ERROR_SIGN_IS_ERROR = -100004; //签名错误
    const API_ERROR_SERIAL_NO_IS_REPEAT = -100005; //流水号重复
    const API_ERROR_SERIAL_NO_IS_NOT_FOUND = -100006; //流水号不存在
    const API_ERROR_VERSION_CAN_NOT_NULL = -100007; //版本号不能为空

    // 预定义错误信息
    public static $systemMessage = [
        //==================================系统相关====================================
        self::SUCCESS => '',
        self::SYS_REQUEST_METHOD_ERROR => '请求方法错误',
        self::SYS_REQUEST_PARAMS_ERROR => '请求参数错误',
        self::SYS_REQUEST_PARAMS_MISSING => '缺少请求参数',
        self::APP_ID_ERROR => 'appid错误',
        self::SYS_SYSTEM_ERROR => '系统繁忙，请稍后再试',
        self::SYS_USER_TOKEN_EXPIRE => '您的账号已在其它地方登陆，若不是本人操作，请注意账号安全！',
        self::SYS_USER_VERIFY_FAIL => '用户认证失败，请重新登录',
        self::SALE_APP_NO_EXIST => '认证登录失败',
        self::SYS_INTERFACE_NOT_EXIST => '接口不存在',
        self::SYS_DB_ERROR => '数据库操作错误',
        self::SYS_DATA_NOT_EXISTS => '您查找数据不存在',
    ];

    // 自定义的错误信息放到该数组下，参考systemMessage
    public static $customMessage = [

        //==================================公共================================
        self::PERMISSION_DENIED => '没有权限',
        self::PHONE_ERROR => '手机号码格式错误',
        self::TIME_RULE => '结束时间不能小于等于开始时间',     // 时间规则

        //==================================活动相关====================================
        self::RULE_JSON => '优惠规则不能为空',

        //==================================账号相关================================
        self::ACCOUNT_CANT_BE_EMPTY => '账号不能为空',
        self::PASSWORD_CANT_BE_EMPTY => '密码不能为空',
        self::ACCOUNT_NO_EXIST => '账号不存在',
        self::ACCOUNT_OR_PASSWORD_ERROR => '账号或密码不正确',
        self::USER_IS_DISABLE => '账号暂时不能使用，请联系客服',
        self::PHONE_CODE_SEND_FAIL => '验证码发送失败',
        self::PHONE_CODE_ERROR => '验证码错误',
        self::PHONE_BINDED => '该手机号码已绑定',
        self::SUPPLIER_EXISTS => '供应商名称或账号已存在',
        self::AGENT_EXISTS => '代理商名称或账号已存在',
        self::HOUSEKEEPER_EXISTS => '管家名称或手机号码已存在',
        self::BASIC_ADMIN_EXISTS => '运营人员手机号码已存在',

        //==================================商品相关================================
        self::PRODUCT_NOT_SALE => '商品已下架',
        self::PRODUCT_PRICE_EMPTY => '请填写售价信息',
        self::PRODUCT_INVENTORY_FORMAT_ERROR => '请填写正确的库存格式',
        self::INVENTORY_NOT_ENOUGH => '库存不足',
        self::CHECK_TIME_CANT_EMPTY => '请选择入住时间/离店时间',
        self::CHECKINTIME_MUST_EGT_NOWTIME => '入住时间不能小于当前时间',
        self::CHECKOUTTIME_MUST_EGT_CHECKINTIME => '离店时间必须大于入住时间',
        self::GOODS_RECOMMEND_CATEGORY_NAME_EXIST => '商品推荐分类名称已存在',
        self::SECKILL_SCTIVITY_DISABLE => '秒杀活动禁用',
        self::SECKILL_SCTIVITY_NOT_BEGIN => '秒杀活动未开始',
        self::SECKILL_SCTIVITY_END => '秒杀活动已结束',
        self::SECKILL_SCTIVITY_LOW_STOCKS => '库存不足',
        self::SECKILL_SCTIVITY_LIMIT_ONE => '每次只能购买一件',
        self::SECKILL_SCTIVITY_BUY_LIMIT => '超过购买限制',

        self::GOODS_NOT_HAVEL_INTELLIGENT_DOOR_LOCK => '该房源暂不支持智能门锁',

        //==================================订单相关====================================
        self::ORDER_SOURCE_IS_NULL => '请选择渠道来源',
        self::PAY_WAY_IS_NULL => '请选择支付方式',
        self::PRODUCT_GOODS_IS_NULL => '请选择房型',
        self::UNKNOW_WHO_HE_IS => '对不起，不知道你是谁',
        self::ORDER_STATUS_INCORRECT => '创建订单是失败，订单状态不正确',
        self::ORDER_CONTACT_NAME_IS_NULL => '请填写联系人',
        self::CHECK_IN_COUNT_IS_NULL => '请填写入住人数',
        self::ORDER_CONTACT_PHONE_IS_NULL => '请填写联系人手机号码',
        self::CHECK_IN_TIME_IS_NULL => '请选择入住时间',
        self::CHECK_OUT_TIME_IS_NULL => '请选择离店时间',
        self::ORDER_PAY_WAY_IS_NULL => '请选择支付方式',
        self::ORDER_TOTAL_FEE_IS_NULL => '订单总额只能为大于0的数字',
        self::ORDER_ADVANCE_CHARGE_IS_NULL => '预付款订单，预付款只能为大于0的数字',
        self::ORDER_AC_MBT_TOTAL_FEEE => '订单总额不能小于预付金',
        self::ORDER_CANT_PAY => '订单支付失败',
        self::NOT_PERMIT_TO_READ_ORDER_DETAIL => '不允许读取订单详情',

        self::WECHAT_MINIPROGRAM_CODE_IS_ERROR => 'code不正确',

        self::CHECK_IN_NOT_COMPLETED => '您还没有完成入住信息登记，暂不能获取入住密码',
        self::CHECK_IN_NOT_TODAY => '不是今天入住',
        self::CHECK_IN_NOT_READY => '未生效，不能办理入住',
        self::CHECK_IN_MSG_NOT_CONFIRM => '入住信息未确认',
        self::ORDER_ACTION_NOT_ALLOW_TIME => '管家动作不在允许完成时间内',
        //==================================地区管理相关====================================
        self::AREA_NAME_EXISTS => '该地区名称已存在',

        //==================================微信相关====================================
        self::ILLEGAL_UNIONID => 'UNIONID 非法',
        self::PLEASE_OPEN_IN_WECHAT_BROWSER => '请在微信浏览器打开',

        //==================================评价相关====================================
        self::COMMENT_CATEGORY_NAME_EXIST => '评价分类名称已存在',
        self::COMMENT_EXIST => '已评价',


        //==================================优惠促销相关====================================
        self::COUPON_USED => '优惠券已使用',
        self::COUPON_OVERDUE => '优惠券已过期',
        self::COUPON_VOIDED => '优惠券已作废',
        self::COUPON_BINDED => '优惠券已绑定',
        self::COUPON_INEFFECTIVE => '优惠券未生效',
        self::PROMOTION_END => '活动已结束',

        self::RED_PACKET_IS_EMPTY => '来太晚了，领完啦',

        //==================================分销商相关=================================
        self::DISTRIBUTOR_HAND_OVER => '该级别所属分销商未移交',

        //==================================第三方对接报错=================================
        self::API_ERROR_IP_ADDRESS_NOT_IN_WHITE_LIST => 'ip地址不在白名单内',
        self::API_ERROR_SIGN_SI_EXPIRED => '签名已过期',
        self::API_ERROR_APP_ID_IS_NOT_FOUND => 'app_id不存在',
        self::API_ERROR_SIGN_IS_ERROR => '签名错误',
        self::API_ERROR_SERIAL_NO_IS_REPEAT => '流水号重复',
        self::API_ERROR_SERIAL_NO_IS_NOT_FOUND => '流水号不存在',
        self::API_ERROR_VERSION_CAN_NOT_NULL => '版本号不能为空',
    ];

    // 包括预定义与自定义的错误信息
    protected static $errorMessage = null;

    public static function getAllErrorMessage()
    {
        static::initErrorMessage();
        return static::$errorMessage;
    }

    public static function getMessage($status)
    {
        static::initErrorMessage();
        return isset(static::$errorMessage[$status]) ? static::$errorMessage[$status] : static::$errorMessage[static::SYS_SYSTEM_ERROR];
    }

    private static function initErrorMessage()
    {
        if (!static::$errorMessage) {
            static::$errorMessage = static::$systemMessage + static::$customMessage;
        }
    }
}
