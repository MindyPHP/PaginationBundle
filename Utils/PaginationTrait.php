<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\PaginationBundle\Utils;

use Mindy\Pagination\Handler\RequestPaginationHandler;
use Mindy\Pagination\Pagination;
use Mindy\Pagination\PaginationFactory;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Trait PaginationTrait
 *
 * @property ContainerInterface $container
 */
trait PaginationTrait
{
    /**
     * @param $source
     * @param array $parameters
     *
     * @return Pagination
     */
    protected function createPagination($source, array $parameters = [])
    {
        if ($this->container->has(PaginationFactory::class)) {
            return $this->container->get(PaginationFactory::class)->createPagination(
                $source,
                $parameters,
                RequestPaginationHandler::class
            );
        }
        throw new \LogicException('You can not use the "createPagination" method if the Pagination Component are not available.');
    }
}
