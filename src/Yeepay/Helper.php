<?php

namespace Easypay\Yeepay;

class Helper
{
    public static function sign($data, $key)
    {
        $cleartext = '';
        #进行签名处理，一定按照文档中标明的签名顺序进行
        #加入业务类型
        $cleartext .= $data['bizType'];
        #加入商户编号
        $cleartext .= $data['merchantNo'];
        #加入商户订单号
        $cleartext .= $data['merchantOrderNo'];
        #加入支付金额
        $cleartext .= $data['requestAmount'];
        #加入商户接收支付成功数据的地址
        $cleartext .= $data['url'];
        #加入支付通道编码
        $cleartext .= $data['cardCode'];
        #加入商品名称
        $cleartext .= $data['productName'];
        #加入商品分类
        $cleartext .= $data['productType'];
        #加入商品描述
        $cleartext .= $data['productDesc'];
        #加入商户扩展信息
        $cleartext .= $data['extInfo'];

        return self::hmacMd5($cleartext, $key);
    }

    protected static function hmacMd5($data, $key)
    {
        // RFC 2104 HMAC implementation for php.
        // Creates an md5 HMAC.
        // Eliminates the need to install mhash to compute a HMAC
        // Hacked by Lance Rushing(NOTE: Hacked means written)

        $b = 64; // byte length for md5
        if (strlen($key) > $b) {
            $key = pack("H*", md5($key));
        }
        $key = str_pad($key, $b, chr(0x00));
        $ipad = str_pad('', $b, chr(0x36));
        $opad = str_pad('', $b, chr(0x5c));
        $k_ipad = $key ^ $ipad;
        $k_opad = $key ^ $opad;

        return md5($k_opad . pack("H*", md5($k_ipad . $data)));
    }
}
