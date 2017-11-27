<?php
declare(strict_types=1);

namespace PiotrekR\TemplateResponse\Middleware;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Class TemplateFactory
 * @package PiotrekR\TemplateResponse\Middleware
 */
class TemplateFactory
{
    /**
     * @param ContainerInterface $container
     * @return TemplateMiddleware
     */
    public function __invoke(ContainerInterface $container): TemplateMiddleware
    {
        $renderer = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        return new TemplateMiddleware($renderer);
    }
}
