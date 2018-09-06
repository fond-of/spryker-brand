<?php

namespace FondOfSpryker\Zed\Brand\Communication\Console;

use Generated\Shared\Transfer\BrandCollectionTransfer;
use Generated\Shared\Transfer\BrandTransfer;
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
        // single
        $single = 2;

        if ($single === 1) {
            $brandTransfer = new BrandTransfer();
            $brandTransfer->setName('pinqponq');
            $brandTransfer = $this->getFacade()->getBrand($brandTransfer);

            $this->output->writeln($brandTransfer->getName() . ' ' . $brandTransfer->getB2cUrlShop());
            $this->output->writeln('Assigned CustomerIds: ' . \implode(', ', $brandTransfer->getBrandCustomerRelation()->getCustomerIds()));
            $this->output->writeln('--------');
        } else {
            // collection
            $filter = new FilterTransfer();

            $brandCollectionTransfer = new BrandCollectionTransfer();
            $brandCollectionTransfer->setFilter($filter);
            $brandTransfer = $this->getFacade()->getBrandCollection($brandCollectionTransfer);

            foreach ($brandTransfer->getBrands() as $brandTransfer) {
                $this->output->writeln($brandTransfer->getName() . ' ' . $brandTransfer->getB2cUrlShop());
                $this->output->writeln('Assigned CustomerIds: ' . \implode(', ', $brandTransfer->getBrandCustomerRelation()->getCustomerIds()));
                $this->output->writeln('--------');
            }
        }

        return static::CODE_SUCCESS;
    }
}
