<?php

return [

    'ApplicationID' => '100001067',
    'ApplicationName' => 'Babel-ai',
    'Icon' => 'fal fa-flask',
    'Sort' => '15',
    'FrontEndPath' => '',
    'BackEndPath' => '/babel/',
    'LoginPath' => 'home',
    'SettingsPath' => '{"cron":"cd \/var\/www\/html\/babel && php artisan schedule:run"}',
    'SearchPath' => '',
    'FeedPath' => '',
    'DatabaseName' => 'babel',
    'Roles' => '1,Administrator,2,Tester,3,User',
    'IsPlugin' => 'FALSE',
    'Backup' => '',
];
