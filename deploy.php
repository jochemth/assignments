<?php
require 'recipe/symfony.php';

localServer('localhost')
    ->user('deploy')
    ->env('deploy_path', '/var/www')
    ->env('branch', 'develop')
    ->env('env_vars', 'SYMFONY_ENV=dev')
    ->env('env', 'dev')
    ->stage('local');

set('repository', 'git@github.com:jochemth/assignments.git');
