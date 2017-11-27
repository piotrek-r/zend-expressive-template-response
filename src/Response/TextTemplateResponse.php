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
