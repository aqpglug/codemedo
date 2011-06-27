<?php

namespace Aqpglug\CodemedoBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\HttpKernel\Util\Filesystem;
use Aqpglug\CodemedoBundle\Entity\Block;

class FixturesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
                ->setName('codemedo:fixtures')
                ->setDescription('agrega data desde un YML en la a la base de datos')
                ->setDefinition(array(
                    new InputOption('path', null, InputOption::VALUE_OPTIONAL, '/../Resources/fixtures/Block.yml'),
                    new InputOption('clean', null, InputOption::VALUE_OPTIONAL, false),
                ))
                ->setHelp(<<<EOT
El comando <info>codemedo:fixtures</info> carga datos de YML a la base de datos:

  <info>php app/console codemedo:fixtures</info>

agrega todos los datos de ../Resources/fixtures/Block.yml

puede agregar la opcion --clean para limpiar la base de datos antes de insertar :

  <info>php app/console codemedo:fixtures --clean=true</info>

EOT
        );
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $path = __DIR__ . $input->getOption('path');
        $clean = __DIR__ . $input->getOption('clean');
        $data = Yaml::parse($path);
        
        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getContainer()->get('doctrine')->getEntityManager();
        
        if($clean)
            $em->createQuery('DELETE a FROM Aqpglug\CodemedoBundle\Entity\Block a');
        
        foreach ($data as $item) {
            $block = new Block();
            $block->setType($item['type']);
            $block->setTitle($item['title']);
            $block->setContent($item['content']);
            $block->setPublished($item['published']);
            $block->setFeatured($item['featured']);
            $block->setImage($item['image']);
            $block->setMetadata($item['metadata']);
            $em->persist($block);
        }
        $em->flush();
    }
}