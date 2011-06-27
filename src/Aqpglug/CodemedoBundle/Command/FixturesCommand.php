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
                    new InputOption('path', null, InputOption::VALUE_OPTIONAL, ''),
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
        $path = sprintf("%s/../%s", __DIR__, ($input->getOption('path') ? : "Resources/fixtures/Block.yml"));
        $clean = $input->getOption('clean');
        
        $output->writeln(sprintf("<info>Leyendo </info><comment>%s</comment>", realpath($path)));
        $data = Yaml::parse($path);

        /* @var $em \Doctrine\ORM\EntityManager */
        $em = $this->getContainer()->get('doctrine')->getEntityManager();

        if($clean)
        {
            $output->writeln("<info>Eliminando registros de </info><comment>Block</comment>");
            $em->createQuery('DELETE Aqpglug\CodemedoBundle\Entity\Block a')->execute();
        }

        foreach($data as $section => $items)
        {
            $output->writeln(sprintf("<info>Agregando </info><comment>%s</comment>", $section));
            foreach($items as $item)
            {
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
        }
        $em->flush();
    }
}