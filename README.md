
# yyy的阿里云云市场 api 接口签名调用 sdk


本项目代码主要根据阿里云官网提供的 demo 编写而成

- 阿里云官网 demo 不可以使用 composer，使用很不方便。
- 本项目的目的，在阿里云市场购买 api 接口后，不想使用不安全的 API 简单身份调用认证，想使用更安全的 API 签名调用认证，但苦于没有现成的 composer 库，本项目来提供解决方案。
- 签名调用的原理参见官网：https://help.aliyun.com/zh/api-gateway/traditional-api-gateway/user-guide/use-digest-authentication-to-call-an-api
- 最主要的代码在 Util/HttpUtil.php
- 排查错误，可以使用返回对象的 getContent() 等方法，会完整打印出所有返回信息含头信息。正常只需 getBody() 就可以得到接口的返回信息。
- 如想自己修改代码，无需改本类库，只需把类库根目录下的 ApiClient.php 取出拷贝到自己项目，然后随便改改就好用了。
- 本项目创建时间 2024-10-17 

```php
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

```

