<?php
     const SERVER = 'mysql304.phy.lolipop.lan';
     const DBNAME = 'LAA1517469-sistem';
     const USER ='LAA1517469';
     const PASS ='Pass1234';
     
    $connect = 'mysql:host='. SERVER . ';dbname='. DBNAME . ';charset=utf8';
    $pdo=new PDO('mysql:host=mysql304.phy.lolipop.lan;dbname=LAA1517469-sistem;charset=utf8','LAA1517469','Pass1234');

?>
<?php
    $count = 0;
    $strMsg   = '';

    $request = '';
    if (isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
        $request = strtolower($_SERVER['HTTP_X_REQUESTED_WITH']);
    }
    if ($request !== 'xmlhttprequest') {
        exit;
    }
 
    $message = '';
    if (isset($_POST['message']) && is_string($_POST['message'])) {
        $message = htmlspecialchars($_POST['message'], ENT_QUOTES);
    }
    if ($message == '') {
        exit;
    }


    $fp = fopen('message.log', 'r');
    if (flock($fp, LOCK_SH)) {
        while (!feof($fp)) {
            if ($count > 200) {
                break;
            }
            $strMsg = $strMsg . fgets($fp);
            $count = $count + 1;
        }
    }
    flock($fp, LOCK_UN);
    fclose($fp);

    $strMsg = date("Y-m-d H:i:s") . ' - ' . $message . "\n" . $strMsg;
    file_put_contents('message.log', $strMsg, LOCK_EX);
?>