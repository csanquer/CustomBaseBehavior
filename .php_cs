<?php 

$finder = Symfony\CS\Finder\DefaultFinder::create()
    ->exclude(array(
        'vendor',
    ))
    ->in(__DIR__)
;

return Symfony\CS\Config\Config::create()
    ->fixers(array(
        'indentation',
        'linefeed',
        'trailing_spaces',
        'php_closing_tag',
        'short_tag',
        'return',
        'visibility',
        'braces',
        'phpdoc_params',
        'eof_ending',
        'extra_empty_lines',
        'include',
        'controls_spaces',
        'elseif',
    ))
    ->finder($finder)
;
