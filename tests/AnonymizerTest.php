<?php

namespace Scody\TextAnonymizer\Tests;

use PHPUnit\Framework\TestCase;
use Scody\TextAnonymizer\Anonymizer;

class AnonymizerTest extends TestCase
{
    private Anonymizer $anonymizer;

    protected function setUp(): void
    {
        $this->anonymizer = new Anonymizer();
    }

    public function testMaskEmail(): void
    {
        $this->assertEquals(
            's*********r@example.com',
            $this->anonymizer->maskEmail('secret_user@example.com')
        );
        
        $this->assertEquals(
            'ab@test.org',
            $this->anonymizer->maskEmail('ab@test.org')
        );
    }

    public function testMaskPhone(): void
    {
        $this->assertEquals(
            '*******4567',
            $this->anonymizer->maskPhone('+1 (555) 123-4567')
        );
        
        $this->assertEquals(
            '******7890',
            $this->anonymizer->maskPhone('1234567890')
        );
    }

    public function testMaskCard(): void
    {
        $this->assertEquals(
            '************5678',
            $this->anonymizer->maskCard('4111111111115678')
        );
        
        $this->assertEquals(
            '******1234',
            $this->anonymizer->maskCard('1234561234')
        );
    }

    public function testMaskAll(): void
    {
        $text = 'Contact: secret_user@example.com, phone: +1 (555) 123-4567, card: 4111111111115678';
        
        $result = $this->anonymizer->maskAll($text);
        
        $this->assertStringContainsString('s*********r@example.com', $result);
        $this->assertStringContainsString('*******4567', $result);
        $this->assertStringContainsString('*********1115678', $result);
    }
}