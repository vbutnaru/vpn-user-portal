<?php

declare(strict_types=1);

/*
 * eduVPN - End-user friendly VPN.
 *
 * Copyright: 2016-2021, The Commons Conservancy eduVPN Programme
 * SPDX-License-Identifier: AGPL-3.0+
 */

require_once dirname(__DIR__).'/vendor/autoload.php';
$baseDir = dirname(__DIR__);

use LC\Portal\Config;
use LC\Portal\Federation\ForeignKeyListFetcher;
use LC\Portal\HttpClient\CurlHttpClient;

try {
    $config = Config::fromFile($baseDir.'/config/config.php');
    if ($config->apiConfig()->remoteAccess()) {
        $foreignKeyListFetcher = new ForeignKeyListFetcher($baseDir.'/data');
        $foreignKeyListFetcher->update(
            new CurlHttpClient(),
            'https://disco.eduvpn.org/v2/server_list.json',
            [
                'RWRtBSX1alxyGX+Xn3LuZnWUT0w//B6EmTJvgaAxBMYzlQeI+jdrO6KF', // fkooman@deic.dk, kolla@uninett.no
                'RWQKqtqvd0R7rUDp0rWzbtYPA3towPWcLDCl7eY9pBMMI/ohCmrS0WiM', // RoSp
            ]
        );
    }
} catch (Exception $e) {
    echo 'ERROR: '.$e->getMessage().\PHP_EOL;
    exit(1);
}