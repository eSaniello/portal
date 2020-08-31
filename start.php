<?php

use Mpdf\Mpdf;

require "config.php";
require_once __DIR__ . '/vendor/autoload.php';

use Models\Database;
//Initialize Illuminate Database Connection
new Database();
