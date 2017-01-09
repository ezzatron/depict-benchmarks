<?php

namespace Eloquent\Depict;

use Athletic\AthleticEvent;
use Kint;
use Krumo;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;

class TypicalDataEvent extends AthleticEvent
{
    protected function setUp()
    {
        // required for Symfony VarDumper 2.x
        $errorReporting = error_reporting();
        error_reporting($errorReporting & ~E_WARNING);

        $this->data = require __DIR__ . '/data/typical.php';

        $this->depict = InlineExporter::create();

        $this->symfony = new CliDumper();
        $this->symfonyCloner = new VarCloner();

        ob_start();
    }

    protected function tearDown()
    {
        ob_end_clean();
    }

    /**
     * @iterations 100
     */
    public function depict()
    {
        $this->depict->export($this->data);
    }

    /**
     * @iterations 100
     */
    public function symfony()
    {
        $this->symfony->dump($this->symfonyCloner->cloneVar($this->data), true);
    }

    /**
     * @iterations 100
     */
    public function krumo()
    {
        Krumo::dump($this->data);
    }

    /**
     * @iterations 100
     */
    public function kint()
    {
        Kint::dump($this->data);
    }

    /**
     * @iterations 100
     */
    public function phpRef()
    {
        rt($this->data);
    }
}
