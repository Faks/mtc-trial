<?php
// Application middleware

#CRF Bug Fix
use src\Pagination;
	
$app->add($container->get('csrf'));
	
$app->add(new Pagination());
