<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Console;

class AdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'admin';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'Show the PinAdmin package';

    /**
     * The PinAdmin logo
     * @var string
     */
    protected $logo = <<<LOGO

      ____    ______  _   __   ___      ____    __  ___  ______  _   __
     / __ \  /_  __/ / | / /  /   |    / __ \  /  |/  / /_  __/ / | / /
    / /_/ /   / /   /  |/ /  / /| |   / / / / / /|_/ /   / /   /  |/ /
   / ____/ __/ /_  / /|  /  / ___ |  / /_/ / / /  / / __/ /_  / /|  /
  /_/     /_____/ /_/ |_/  /_/  |_| /_____/ /_/  /_/ /_____/ /_/ |_/

LOGO;

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->outputLogo();
        $this->line('');
        $this->call('admin:list');
    }

    protected function outputLogo():void
    {
        $this->line($this->logo);
        $this->line(sprintf('<comment>%s</comment> <info>%s</info>', admin()->name(), admin()->version()));
    }
}