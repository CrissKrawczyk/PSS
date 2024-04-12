<?php
require_once dirname(__FILE__).'/../../config.php';
use Smarty\Smarty;

session_start();
session_destroy();

header("Location: ".$conf->app_url);