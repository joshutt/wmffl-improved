<?php
namespace App\Tests;

use App\LegacyBridge;
use PHPUnit\Framework\TestCase;

class LegacyBridgeTest extends TestCase
{

    public function testCheckPath() {
        $returnPath = LegacyBridge::checkPath('/rules/ballot');
        $this->assertEquals('/rules/ballot.php', $returnPath);
    }
}