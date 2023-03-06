<?php

include('../src/Session.php');
include('../src/App.php');
include('../src/Site.php');

$app = new App();

$site['title'] = 'Universidad Nestlé | 404';


include('../src/layout/header.php');

    include("../src/pages/error.php");

include('../src/layout/footer.php');