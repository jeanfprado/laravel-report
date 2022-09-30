<?php

namespace Jeanfprado\LaravelReport\Console;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class ReportMakeCommand extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:report {name} {--view=} {--force}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new report class';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Report';

    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Reports';
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (parent::handle() === false && ! $this->option('force')) {
            return;
        }

        if ($this->option('view')) {
            $this->writeViewTemplate();
        }
    }

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $class = parent::buildClass($name);

        if ($this->option('view')) {
            $class = str_replace(['DummyView', '{{ view }}'], $this->option('view'), $class);
        }

        return $class;
    }

    /**
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return $this->option('view')
            ? $this->resolveStubPath('/stubs/view-report.stub')
            : $this->resolveStubPath('/stubs/report.stub');
    }

    /**
     * Resolve the fully-qualified path to the stub.
     *
     * @param  string  $stub
     * @return string
     */
    protected function resolveStubPath($stub)
    {
        return file_exists($customPath = $this->laravel->basePath(trim($stub, '/')))
            ? $customPath
            : __DIR__ . $stub;
    }

    /**
     * Write the Markdown template for the mailable.
     *
     * @return void
     */
    protected function writeViewTemplate()
    {
        $path = $this->viewPath(
            str_replace('.', '/', $this->option('view')) . '.blade.php'
        );

        if (! $this->files->isDirectory(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0755, true);
        }

        $this->files->put($path, file_get_contents(__DIR__ . '/stubs/view.stub'));
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['force', 'f', InputOption::VALUE_NONE, 'Create the class even if the report already exists'],
            ['view', 'v', InputOption::VALUE_OPTIONAL, 'Create a new View template for the report'],
        ];
    }
}
