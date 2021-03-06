<?php
namespace Respect\Validation\Rules;

/**
 * @covers Respect\Validation\Rules\Bic
 */
class BicTest extends \PHPUnit_Framework_TestCase
{
    public function testShouldUseDefinedFactoryToCreateInternalRuleBasedOnGivenCountryCode()
    {
        $countryCode    = 'XX';

        $validatable    = $this->getMock('Respect\Validation\Validatable');
        $factory        = $this->getMock('Respect\Validation\Rules\Locale\Factory');
        $factory
            ->expects($this->once())
            ->method('bic')
            ->with($countryCode)
            ->will($this->returnValue($validatable));

        $rule           = new Bic($countryCode, $factory);

        $this->assertSame($validatable, $rule->getValidatable());
    }

    public function testShouldUseDefaultFactoryToCreateInternalRuleBasedOnGivenCountryCodeWhenFactoryIsNotDefined()
    {
        $countryCode    = 'DE';
        $rule           = new Bic($countryCode);

        $this->assertInstanceOf('Respect\Validation\Rules\Locale\GermanBic', $rule->getValidatable());
    }
}
