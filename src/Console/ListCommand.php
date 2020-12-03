<?php
/**
 * Author: codesinging <codesinging@gmail.com>
 * Github: https://github.com/codesinging
 */

namespace CodeSinging\PinAdmin\Console;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class ListCommand extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'admin:list';

    /**
     * The console command description.
     *
     * @var string|null
     */
    protected $description = 'List all PinAdmin commands';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->listCommands();
    }

    /**
     * @return array
     */
    protected function getCommands()
    {
        return collect(Artisan::all())->mapWithKeys(function ($command, $key) {
            if ('admin' === $key || Str::startsWith($key, 'admin:')) {
                return [$key => $command];
            }
            return [];
        })->toArray();
    }

    /**
     * @param array $commands
     * @return int
     */
    protected function getNameColumnWidth(array $commands)
    {
        $widths = [];

        /** @var Command $command */
        foreach ($commands as $command) {
            $widths[] = Str::length($command->getName());
        }

        return $widths ? max($widths) + 2 : 0;
    }

    /**
     * List all the PinAdmin commands
     */
    protected function listCommands(): void
    {
        $this->title('Available PinAdmin commands:');

        $commands = $this->getCommands();

        $width = $this->getNameColumnWidth($commands);

        /** @var Command $command */
        foreach ($commands as $command) {
            $this->line(sprintf(" <info>%-{$width}s</info> %s", $command->getName(), $command->getDescription()));
        }

        $this->line('');
    }
}