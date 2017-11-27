<?php
declare(strict_types=1);

namespace PiotrekR\TemplateResponse\Response;

use Fig\Http\Message\StatusCodeInterface;
use Zend\Diactoros\Response\TextResponse;

/**
 * Class TextTemplateResponse
 * @package PiotrekR\TemplateResponse\Response
 */
class TextTemplateResponse extends TextResponse
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
     * TextTemplateResponse constructor.
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
     * @return TextTemplateResponse
     */
    public function withTemplateName(string $templateName): TextTemplateResponse
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
     * @return TextTemplateResponse
     */
    public function withVariables(array $variables): TextTemplateResponse
    {
        $c = clone $this;
        $c->variables = $variables;
        return $c;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return TextTemplateResponse
     */
    public function withVariable(string $name, $value): TextTemplateResponse
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
