<?php

namespace EmailFakeFilter\Tests;

use EmailFakeFilter\EmailFakeFilter;
use PHPUnit\Framework\TestCase;

class EmailFakeFilterTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        EmailFakeFilter::$dataPath = __DIR__.'/fixtures/';
    }

    /**
     * @dataProvider extractDomainProvider
     */
    public function testExtractDomain(string $email, string $domain): void
    {
        self::assertSame($domain, EmailFakeFilter::extractDomain($email));
    }

    public function testIsFakeDomain(): void
    {
        self::assertFalse(EmailFakeFilter::isFakeDomain('leo108.com'));
        self::assertTrue(EmailFakeFilter::isFakeDomain('cambridge.ga'));
        self::assertTrue(EmailFakeFilter::isFakeDomain('randomail.io'));
        self::assertTrue(EmailFakeFilter::isFakeDomain('subdomain.randomail.io'));
    }

    public function testIsFakeEmail(): void
    {
        self::assertFalse(EmailFakeFilter::isFakeEmail('root@leo108.com'));
        self::assertTrue(EmailFakeFilter::isFakeEmail('user@cambridge.ga'));
        self::assertTrue(EmailFakeFilter::isFakeEmail('user@randomail.io'));
        self::assertTrue(EmailFakeFilter::isFakeEmail('user@subdomain.randomail.io'));
    }

    /**
     * @return array<int,array<string>>
     */
    public static function extractDomainProvider(): array
    {
        return [
            ['root@leo108.com', 'leo108.com'],
            ['root@root@leo108.com', 'leo108.com'],
            ['leo108.com', 'leo108.com'],
        ];
    }
}
