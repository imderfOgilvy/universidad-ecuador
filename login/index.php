<?php

include('../src/Session.php');
include('../src/App.php');
include('../src/Site.php');

$app = new App();

$site['title'] = 'Universidad Nestlé | Login';

$login = $app->login();

include('../src/layout/header.php');

    include("../src/pages/login.php");

include('../src/layout/footer.php');