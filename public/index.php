<?php

declare(strict_types=1);

$app = require __DIR__ . '/../src/bootstrap.php';
$page = $_GET['page'] ?? $app['routes']['default'];
$data = $app['data'];

render_site($page, $data['people'], $data['feed'], $data['notifications'], $data['messages']);
