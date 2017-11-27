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
     * @return string
     */
    public function templateName(): string
    {
        return $this->templateName;
    }

    /**
     * @return array
     */
    public function variables(): array
    {
        return $this->variables;
    }
}
