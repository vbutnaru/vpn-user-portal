<?php

declare(strict_types=1);

/*
 * eduVPN - End-user friendly VPN.
 *
 * Copyright: 2016-2021, The Commons Conservancy eduVPN Programme
 * SPDX-License-Identifier: AGPL-3.0+
 */

namespace LC\Portal;

class ServerConfig
{
    private OpenVpnServerConfig $openVpnServerConfig;
    private WgServerConfig $wgServerConfig;

    public function __construct(OpenVpnServerConfig $openVpnServerConfig, WgServerConfig $wgServerConfig)
    {
        $this->wgServerConfig = $wgServerConfig;
        $this->openVpnServerConfig = $openVpnServerConfig;
    }

    /**
     * @param array<ProfileConfig> $profileConfigList
     *
     * @return array<string,string>
     */
    public function get(array $profileConfigList): array
    {
        // XXX fix ServerConfigCheck for WG as well!
//        ServerConfigCheck::verify($profileConfigList);
        $serverConfig = [];
        foreach ($profileConfigList as $profileConfig) {
            if ('openvpn' === $profileConfig->vpnType()) {
                $serverConfig = array_merge($serverConfig, $this->openVpnServerConfig->getProfile($profileConfig));
            }
        }

        $serverConfig = array_merge($serverConfig, $this->wgServerConfig->get($profileConfigList));

        return $serverConfig;
    }
}