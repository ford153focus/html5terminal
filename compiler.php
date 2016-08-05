<?php
/**
 * Assembly ./src content to one file
 */
$oneFile = file_get_contents('src/index.php');

/**
 * includes
 */
echo('Replacing includes'."\n");

preg_match_all("/(require|require_once|include|include_once)\('([A-Za-z0-9\.]+)'\);/", $oneFile, $matches);

for ($i=0; $i<count($matches[0]); $i++)
{
	$oneFile = str_replace($matches[0][$i], ' ?> '.file_get_contents('src/'.$matches[2][$i]).' <?php ', $oneFile);
}

/**
 * styles
 */
echo('Replacing styles'."\n");

preg_match_all('/<link rel="stylesheet" type="text\/css" href="([A-Za-z0-9:\/\.\-]+)">/', $oneFile, $matches);

for ($i=0; $i<count($matches[0]); $i++)
{
	$css = strpos($matches[1][$i], 'http://') !== false ? file_get_contents($matches[1][$i]) : file_get_contents('src/'.$matches[1][$i]);
	$oneFile = str_replace($matches[0][$i], "<style>$css</style>", $oneFile);
}

/**
 * fonts
 */
echo('Replacing fonts'."\n");

preg_match_all('/src:\surl\("([A-Za-z0-9:\/\.\-]+)"\);/', $oneFile, $matches);

for ($i=0; $i<count($matches[0]); $i++)
{
	$font = strpos($matches[1][$i], 'http://') !== false ? file_get_contents($matches[1][$i]) : file_get_contents('src/'.$matches[1][$i]);
	$font = base64_encode($font);
	$oneFile = str_replace($matches[0][$i], "src: url(data:font/ttf;base64,$font)", $oneFile);
}

/**
 * scripts
 */
echo('Replacing scripts'."\n");

preg_match_all('/<script src="([A-Za-z0-9:\/\.\-]+)"><\/script>/', $oneFile, $matches);

for ($i=0; $i<count($matches[0]); $i++)
{
	$script = strpos($matches[1][$i], 'http://') !== false ? file_get_contents($matches[1][$i]) : file_get_contents('src/'.$matches[1][$i]);
	$oneFile = str_replace($matches[0][$i], "<script>$script</script>", $oneFile);
}

var_dump($oneFile);

file_put_contents('term.php', $oneFile);