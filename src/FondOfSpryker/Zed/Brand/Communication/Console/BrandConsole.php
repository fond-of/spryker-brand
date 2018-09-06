<?php

namespace FondOfSpryker\Zed\Brand\Communication\Console;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\FilterTransfer;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \FondOfSpryker\Zed\Brand\Business\BrandFacadeInterface getFacade()
 */
class BrandConsole extends Console
{
    const COMMAND_NAME = 'brand:get';
    const DESCRIPTION = 'Get and print brands';

    /**
     * @return void
     */
    protected function configure()
    {
        $this->setName(self::COMMAND_NAME);
        $this->setDescription(self::DESCRIPTION);

        parent::configure();
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $filter = new FilterTransfer();

        $brandCollectionTransfer = new BrandCollectionTransfer();
        $brandCollectionTransfer->setFilter($filter);
        $brandTransfer = $this->getFacade()->getBrandCollection($brandCollectionTransfer);

        foreach ($brandTransfer->getBrands() as $brandTransfer) {
            /** @var \Generated\Shared\Transfer\BrandTransfer $brandTransfer */
            $this->output->write(\implode(', ', $brandTransfer->toArray()));
            $this->output->writeln('');
        }

        return static::CODE_SUCCESS;
    }
}
