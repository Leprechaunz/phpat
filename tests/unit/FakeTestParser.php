<?php declare(strict_types=1);

namespace Tests\PHPat\unit;

use PHPat\Rule\Assertion\Assertion;
use PHPat\Selector\SelectorInterface;
use PHPat\Test\RelationRule;
use PHPat\Test\TestParser;

class FakeTestParser extends TestParser
{
    public string $ruleName;

    /** @var class-string<Assertion> */
    public string $assertion;

    /** @var array<SelectorInterface> */
    public array $subjects;

    /** @var array<SelectorInterface> */
    public array $targets;

    /** @var array<string> */
    public array $tips = [];

    /** @var array<string, mixed> */
    public array $params = [];

    public function __invoke(): array
    {
        $rule = new RelationRule();
        $rule->ruleName = $this->ruleName;
        $rule->assertion = $this->assertion;
        $rule->subjects = $this->subjects;
        $rule->targets = $this->targets;
        $rule->tips = $this->tips;
        $rule->params = $this->params;

        return [$rule];
    }

    /**
     * @param class-string<Assertion>  $assertion
     * @param array<SelectorInterface> $subjects
     * @param array<SelectorInterface> $targets
     * @param array<string>            $tips
     * @param array<string, mixed>     $params
     */
    public static function create(string $ruleName, string $assertion, array $subjects, array $targets, array $tips = [], array $params = []): self
    {
        /** @var self $self */
        $self = (new \ReflectionClass(self::class))->newInstanceWithoutConstructor();
        $self->ruleName = $ruleName;
        $self->assertion = $assertion;
        $self->subjects = $subjects;
        $self->targets = $targets;
        $self->tips = $tips;
        $self->params = $params;

        return $self;
    }
}
