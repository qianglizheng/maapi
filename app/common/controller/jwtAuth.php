<?php

namespace app\common\controller;

use think\facade\Request;
use app\common\model\apiType;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\ExpiredException;
use DomainException;
use InvalidArgumentException;
use UnexpectedValueException;

/**
 * 单例模式
 */
class jwtAuth
{
    /**
     * 密钥
     */
    private $key;

    /**
     *playload
     */
    private $payload;

    /**
     * 用户ID
     */
    private $id;

    /**
     * jwtAuth句柄
     */
    private static $instance;

    /**
     * 错误信息error
     */
    private $errorInfo;

    /**
     * 获取jwtAuth的句柄
     */
    public static function getInstance()
    {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * 私有化构造函数
     */
    private function __construct()
    {
    }

    /**
     * 私有化克隆函数
     */
    private function __clone()
    {
    }

    /**
     * 解码token
     */
    public function decode($jwt)
    {
        try {
            $decodedToken = (array)JWT::decode($jwt, new Key($this->key, 'HS256'));
            $this->id = $decodedToken['id'];
            return $this;
        } catch (InvalidArgumentException $e) {
            $this->errorInfo =  '提供的密钥/密钥数组为空或格式不正确.';
            return $this;
        } catch (DomainException $e) {
            $this->errorInfo = "提供的算法不受支持,或者提供的密钥无效,或者在openSSL或libnaid中引发未知错误,或者libnaid是必需的但不可用.";
            return $this;
        } catch (SignatureInvalidException $e) {
            $this->errorInfo = '提供JWT签名验证失败.';
            return $this;
        } catch (BeforeValidException $e) {
            $this->errorInfo =  "如果JWT试图在“nbf”索赔之前使用,或者如果JWT在“iat”索赔之前尝试使用.";
            return $this;
        } catch (ExpiredException $e) {
            $this->errorInfo =  "token已经过期了.";
            return $this;
        } catch (UnexpectedValueException $e) {
            $this->errorInfo = "如果JWT格式不正确,或者如果JWT缺少算法/使用不支持的算法,或者JWT算法与提供的密钥不匹配,或者如果密钥/密钥数组中的密钥ID为空或无效.";
            return $this;
        }
    }

    /**
     * 设置用户ID
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * 设置payload
     */
    public function setPayload()
    {
        $this->payload = [
            'iss' => Request::domain(),        //签发者
            'aud' => 'user',                   //接收者
            'iat' => time(),                   //签发时间
            'exp' => time() + 3600 * 24,       //过期时间
            'id' => $this->id                  //用户ID
        ];
    }


    /**
     * 设置密钥
     */
    public function setKey()
    {
        $this->key = '11';
        return $this;
    }


    /**
     * 设置token
     */
    public function setToken()
    {
        $this->setPayload();
        $jwt = JWT::encode($this->payload, $this->key, 'HS256');
        return $jwt;
    }

    /**
     * 获取用户ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * 获取错误信息
     */
    public function getError()
    {
        $errorInfo = $this->errorInfo;
        return $errorInfo;
    }
}
