<?php

declare(strict_types=1);

/*
 * Studio 107 (c) 2017 Maxim Falaleev
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\PaginationBundle\Tests;

use Mindy\Bundle\PaginationBundle\Library\PaginationLibrary;
use Mindy\Pagination\DataSource\ArrayDataSource;
use Mindy\Pagination\DataSource\QuerySetDataSource;
use Mindy\Pagination\Handler\RequestPaginationHandler;
use Mindy\Pagination\PaginationFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Filesystem\Filesystem;

class KernelTest extends KernelTestCase
{
    protected function tearDown()
    {
        (new Filesystem())->remove(__DIR__.'/var');
    }

    protected static function createKernel(array $options = [])
    {
        return new Kernel('dev', true);
    }

    public function testPagination()
    {
        $kernel = $this->createKernel();
        $kernel->boot();

        $container = $kernel->getContainer();

        $this->assertTrue($container->has('pagination.factory'));
        $this->assertTrue($container->has(PaginationFactory::class));
        $this->assertTrue($container->has(ArrayDataSource::class));
        $this->assertTrue($container->has(QuerySetDataSource::class));
        $this->assertTrue($container->has(RequestPaginationHandler::class));
        $this->assertTrue($container->has(PaginationLibrary::class));
    }
}