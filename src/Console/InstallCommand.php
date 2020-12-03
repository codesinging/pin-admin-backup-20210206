<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Console;

use CodeSinging\PinAdmin\Foundation\AdminServiceProvider;

class InstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:install';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Install the PinAdmin application';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->publishResources();
    }

    /**
     * Determine if the PinAdmin is already installed.
     * @return bool
     */
    protected function isInstalled()
    {
        return is_dir(admin()->path());
    }

    /**
     * Publish resources.
     */
    protected function publishResources(): void
    {
        $this->title('Publishing resources...');

        $this->call('vendor:publish', ['--provider' => AdminServiceProvider::class, '--force' => true]);
    }

}