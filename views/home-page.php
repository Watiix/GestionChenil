<?php

echo 'Hello ' . ($_SESSION['user']['firstname'] ?? '');

var_dump($_SESSION['user'] ?? '');
