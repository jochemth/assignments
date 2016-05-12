<?php
require 'recipe/symfony.php';

localServer('localhost')
    ->user('deploy')
    ->env('deploy_path', '/var/www/beers')
    ->env('branch', 'develop')
    ->env('env_vars', 'SYMFONY_ENV=dev')
    ->env('env', 'dev')
    ->stage('local');

server('vm', '192.168.0.144')
    ->user('web')
    ->identityFile()
    ->forwardAgent()
    ->env('deploy_path', '/home/sites/test')
    ->env('branch', 'develop')
    ->env('env_vars', 'SYMFONY_ENV=dev')
    ->env('env', 'dev')
    ->stage('vm');

set('repository', 'git@github.com:jochemth/assignments.git');
task('deploy:writable', function () {

});
