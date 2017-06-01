<?php

namespace Easypay\Common\Message;

/**
 * 跳转响应类
 */
abstract class AbstractRedirectResponse extends AbstractResponse
{
    /**
     * GET 跳转标识
     */
    const REDIRECT_METHOD_GET = 'GET';

    /**
     * POST 跳转标识
     */
    const REDIRECT_METHOD_POST = 'post';

    /**
     * 获取跳转地址
     * @return string 返回跳转地址
     */
    abstract public function getRedirectUrl();

    /**
     * 获取跳转标题
     * @return string 返回跳转标题
     */
    abstract public function getRedirectTitle();

    /**
     * 是否需要跳转
     * @return boolean 如果需要跳转则返回 true，反之返回 false
     */
    public function isRedirect()
    {
        return true;
    }

    /**
     * 跳转
     */
    public function redirect()
    {
        if (self::REDIRECT_METHOD_GET === $this->getRedirectMethod()) {
            header('Location: ' . $this->getRedirectUrl());
            $content = $this->getGetRedirectContent();
        } else {
            $content = $this->getPostRedirectContent();
        }

        echo $content;

        exit;
    }

    /**
     * 获取跳转需要的数据
     * @return array 返回跳转需要的数据
     */
    public function getRedirectData()
    {
        return $this->request->getData();
    }

    /**
     * 获取跳转方法
     * @return string 返回跳转方式
     */
    public function getRedirectMethod()
    {
        return 'GET';
    }

    /**
     * 获取 get 跳转 html
     * @return string 返回跳转的 html
     */
    protected function getGetRedirectContent()
    {
        $content = '<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="refresh" content="1;url=%1$s" />
        <title>%2$s</title>
    </head>
    <body>
        Redirecting to <a href="%1$s">%1$s</a>.
    </body>
</html>';

        return sprintf($content,
            htmlspecialchars($this->getRedirectUrl(), ENT_QUOTES, 'UTF-8'),
            htmlentities($this->getRedirectTitle(), ENT_QUOTES, 'UTF-8')
        );
    }

    /**
     * 获取 post 跳转 html
     * @return string 返回跳转的 html
     */
    protected function getPostRedirectContent()
    {
        $content = '<!DOCTYPE html>
<html>
    <head>
        <title>%2$s</title>
    </head>
    <body onload="document.forms[0].submit();">
        <form action="%1$s" method="post">
            <p>Redirecting to payment page...</p>
            <p>
                %3$s
                <input type="submit" />
            </p>
        </form>
    </body>
</html>';

        $hiddenFields = '';
        foreach ($this->getRedirectData() as $key => $value) {
            $key = htmlentities($key, ENT_QUOTES, 'UTF-8', false);
            $value = htmlentities($value, ENT_QUOTES, 'UTF-8', false);

            $hiddenFields .= "<input type=\"hidden\" name=\"{$key}\" value=\"{$value}\" />";
        }

        return sprintf(
            $content,
            htmlspecialchars($this->getRedirectUrl(), ENT_QUOTES, 'UTF-8'),
            htmlentities($this->getRedirectTitle(), ENT_QUOTES, 'UTF-8'),
            $hiddenFields
        );
    }
}
