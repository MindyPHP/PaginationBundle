<?php

declare(strict_types=1);

/*
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Mindy\Bundle\PaginationBundle\Tests;

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

        $this->assertFalse($container->has('pagination.twig.extension'));

        $this->assertTrue($container->has('pagination.factory'));
        $this->assertFalse($container->has(PaginationFactory::class));

        $this->assertTrue($container->has('pagination.data_source.array'));
        $this->assertFalse($container->has(ArrayDataSource::class));

        $this->assertTrue($container->has('pagination.data_source.query_set'));
        $this->assertFalse($container->has(QuerySetDataSource::class));

        $this->assertTrue($container->has('pagination.handler.request'));
        $this->assertFalse($container->has(RequestPaginationHandler::class));
    }
}
