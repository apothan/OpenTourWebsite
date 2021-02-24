<?php
// src/Apothan/OpenToursBundle/ApothanOpenToursBundle.php
namespace Apothan\OpenToursBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Apothan\OpenToursBundle\DependencyInjection\ApothanOpenToursExtension;

class ApothanOpenToursBundle extends Bundle
{
    public function build(ContainerBuilder $container){
        parent::build($container);
    }

    /**
     * Overridden to allow for the custom extension alias.
     */
    public function getContainerExtension()
    {
        if (null === $this->extension) {
            $this->extension = new ApothanOpenToursExtension();
        }
        return $this->extension;
    }

    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}