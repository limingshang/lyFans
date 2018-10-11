<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/12 0012
 * Time: 上午 12:02
 */

/**
 * 输出调试信息
 * @author KK
 * @param mixed $data 要输出的调试数据
 * @param int $mode 调试模式
 * 解释：11=输出调试数据并停止运行，111=附加运行回溯输出并停止运行
 * 110=附加运行回溯输出但不停止运行
 *
 * @example
 *
 * ```php
 * debug(123, 110);
 * debug([1,2,3], 111);
 * debug([1, 2, 3, 'a' => 'b'], 11);
 * ```
 */
function debug($data, $mode = 0){
    static $debugCount = 0;
    $debugCount++;

    $isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest' || isset($_GET['_isAjax']) || isset($_POST['_isAjax']);

    $exception = new \Exception();
    $lastTrace = $exception->getTrace()[0];
    $file = $lastTrace['file'];
    $line = $lastTrace['line'];

    $fileCodes = is_file($file) ? file($file) : '读取失败';
    $code = '(无法获取脚本内容)';
    if($fileCodes != ''){
        $matchedCodes = [];
        $lineScript = $fileCodes[$line - 1];
        if(preg_match('/debug.*\(.*\)(?= *;)/i', $lineScript, $matchedCodes)){
            $code = $matchedCodes[0];
        }
    }

    $showData = var_export($data, true);

    if($isAjax){
        header('Content-type:application/json;charset=utf-8');
        exit(json_encode(array(
            'file' => $file,
            'line' => $line,
            'dataStr' => $showData,
            'data' => $data,
        )));
    }else{
        $dataType = gettype($data);
        $backLink = '';
        if(isset($_SERVER['HTTP_REFERER'])){
            $backLink = '<a href="' . $_SERVER['HTTP_REFERER'] . '">返回(清空表单)</a>'
                . '<a href="javascript:history.back()">返回(保留表单状态)</a>';
        }else{
            $backLink = '<a href="javascript:history.back()">返回</a>';
        }

        $length = 'no';
        if(is_string($data)){
            $length = strlen($data);
        }

        if(PHP_SAPI !== 'cli'){
            $traceHtml = '';
            if($mode == 111 || $mode == 110){
                $traceHtml = '<div><p>运行轨迹:</p><pre>' . $exception->getTraceAsString() . '</pre></div>';
            }
            echo <<<EOL
<style>
._wrapDebug{min-width:590px; margin:20px; padding:10px; font-size:14px; border:1px solid #000;}
._wrapDebug span{color:#121E31; font-size:14px;}
._wrapDebug font:first{color:green; font-size:14px;}
._wrapDebug font:last{color:red; font-size:14px;}
._wrapDebug pre{font-size:14px;}
._wrapDebug p{background:#92E287;}
._wrapDebug a{margin-left:20px;}
</style>
<div class="_wrapDebug">================= 新的调试点： 
    <span>$debugCount</span> ========================<br />
    <font>$file</font> 第 $line 行<br />
    <font>$code</font><br />
    调试输出内容:<br />
    类型：$dataType<br />
    字符串长度：$length<br />
    值:<br />
    <pre><p>$showData</p></pre>
    $backLink
    <a href="javascript:location.reload()">重新请求本页</a>
    $traceHtml
</div>
EOL;
        }else{
            $traceContent = '';
            if($mode == 111 || $mode == 110){
                $traceContent = $exception->getTraceAsString();
            }
            $debugContent = <<<EOL
============ 新的调试点：$debugCount ============<br />
$file:$line
$code
data type: $dataType
string length: $length
value:
$showData

$traceContent
EOL;
            echo $debugContent;
        }
    }

    ($mode == 11 || $mode == 111) && exit;
}