<?php
namespace Idiaz\Factories;

use Slender\Interfaces\FactoryInterface;
use Aptoma\Twig\Extension\MarkdownExtension;
use Aptoma\Twig\Extension\MarkdownEngine;

class TwigMarkdownFactory implements FactoryInterface
{

    /**
     * @param \Slender\App $app
     * @return \Twig_Environment
     */
    public function create(\Slender\App $app)
    {
        // Uses Michelf\Markdown engine (if you prefer)
        $engine = new MarkdownEngine\MichelfMarkdownEngine();

        $markdown = new MarkdownExtension($engine);

        return $markdown;
    }
}
