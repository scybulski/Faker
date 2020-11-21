<?php

namespace Faker\Provider\pl_PL;

use Faker\Generator;
use Faker\Test\TestCase;

final class LicensePlateTest extends TestCase
{
    /**
     * @var Generator
     */
    private $faker;

    protected function setUp(): void
    {
        $faker = new Generator();
        $faker->addProvider(new LicensePlate($faker));
        $this->faker = $faker;
    }

    /**
     * Test the validity of license plate
     */
    public function testRandomLicensePlate()
    {
        for ($i = 0; $i < 40; $i++) {
            $licensePlate = $this->faker->licensePlate;
            $this->assertNotEmpty($licensePlate);
            $this->assertIsString($licensePlate);
            $this->assertMatchesRegularExpression('/^(?:[A-P,R-Z]{2} [A-P,R-Z\d]{5}|[A-P,R-Z]{3} [A-P,R-Z\d]{4,5})$/', $licensePlate);
        }
    }

    /**
     * Test that license plate belongs to podkapracikie voivodeship
     */
    public function testPodkarpackieLicensePlate()
    {
        for ($i = 0; $i < 5; $i++) {
            $licensePlate = $this->faker->licensePlate(array('podkarpackie'));
            $this->assertNotEmpty($licensePlate);
            $this->assertIsString($licensePlate);
            $this->assertMatchesRegularExpression('/^(?:R[A-P,R-Z] [A-P,R-Z\d]{5}|R[A-P,R-Z]{2} [A-P,R-Z\d]{4,5})$/', $licensePlate);
        }
    }

    /**
     * Test that license plate belongs to łodzkie voivodeship or to army
     */
    public function testLodzkieOrArmyLicensePlate()
    {
        for ($i = 0; $i < 5; $i++) {
            $licensePlate = $this->faker->licensePlate(array('łódzkie', 'army'));
            $this->assertNotEmpty($licensePlate);
            $this->assertIsString($licensePlate);
            $this->assertMatchesRegularExpression('/^(?:[EU][A-P,R-Z] [A-P,R-Z\d]{5}|[EU][A-P,R-Z]{2} [A-P,R-Z\d]{4,5})$/', $licensePlate);
        }
    }

    /**
     * Test that license plate belongs to łodzkie voivodeship or to army
     */
    public function testNoCorrectVoivodeshipLicensePlate()
    {
        for ($i = 0; $i < 5; $i++) {
            $licensePlate = $this->faker->licensePlate(array('fake voivodeship', 'fake voivodeship2'));
            $this->assertNotEmpty($licensePlate);
            $this->assertIsString($licensePlate);
            $this->assertMatchesRegularExpression('/^(?:[A-P,R-Z]{2} [A-P,R-Z\d]{5}|[A-P,R-Z]{3} [A-P,R-Z\d]{4,5})$/', $licensePlate);
        }
    }

    /**
     * Test that correct license plate is generated when no voivodeship is given
     */
    public function testNoVoivodeshipLicensePlate()
    {
        for ($i = 0; $i < 5; $i++) {
            $licensePlate = $this->faker->licensePlate(array());
            $this->assertNotEmpty($licensePlate);
            $this->assertIsString($licensePlate);
            $this->assertMatchesRegularExpression('/^(?:[A-P,R-Z]{2} [A-P,R-Z\d]{5}|[A-P,R-Z]{3} [A-P,R-Z\d]{4,5})$/', $licensePlate);
        }
    }

    /**
     * Test that correct license plate is generated when no voivodeship is given
     */
    public function testNoVoivodeshipNoCountyLicensePlate()
    {
        for ($i = 0; $i < 5; $i++) {
            $licensePlate = $this->faker->licensePlate(array(), array());
            $this->assertNotEmpty($licensePlate);
            $this->assertIsString($licensePlate);
            $this->assertMatchesRegularExpression('/^(?:[A-P,R-Z]{2} [A-P,R-Z\d]{5}|[A-P,R-Z]{3} [A-P,R-Z\d]{4,5})$/', $licensePlate);
        }
    }

    /**
     * Test that license plate belongs to one of warszawski zachodni or radomski counties or to Border Guard
     */
    public function testVoivodeshipCountyLicensePlate()
    {
        for ($i = 0; $i < 5; $i++) {
            $licensePlate = $this->faker->licensePlate(
                array('mazowieckie', 'services'),
                array('Straż Graniczna', 'warszawski zachodni', 'radomski')
            );
            $this->assertNotEmpty($licensePlate);
            $this->assertIsString($licensePlate);
            $this->assertMatchesRegularExpression('/^(?:WZ [A-P,R-Z\d]{5}|(?:WRA|HWA|HWK) [A-P,R-Z\d]{4,5})$/', $licensePlate);
        }
    }

    /**
     * Test that correct license plate is generated when non-existing county is given
     */
    public function testVoivodeshipFakeCountyLicensePlate()
    {
        for ($i = 0; $i < 5; $i++) {
            $licensePlate = $this->faker->licensePlate(
                array('mazowieckie', 'services'),
                array('fake county')
            );
            $this->assertNotEmpty($licensePlate);
            $this->assertIsString($licensePlate);
            $this->assertMatchesRegularExpression('/^(?:[A-P,R-Z]{2} [A-P,R-Z\d]{5}|[A-P,R-Z]{3} [A-P,R-Z\d]{4,5})$/', $licensePlate);
        }
    }

    /**
     * Test that correct license plate is generated when non-existing voivodeship is given
     */
    public function testVoivodeshipFakeVoivodeshipLicensePlate()
    {
        for ($i = 0; $i < 5; $i++) {
            $licensePlate = $this->faker->licensePlate(
                array('fake voivodeship'),
                array('Straż Graniczna', 'warszawski zachodni', 'radomski')
            );
            $this->assertNotEmpty($licensePlate);
            $this->assertIsString($licensePlate);
            $this->assertMatchesRegularExpression('/^(?:[A-P,R-Z]{2} [A-P,R-Z\d]{5}|[A-P,R-Z]{3} [A-P,R-Z\d]{4,5})$/', $licensePlate);
        }
    }

    /**
     * Test that correct license plate is generated when null is given instead of voivodeships list
     */
    public function testVoivodeshipNullVoivodeshipArrayLicensePlate()
    {
        for ($i = 0; $i < 5; $i++) {
            $licensePlate = $this->faker->licensePlate(
                null,
                array('Straż Graniczna', 'warszawski zachodni', 'radomski')
            );
            $this->assertNotEmpty($licensePlate);
            $this->assertIsString($licensePlate);
            $this->assertMatchesRegularExpression('/^(?:[A-P,R-Z]{2} [A-P,R-Z\d]{5}|[A-P,R-Z]{3} [A-P,R-Z\d]{4,5})$/', $licensePlate);
        }
    }

    /**
     * Test that correct license plate is generated when null is given in voivodeships array
     */
    public function testVoivodeshipNullVoivodeshipLicensePlate()
    {
        for ($i = 0; $i < 5; $i++) {
            $licensePlate = $this->faker->licensePlate(
                array(null),
                array('Straż Graniczna', 'warszawski zachodni', 'radomski')
            );
            $this->assertNotEmpty($licensePlate);
            $this->assertIsString($licensePlate);
            $this->assertMatchesRegularExpression('/^(?:[A-P,R-Z]{2} [A-P,R-Z\d]{5}|[A-P,R-Z]{3} [A-P,R-Z\d]{4,5})$/', $licensePlate);
        }
    }
}
