<?php
declare(strict_types=1);

namespace PiotrekR\TemplateResponse\Middleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use PiotrekR\TemplateResponse;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros;
use Zend\Expressive;

/**
 * Class TemplateMiddleware
 * @package PiotrekR\TemplateResponse\Middleware
 */
class TemplateMiddleware implements MiddlewareInterface
{
    /**
     * @var Expressive\Template\TemplateRendererInterface|null
     */
    private $renderer;

    /**
     * TemplateMiddleware constructor.
     * @param Expressive\Template\TemplateRendererInterface|null $renderer
     */
    public function __construct(Expressive\Template\TemplateRendererInterface $renderer = null)
    {
        $this->renderer = $renderer;
    }

    /**
     * @param ServerRequestInterface $request
     * @param DelegateInterface $delegate
     * @return ResponseInterface
     */
    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $response = $delegate->process($request);

        if (!$this->renderer) {
            return $response;
        }

        if ($response instanceof TemplateResponse\Response\HtmlTemplateResponse) {
            $response = $this->renderHtml($response);
        }

        if ($response instanceof TemplateResponse\Response\TextTemplateResponse) {
            $response = $this->renderText($response);
        }

        return $response;
    }

    /**
     * @param TemplateResponse\Response\HtmlTemplateResponse $response
     * @return Diactoros\Response\HtmlResponse
     */
    private function renderHtml(
        TemplateResponse\Response\HtmlTemplateResponse $response
    ): Diactoros\Response\HtmlResponse {
        return new Diactoros\Response\HtmlResponse(
            $this->renderer->render($response->templateName(), $response->variables()),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }

    /**
     * @param TemplateResponse\Response\TextTemplateResponse $response
     * @return Diactoros\Response\TextResponse
     */
    private function renderText(
        TemplateResponse\Response\TextTemplateResponse $response
    ): Diactoros\Response\TextResponse {
        return new Diactoros\Response\TextResponse(
            $this->renderer->render($response->templateName(), $response->variables()),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }
}
