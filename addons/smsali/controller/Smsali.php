<?php

// This file is auto-generated, don't edit it. Thanks.

namespace addons\smsali\controller;

use Darabonba\OpenApi\OpenApiClient;
use AlibabaCloud\OpenApiUtil\OpenApiUtilClient;

use Darabonba\OpenApi\Models\Config;
use Darabonba\OpenApi\Models\Params;
use AlibabaCloud\Tea\Utils\Utils\RuntimeOptions;
use Darabonba\OpenApi\Models\OpenApiRequest;

class Smsali
{
    /**
     * 使用AK&SK初始化账号Client
     * @param string $accessKeyId
     * @param string $accessKeySecret
     * @return OpenApiClient Client
     */
    public static function createClient($accessKeyId, $accessKeySecret)
    {
        $config = new Config([
            // 必填，您的 AccessKey ID
            "accessKeyId" => $accessKeyId,
            // 必填，您的 AccessKey Secret
            "accessKeySecret" => $accessKeySecret
        ]);
        // 访问的域名
        $config->endpoint = "dysmsapi.aliyuncs.com";
        return new OpenApiClient($config);
    }

    /**
     * API 相关
     * @return Params OpenApi.Params
     */
    public static function createApiInfo()
    {
        $params = new Params([
            // 接口名称
            "action" => "SendSms",
            // 接口版本
            "version" => "2017-05-25",
            // 接口协议
            "protocol" => "HTTP",
            // 接口 HTTP 方法
            "method" => "POST",
            "authType" => "AK",
            "style" => "RPC",
            // 接口 PATH
            "pathname" => "/",
            // 接口请求体内容格式
            "reqBodyType" => "json",
            // 接口响应体内容格式
            "bodyType" => "json"
        ]);
        return $params;
    }

    /**
     * @param string[] $args
     * @return void
     */
    public static function send($receiver, $content)
    {
        // 工程代码泄露可能会导致AccessKey泄露，并威胁账号下所有资源的安全性。以下代码示例仅供参考，建议使用更安全的 STS 方式，更多鉴权访问方式请参见：https://help.aliyun.com/document_detail/311677.html
        $client = self::createClient("LTAI5tNMWbSDQ8Dcefh85A9EE", "DsUavNLs3EuypWRSvFVRuDlND6Uod5E");
        $params = self::createApiInfo();
        // query params
        $arr = ['code' => $content];
        $queries = [];
        $queries["PhoneNumbers"] = $receiver;
        $queries["SignName"] = "小码笔记";
        $queries["TemplateCode"] = "SMS_277455300";
        $queries["TemplateParam"] = json_encode($arr);
        // runtime options
        $runtime = new RuntimeOptions([]);
        $request = new OpenApiRequest([
            "query" => OpenApiUtilClient::query($queries)
        ]);
        // 复制代码运行请自行打印 API 的返回值
        // 返回值为 Map 类型，可从 Map 中获得三类数据：响应体 body、响应头 headers、HTTP 返回的状态码 statusCode
        dump($client->callApi($params, $request, $runtime));
    }
}
