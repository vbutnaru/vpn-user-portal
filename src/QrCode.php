<?php

declare(strict_types=1);

/*
 * eduVPN - End-user friendly VPN.
 *
 * Copyright: 2016-2021, The Commons Conservancy eduVPN Programme
 * SPDX-License-Identifier: AGPL-3.0+
 */

namespace LC\Portal;

use LC\Portal\Exception\QrCodeException;

class QrCode
{
    private const QR_ENCODE_PATH = '/usr/bin/qrencode';

    public static function generate(string $qrText): string
    {
        ob_start();
        passthru(
            sprintf(
                '%s -m 0 -s 5 -t PNG -o - -- %s',
                self::QR_ENCODE_PATH,
                escapeshellarg($qrText)
            ),
            $resultCode
        );

        if (0 !== $resultCode) {
            ob_end_clean();

            throw new QrCodeException('unable to generate QR code');
        }

        return ob_get_clean();
    }
}