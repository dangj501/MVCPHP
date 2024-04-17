<?php

return function (array $settings): array {
    $settings['db']['host'] = 'localhost';
    $settings['db']['database'] = 'biblioteca';
    $settings['db']['username'] = 'biblio_user';
    $settings['db']['password'] = 'b1bli@';

    $settings['env'] = 'dev';

    return  $settings;
};