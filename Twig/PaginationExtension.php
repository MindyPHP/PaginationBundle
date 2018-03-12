<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2018 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\PaginationBundle\Twig;

use Mindy\Pagination\PaginationView;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Twig_Environment;

class PaginationExtension extends AbstractExtension
{
    /**
     * @var Twig_Environment
     */
    protected $twig;

    /**
     * SeoLibrary constructor.
     *
     * @param Twig_Environment $twig
     */
    public function __construct(?Twig_Environment $twig = null)
    {
        $this->twig = $twig;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('pagination_render', [$this, 'doRenderPagination'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param PaginationView $view
     * @param string         $template
     *
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     *
     * @return string
     */
    public function doRenderPagination(PaginationView $view, $template = 'pagination/default.html')
    {
        if (null === $this->twig) {
            throw new \LogicException('Template component not injected to PaginationLibrary');
        }

        return $this->twig->render($template, [
            'pager' => $view,
        ]);
    }
}
