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
 * &userGroups string optional. Comma separated list of user groups that should be checked. Default:
 * &matchAll integer optional. If should user belong to all specified user groups. Default: 0
 *
 * USAGE:
 *
 * [[!Profiler? &inTpl='ShowUsersGravatar' &ignoreContext=`0`]]
 *
 */

$inTpl = $modx->getOption('inTpl', $scriptProperties, '');
$outTpl = $modx->getOption('outTpl', $scriptProperties, '');
$notInGroupsTpl = $modx->getOption('notInGroupsTpl', $scriptProperties, '');
$ignoreContext = $modx->getOption('ignoreContext', $scriptProperties, 1);
$debug = $modx->getOption('debug', $scriptProperties, 0);
$userGroups = $modx->getOption('userGroups', $scriptProperties, '');
$matchAll = (int) $modx->getOption('matchAll', $scriptProperties, 0);

$userGroups = explode(',', $userGroups);
$userGroups = array_map('trim', $userGroups);
$userGroups = array_keys(array_flip($userGroups));
$userGroups = array_filter($userGroups);


if (!isset($modx->user) || ($modx->user->id <= 0) || ($ignoreContext == 0 && !$modx->user->hasSessionContext($modx->context->key)) || (count($userGroups) > 0 && $modx->user->isMember($userGroups, $matchAll))) {
    if ($outTpl == '') return;
    return $modx->getChunk($outTpl);
}

$phs = $modx->user->toArray();
$phs = array_merge($modx->user->Profile->toArray(), $phs);

unset($phs['password'], $phs['hash_class'], $phs['salt'], $phs['sessionid']);

if (count($userGroups) > 0 && !$modx->user->isMember($userGroups, $matchAll)) {
    if ($notInGroupsTpl != '') {
        return $modx->getChunk($notInGroupsTpl, $phs);
    } else {
        if ($outTpl == '') return;
        return $modx->getChunk($outTpl);
    }
}

if ($debug == 1 || $inTpl == '') {
    echo '<pre>';
    var_dump($phs);
    echo '</pre>';
    return;
}

return $modx->getChunk($inTpl, $phs);