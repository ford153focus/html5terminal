<?php
/**
 * Assembly ./src content to one file
 */
$oneFile = file_get_contents('src/index.php');

/**
 * includes
 */
echo('Replacing includes'."\n");

/** @TODO: proper path for require_once and include_once */
preg_match_all("/(require|require_once|include|include_once)\('([A-Za-z0-9.]+)'\);/", $oneFile, $matches);
for ($i=0, $iMax = count($matches[0]); $i < $iMax; $i++)
{
	$oneFile = str_replace(
	    $matches[0][$i],
        ' ?> '.file_get_contents('src/'.$matches[2][$i]).' <?php ',
        $oneFile
    );
}

/**
 * styles
 */
echo('Replacing styles'."\n");

preg_match_all('/<link rel="stylesheet" type="text\/css" href="([A-Za-z0-9:\/.\-]+)">/', $oneFile, $matches);

for ($i=0, $iMax = count($matches[0]); $i < $iMax; $i++)
{
	if (strpos($matches[1][$i], 'http://') || strpos($matches[1][$i], 'https://')) {
        $css = file_get_contents($matches[1][$i]);
    } else {
        $css = file_get_contents('src/'.$matches[1][$i]);
    }

	$oneFile = str_replace($matches[0][$i], "<style>$css</style>", $oneFile);
}

/**
 * fonts
 */
echo('Replacing fonts'."\n");

preg_match_all('/src:\surl\("([A-Za-z0-9:\/.\-]+)"\);/', $oneFile, $matches);

for ($i=0, $iMax = count($matches[0]); $i < $iMax; $i++)
{
    if (strpos($matches[1][$i], 'http://') || strpos($matches[1][$i], 'https://')) {
        $font = file_get_contents($matches[1][$i]);
    } else {
        $font = file_get_contents('src/'.$matches[1][$i]);
    }

	$font = base64_encode($font);
    $font = "src: url(data:font/ttf;base64,$font)";

	$oneFile = str_replace($matches[0][$i], $font, $oneFile);
}

/**
 * scripts
 */
echo('Replacing scripts'."\n");

preg_match_all('/<script src="([A-Za-z0-9:\/.\-]+)"><\/script>/', $oneFile, $matches);

for ($i=0, $iMax = count($matches[0]); $i < $iMax; $i++)
{
    if (strpos($matches[1][$i], 'http://') || strpos($matches[1][$i], 'https://')) {
        $script = file_get_contents($matches[1][$i]);
    } else {
        $script = file_get_contents('src/'.$matches[1][$i]);
    }

	$oneFile = str_replace($matches[0][$i], "<script>$script</script>", $oneFile);
}

print_r($oneFile);

file_put_contents('term.php', $oneFile);
