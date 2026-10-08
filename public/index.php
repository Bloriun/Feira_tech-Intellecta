<?php

declare(strict_types=1);

require_once __DIR__ . '/../src/data/mockData.php';
require_once __DIR__ . '/../src/utils/helpers.php';
require_once __DIR__ . '/../src/layout/site.php';

$page = $_GET['page'] ?? 'login';
$data = require __DIR__ . '/../src/data/mockData.php';

render_site($page, $data['people'], $data['feed'], $data['notifications'], $data['messages']);
