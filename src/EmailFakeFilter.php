<?php

namespace EmailFakeFilter;

class EmailFakeFilter
{
    public static string $dataPath = __DIR__.'/data/';

    public static function isFakeDomain(string $domain): bool
    {
        return static::getDomainInfo($domain) !== null;
    }

    public static function isFakeEmail(string $email): bool
    {
        $domain = static::extractDomain($email);

        return static::isFakeDomain($domain);
    }

    /**
     * @return array{providers:array<int,string>,hosts:array<string,array{firstseen:int,lastseen:int}>}|null
     */
    public static function getDomainInfo(string $domain): ?array
    {
        $domainParts = explode('.', strtolower($domain));

        do {
            $checkinDomain = implode('.', $domainParts);
            array_shift($domainParts);

            $hash = static::calculateHash($checkinDomain);
            $filePath = static::$dataPath.$hash.'.json';

            if (! file_exists($filePath)) {
                continue;
            }

            $data = \Safe\json_decode(\Safe\file_get_contents($filePath), true);

            if (is_array($data) && array_key_exists($checkinDomain, $data)) {
                return $data[$checkinDomain];
            }
        } while (count($domainParts) >= 2);

        return null;
    }

    protected static function calculateHash(string $domain): string
    {
        return substr(md5($domain), 0, 2);
    }

    final public static function extractDomain(string $email): string
    {
        $pos = strrpos($email, '@');

        if ($pos === false) {
            return $email;
        }

        return substr($email, $pos + 1);
    }
}
