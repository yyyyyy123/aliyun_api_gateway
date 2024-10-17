<?php
/**
 *
 * sdk 对外通用类。
 * 只需调用这个类就可以使用阿里云接口了。
 *
 */
namespace YYY\Aliyun\ApiGateWay;

use YYY\Aliyun\ApiGateWay\Constant\ContentType;
use YYY\Aliyun\ApiGateWay\Constant\HttpHeader;
use YYY\Aliyun\ApiGateWay\Constant\HttpMethod;
use YYY\Aliyun\ApiGateWay\Constant\SystemHeader;
use YYY\Aliyun\ApiGateWay\Http\HttpClient;
use YYY\Aliyun\ApiGateWay\Http\HttpRequest;
use YYY\Aliyun\ApiGateWay\Http\HttpResponse;

class ApiClient
{
    private static $client;

    protected $appKey;
    protected $appSecret;

    private function __construct($appKey, $appSecret)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
    }

    /**
     * @param $appKey string 购买阿里云云市场api时，订单中会得到此参数
     * @param $appSecret string 购买阿里云云市场api时，订单中会得到此参数
     * @return self
     */
    public static function getInstance($appKey, $appSecret)
    {
        if (!self::$client) {
            self::$client = new self($appKey, $appSecret);
        }
        return self::$client;
    }

    /**
     * 发送get请求。
     *
     * @param $host string  接口主机名， 在购买api的页面，请求示例中有此参数。
     * @param $path string 接口路径， 在购买api的页面，请求示例中有此参数。
     * @param $params array 参数数组，如果此接口无需传参，则传入[]，另外，本参数无需 urlencode 处理，因为本sdk内部会自动处理。所以直接传汉字ok
     * @return HttpResponse 返回对象是本sdk内部的一个对象，有 getContent,getBody 等方法，请自行查阅源代码。
     */
    public function get($host, $path, $params)
    {
        $request = new HttpRequest($host, $path, HttpMethod::GET, $this->appKey, $this->appSecret);

        //设定Content-Type，根据服务器端接受的值来设置
        //  array_push($headers, "Content-Type".":"."application/x-www-form-urlencoded; charset=UTF-8");
        $request->setHeader(HttpHeader::HTTP_HEADER_CONTENT_TYPE, ContentType::CONTENT_TYPE_FORM);

        //设定Accept，根据服务器端接受的值来设置
        // array_push($headers, "Accept".":"."application/json; charset=UTF-8");
        $request->setHeader(HttpHeader::HTTP_HEADER_ACCEPT, ContentType::CONTENT_TYPE_JSON);

        //注意：业务query部分，如果没有则无此行；请不要、不要、不要做UrlEncode处理
        foreach ($params as $k => $v) {
            $request->setQuery($k, $v);
        }
        //指定参与签名的header
        $request->setSignHeader(SystemHeader::X_CA_TIMESTAMP);

        return HttpClient::execute($request);

    }

    /**
     * 发送post请求。
     *
     * @param $host string  接口主机名， 在购买api的页面，请求示例中有此参数。
     * @param $path string 接口路径， 在购买api的页面，请求示例中有此参数。
     * @param $params array 参数数组，如果此接口无需传参，则传入[]，另外，本参数无需 urlencode 处理，因为本sdk内部会自动处理。所以直接传汉字ok
     * @return HttpResponse 返回对象是本sdk内部的一个对象，有 getContent,getBody 等方法，请自行查阅源代码。
     */
    public function post($host, $path, $params)
    {
        $request = new HttpRequest($host, $path, HttpMethod::POST,
            $this->appKey, $this->appSecret);

        //设定Content-Type，根据服务器端接受的值来设置
        //  array_push($headers, "Content-Type".":"."application/x-www-form-urlencoded; charset=UTF-8");
        $request->setHeader(HttpHeader::HTTP_HEADER_CONTENT_TYPE, ContentType::CONTENT_TYPE_FORM);

        //设定Accept，根据服务器端接受的值来设置
        // array_push($headers, "Accept".":"."application/json; charset=UTF-8");
        $request->setHeader(HttpHeader::HTTP_HEADER_ACCEPT, ContentType::CONTENT_TYPE_JSON);

        //注意：业务body部分，如果没有则无此行；请不要、不要、不要做UrlEncode处理
        foreach ($params as $k => $v) {
            $request->setBody($k, $v);
        }
        //指定参与签名的header
        $request->setSignHeader(SystemHeader::X_CA_TIMESTAMP);

        return HttpClient::execute($request);


    }


}