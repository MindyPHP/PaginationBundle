<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\PaginationBundle\Utils;

use Mindy\Pagination\Handler\PaginationHandlerInterface;
use Mindy\Pagination\Pagination;
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
     * @param array                           $parameters
     * @param PaginationHandlerInterface|null $handler
     *
     * @return Pagination
     */
    protected function createPagination($source, array $parameters = [], ?PaginationHandlerInterface $handler = null)
    {
        if (false === $this->container->has('pagination.factory')) {
            throw new \LogicException('You can not use the "createPagination" method if the Pagination Component are not available.');
        }

        if (is_null($handler)) {
            $handler = $this->container->get('pagination.handler.request');
        }

        $factory = $this->container->get('pagination.factory');

        return $factory->createPagination($source, $parameters, $handler);
    }
}
