<?php

declare(strict_types=1);

namespace Tests\PHPat\unit\rules\ShouldNotExtend;

use PHPat\Rule\Assertion\ShouldNotExtend\ParentClassRule;
use PHPat\Rule\Assertion\ShouldNotExtend\ShouldNotExtend;
use PHPat\Selector\Classname;
use PHPat\Statement\Builder\StatementBuilderFactory;
use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use PHPStan\Type\FileTypeMapper;
use Tests\PHPat\fixtures\FixtureClass;
use Tests\PHPat\fixtures\Simple\SimpleAbstractClass;
use Tests\PHPat\unit\FakeTestParser;

/**
 * @extends RuleTestCase<ParentClassRule>
 */
class ParentClassTest extends RuleTestCase
{
    public function testRule(): void
    {
        $this->analyse(['tests/fixtures/FixtureClass.php'], [
            [sprintf('%s should not extend %s', FixtureClass::class, SimpleAbstractClass::class), 28],
        ]);
    }

    protected function getRule(): Rule
    {
        $testParser = FakeTestParser::create(
            ShouldNotExtend::class,
            [new Classname(FixtureClass::class)],
            [new Classname(SimpleAbstractClass::class)]
        );

        return new ParentClassRule(
            new StatementBuilderFactory($testParser),
            $this->createReflectionProvider(),
            self::getContainer()->getByType(FileTypeMapper::class)
        );
    }
}