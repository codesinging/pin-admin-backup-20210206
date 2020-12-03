<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Tests\Foundation;

use CodeSinging\PinAdmin\Foundation\Admin;
use CodeSinging\PinAdmin\Foundation\AdminServiceProvider;
use Orchestra\Testbench\TestCase;

class AdminTest extends TestCase
{
    /**
     * @var Admin
     */
    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = new Admin();
    }

    protected function getPackageProviders($app)
    {
        return [AdminServiceProvider::class];
    }

    public function testApp()
    {
        self::assertInstanceOf(Admin::class, Admin::app());
    }

    public function testVersion()
    {
        self::assertEquals(Admin::VERSION, $this->admin->version());
        self::assertEquals('v' . Admin::VERSION, $this->admin->version('v'));
    }

    public function testName()
    {
        self::assertEquals(Admin::NAME, $this->admin->name());
    }

    public function testGuard()
    {
        self::assertEquals(Admin::GUARD, $this->admin->guard());
    }

    public function testLabel()
    {
        self::assertEquals(Admin::LABEL, $this->admin->label());
        self::assertEquals(Admin::LABEL . '_config', $this->admin->label('config'));
        self::assertEquals(Admin::LABEL . '-config', $this->admin->label('config', '-'));
    }

    public function testDirectory()
    {
        self::assertEquals(Admin::DIRECTORY, $this->admin->directory());
        self::assertEquals(Admin::DIRECTORY . '/Controllers', $this->admin->directory('Controllers'));
    }

    public function testPath()
    {
        self::assertEquals(app_path(Admin::DIRECTORY), $this->admin->path());
        self::assertEquals(app_path(Admin::DIRECTORY) . '/Controllers', $this->admin->path('Controllers'));
    }

    public function testGetNamespace()
    {
        self::assertEquals($this->app->getNamespace() . Admin::DIRECTORY, $this->admin->getNamespace());
        self::assertEquals($this->app->getNamespace() . Admin::DIRECTORY . '\\Controllers', $this->admin->getNamespace('Controllers'));
    }

    public function testPackagePath()
    {
        self::assertEquals(dirname(dirname(__DIR__)), $this->admin->packagePath());
        self::assertEquals(dirname(dirname(__DIR__)) . '/src', $this->admin->packagePath('src'));
    }
}
