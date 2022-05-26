<?php
/**
 * @noinspection MissingOrEmptyGroupStatementInspection
 */

const REALM = 'Restricted area';
//user => password
$users = array(
    'admin' => 'my_pass',
);

// function to parse the http auth header
function http_digest_parse($txt)
{
    // protect against missing data
    $needed_parts = array('nonce'=>1, 'nc'=>1, 'cnonce'=>1, 'qop'=>1, 'username'=>1, 'uri'=>1, 'response'=>1);
    $data = array();
    $keys = implode('|', array_keys($needed_parts));

    preg_match_all('@(' . $keys . ')=(?:([\'"])([^\2]+?)\2|([^\s,]+))@', $txt, $matches, PREG_SET_ORDER);

    foreach ($matches as $m) {
        $data[$m[1]] = $m[3] ?: $m[4];
        unset($needed_parts[$m[1]]);
    }

    return $needed_parts ? false : $data;
}

if (empty($_SERVER['PHP_AUTH_DIGEST'])) {
    header('HTTP/1.1 401 Unauthorized');

    $header2 = 'WWW-Authenticate: Digest realm="%s",qop="auth",nonce="%s",opaque="%s"';
    $header2 = sprintf($header2, REALM, uniqid('', true), md5(REALM));
    header($header2);

    die('Auth Required');
}

// analyze the PHP_AUTH_DIGEST variable
$data = http_digest_parse($_SERVER['PHP_AUTH_DIGEST']);
if (!$data)                            die('Wrong Credentials!');
if (!isset($users[$data['username']])) die('Wrong Credentials!');

// generate the valid response
$A1 = md5($data['username'] . ':' . REALM . ':' . $users[$data['username']]);
$A2 = md5($_SERVER['REQUEST_METHOD'].':'.$data['uri']);
$valid_response = md5($A1.':'.$data['nonce'].':'.$data['nc'].':'.$data['cnonce'].':'.$data['qop'].':'.$A2);

if ($data['response'] !== $valid_response) die('Wrong Credentials!');

// ok, valid username & password
?>
