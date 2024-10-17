<?php
//spl_autoload_register(function ($class) {
//    $prefix = 'YYY\\Aliyun\\ApiGateWay\\';
//
//    // base directory for the namespace prefix
//    $base_dir = __DIR__ . '/src/';
//
//    // does the class use the namespace prefix?
//    $len = strlen($prefix);
//
//    // get the relative class name
//    $relative_class = substr($class, $len);
//    $file = $base_dir . str_replace('\\', '/', $class) . '.php';
//
//    $file = preg_replace( '#/YYY/Aliyun/ApiGateWay#','',$file );
//
//    if (file_exists($file)) {
//        require $file;
//    }
//});

// 这是一个示例，展示了如何使用本sdk调用接口。

$appKey='20XXXXXX';
$appSecret='zVXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX';
$host='https://XXXXX.market.alicloudapi.com';
$path = "/XXX/XXX";

$help =  \YYY\Aliyun\ApiGateWay\ApiClient::getInstance( $appKey, $appSecret );
// 只有post，get两个方法。
$response = $help->post( $host, $path,[
    'name'=>'XXXX',
    'account'=>'1XXXXXXXXXXXXXXXXXXX',
] );

// 返回是字符串。
echo $response->getBody();
// 返回类似如下代码，特别注意，每个接口返回的字段都很不一样。不可以套用。
//{"data":{"count":1,"items":[{"Name":"XXX","Abc":"IC","province":""}]},"msg":"成功","success":true,"taskNo":"742436029166773500611327"}






