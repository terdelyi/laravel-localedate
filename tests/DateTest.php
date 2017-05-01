<?php

namespace Terdelyi\LocaleDate;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Mockery;

class DateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Mockery\Mock
     */
    protected $app;

    /**
     * @var \Terdelyi\LocaleDate\Date
     */
    protected $date;

    /**
     * Setup testcase.
     */
    protected function setUp()
    {
        $this->app = Mockery::mock(Application::class);
        $this->date = new Date($this->app, new Carbon);

        $locale = getenv('LOCALEDATE_LANG') ?: 'hu_HU';
        $this->date->loadLocales(['hu' => $locale]);
        $this->date->setLocale('hu');
        $this->date->setCarbon('hu');

        parent::setUp();
    }

    /**
     * Testing formatLocalized function.
     */
    public function testFormatLocalizedIsEqual()
    {
        $this->assertEquals('csütörtök', strtolower(Carbon::createFromDate(2016,6,9)->formatLocalized('%A')));
        $this->assertEquals('május', strtolower(Carbon::createFromTimestamp(1493629070)->formatLocalized('%B')));
    }

    /**
     * Test diffForHumans function.
     */
    public function testDiffForHumansIsEqual()
    {
        $this->assertEquals('1 évvel később', Carbon::now()->diffForHumans(Carbon::now()->subYear()));
        $this->assertEquals('5 napja', Carbon::now()->subDays(5)->diffForHumans());
    }
}
