<?php
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use AppBundle\Repository\ItemRepository;
use AppBundle\ServiceFactories\RepositoryFactory;
use AppBundle\Entity\Item;

// To use as default template
$definition = new Definition();

$definition->setAutowired(true)->setAutoconfigured(true)->setPublic(false);

// $this is a reference to the current loader
$this->registerClasses($definition, 'AppBundle\\', '../../src/AppBundle/*', '../../src/AppBundle/{Entity,Repository,Tests,Interfaces,Services/Adapters/RepositoryServiceAdapter.php}');

$definition->addTag('controller.service_arguments');
$this->registerClasses($definition, 'AppBundle\\Controller\\', '../../src/AppBundle/Controller/*');


$container->register(ItemRepository::class,ItemRepository::class)
  ->setFactory([new Reference(RepositoryFactory::class),'repositoryAsAService'])
  ->setArguments(['$entityManager'=>new Reference('doctrine.orm.entity_manager'),'$entityName'=>Item::class]);
