<?php

namespace Terdelyi\Localedate;

use Carbon\Carbon;
use Mockery;
use Illuminate\Contracts\Foundation\Application;

class DateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Mockery\Mock
     */
    protected $app;

    /**
     * Setup test
     */
    protected function setUp()
    {
        $this->setUpMocks();

        $this->date = new Date($this->app);
        $this->date->loadLocales(['hu' => 'hu_HU']);

        parent::setUp();
    }

    /**
     * Setup mocks
     */
    protected function setUpMocks()
    {
        $this->app = Mockery::mock(Application::class);
    }

    /**
     * Test formatLocalized()
     * @return [type] [description]
     */
    public function testFormatLocalizedIsEqual()
    {
        $this->date->setLocale('hu');
        $formattedDate = Carbon::createFromDate(2016,6,9)->formatLocalized('%A %d %B %Y');
        $this->assertEquals(strtolower($formattedDate), strtolower('Csütörtök 09 Június 2016'));
    }

    /**
     * Test diffForHumans()
     * @return [type] [description]
     */
    public function testdiffForHumansIsEqual()
    {
        $this->date->setCarbon('hu');
        $formattedDate = Carbon::createFromDate(2016,6,9)->addYear()->diffForHumans();
        $this->assertEquals(strtolower($formattedDate), strtolower('1 évvel később'));
    }
}