<?php
$properties = array(
    array(
        'name' => 'inTpl',
        'desc' => 'profiler.intpl_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'profiler:properties',
    ),
    array(
        'name' => 'outTpl',
        'desc' => 'profiler.outtpl_desc',
        'type' => 'textfield',
        'options' => '',
        'value' => '',
        'lexicon' => 'profiler:properties',
    ),
    array(
        'name' => 'ignoreContext',
        'desc' => 'profiler.ignorecontext_desc',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => '0',
        'lexicon' => 'profiler:properties',
    ),
    array(
        'name' => 'debug',
        'desc' => 'profiler.debug_desc',
        'type' => 'combo-boolean',
        'options' => '',
        'value' => '0',
        'lexicon' => 'profiler:properties',
    ),
);

return $properties;