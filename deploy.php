<?php
require 'recipe/symfony.php';

localServer('localhost')
    ->user('deploy')
    ->env('deploy_path', '/var/www')
    ->env('branch', 'develop')
    ->stage('local');

set('repository', 'git@github.com:jochemth/assignments.git');
