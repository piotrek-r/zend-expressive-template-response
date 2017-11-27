<?php
declare(strict_types=1);

namespace PiotrekR\TemplateResponse\Response;

use Fig\Http\Message\StatusCodeInterface;
use Zend\Diactoros\Response\HtmlResponse;

/**
 * Class HtmlTemplateResponse
 * @package PiotrekR\TemplateResponse\Response
 */
class HtmlTemplateResponse extends HtmlResponse
{
    /**
     * @var string
     */
    private $templateName;

    /**
     * @var array
     */
    private $variables;

    /**
     * HtmlTemplateResponse constructor.
     * @param string $templateName
     * @param array $variables
     * @param int $status
     * @param array $headers
     */
    public function __construct(
        string $templateName,
        array $variables,
        int $status = StatusCodeInterface::STATUS_OK,
        array $headers = []
    ) {
        $this->templateName = $templateName;
        $this->variables = $variables;
        parent::__construct('', $status, $headers);
    }

    /**
     * @param string $templateName
     * @return HtmlTemplateResponse
     */
    public function withTemplateName(string $templateName): HtmlTemplateResponse
    {
        $c = clone $this;
        $c->templateName = $templateName;
        return $c;
    }

    /**
     * @return string
     */
    public function templateName(): string
    {
        return $this->templateName;
    }

    /**
     * @param array $variables
     * @return HtmlTemplateResponse
     */
    public function withVariables(array $variables): HtmlTemplateResponse
    {
        $c = clone $this;
        $c->variables = $variables;
        return $c;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return HtmlTemplateResponse
     */
    public function withVariable(string $name, $value): HtmlTemplateResponse
    {
        $c = clone $this;
        $c->variables[$name] = $value;
        return $c;
    }

    /**
     * @return array
     */
    public function variables(): array
    {
        return $this->variables;
    }
}
