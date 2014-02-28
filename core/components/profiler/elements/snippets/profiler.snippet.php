<?php
/**
 * Profiler
 *
 * DESCRIPTION
 *
 * With this snippet you will have access to the logged user's profile fields
 *
 * PROPERTIES:
 *
 * &inTpl string optional
 * &outTpl string optional
 * &ignoreContext integer optional. Default: 0
 * &debug integer optional. Default: 0
 *
 * USAGE:
 *
 * [[!Profiler? &inTpl='ShowUsersGravatar' &ignoreContext=`0`]]
 *
 */

$inTpl = $modx->getOption('inTpl', $scriptProperties, '');
$outTpl = $modx->getOption('outTpl', $scriptProperties, '');
$ignoreContext = $modx->getOption('ignoreContext', $scriptProperties, 1);
$debug = $modx->getOption('debug', $scriptProperties, 0);


if (!isset($modx->user) || ($modx->user->id <= 0) || ($ignoreContext == 0 && !$modx->user->hasSessionContext($modx->context->key))) {
    if ($outTpl == '') return;
    return $modx->getChunk($outTpl);
}

$phs = $modx->user->toArray();
$phs = array_merge($modx->user->Profile->toArray(), $phs);

unset($phs['password'], $phs['hash_class'], $phs['salt'], $phs['sessionid']);

if ($debug == 1 || $inTpl == '') {
    echo '<pre>';
    var_dump($phs);
    echo '</pre>';
    return;
}

return $modx->getChunk($inTpl, $phs);