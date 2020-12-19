<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
use Dotenv\Dotenv;
use Dotenv\Repository\Adapter;
use Dotenv\Repository\RepositoryBuilder;

! defined('BASE_PATH') && define('BASE_PATH', __DIR__ . '/../');

require_once BASE_PATH . '/vendor/autoload.php';

$repository = RepositoryBuilder::createWithNoAdapters()
    ->addAdapter(Adapter\PutenvAdapter::class)
    ->immutable()
    ->make();

Dotenv::create($repository, [BASE_PATH])->load();
