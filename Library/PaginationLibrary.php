<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\PaginationBundle\Library;

use Mindy\Pagination\PaginationView;
use Mindy\Template\Library\AbstractLibrary;
use Mindy\Template\TemplateEngine;

class PaginationLibrary extends AbstractLibrary
{
    /**
     * @var TemplateEngine
     */
    protected $template;

    /**
     * PaginationLibrary constructor.
     *
     * @param TemplateEngine|null $template
     */
    public function __construct(TemplateEngine $template = null)
    {
        $this->template = $template;
    }

    /**
     * @return array
     */
    public function getHelpers()
    {
        return [
            'pagination_render' => function (PaginationView $view, $template = 'pagination/default.html') {
                if (null === $this->template) {
                    throw new \LogicException('Template component not injected to PaginationLibrary');
                }

                return $this->template->render($template, [
                    'pager' => $view,
                ]);
            },
        ];
    }
}
