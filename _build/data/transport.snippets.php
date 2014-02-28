<?php
function getSnippetContent($filename) {
    $o = file_get_contents($filename);
    $o = str_replace('<?php','',$o);
    $o = str_replace('?>','',$o);
    $o = trim($o);
    return $o;
}
$snippets = array();

$snippets[0]= $modx->newObject('modSnippet');
$snippets[0]->fromArray(array(
    'id' => 0,
    'name' => 'Profiler',
    'description' => 'Snippet that allows you to use profile fields from currently logged in user.',
    'snippet' => getSnippetContent($sources['snippets'].'/profiler.snippet.php'),
),'',true,true);

$properties = include $sources['data'].'properties.profiler.php';
$snippets[0]->setProperties($properties);

unset($properties);


return $snippets;