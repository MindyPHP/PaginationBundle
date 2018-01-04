<?php

declare(strict_types=1);

/*
 * This file is part of Mindy Framework.
 * (c) 2018 Maxim Falaleev
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
            $handler = $this->container->get(RequestPaginationHandler::class);

            return $this
                ->container
                ->get(PaginationFactory::class)
                ->createPagination($source, $parameters, $handler);
        }
        throw new \LogicException('You can not use the "createPagination" method if the Pagination Component are not available.');
    }
}
