#!/usr/bin/env php
<?php

// dependent libraries for test environment

define('VENDOR_PATH', __DIR__ . '/../vendor');

if (!is_dir(VENDOR_PATH)) {
    mkdir(VENDOR_PATH, 0775, true);
}

$deps = array(
    array('doctrine-orm', 'http://github.com/doctrine/doctrine2.git'),
    array('doctrine-dbal', 'http://github.com/doctrine/dbal.git'),
    array('doctrine-common', 'http://github.com/doctrine/common.git'),
    array('doctrine-data-fixtures', 'http://github.com/doctrine/data-fixtures.git'),

    array('Symfony/Component/ClassLoader', 'http://github.com/symfony/ClassLoader.git', 'v2.0.9'),
    array('Symfony/Component/Yaml', 'http://github.com/symfony/Yaml.git', 'v2.0.9'),
    
    array('Mockery', 'https://github.com/padraic/mockery'),
);

foreach ($deps as $dep) {
    list($name, $url, $rev) = $dep;

    echo "> Installing/Updating $name\n";

    $installDir = VENDOR_PATH.'/'.$name;
    if (!is_dir($installDir)) {
        system(sprintf('git clone %s %s', $url, $installDir));
    }

    system(sprintf('cd %s && git fetch origin && git reset --hard %s', $installDir, $rev));
}