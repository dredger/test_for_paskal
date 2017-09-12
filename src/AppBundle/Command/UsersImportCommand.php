<?php
// src/AppBundle/Command/UsersImportCommand.php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UsersImportCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('users:import')
            ->setDescription('Import users from CSV ')
            ->addArgument(
                'file',
                InputArgument::OPTIONAL,
                'Who do you want to greet?'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $file = $input->getArgument('file');
        if ($file) {
            $text = 'File  '.$file;
        } else {
            $text = 'File name is Empty';
            $output->writeln($text);
            return;
        }


        $u = new \AppBundle\Entity\Users();
        $u->setFName("ss");

//        $entityManager = $this->getContainer()->get('doctrine')->getEntityManager();
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $em ->persist($u);
//        $em ->flush();

        return;


        if(!file_exists($file)){
            $text = 'File has not been found by path: ' . $file;
            $output->writeln($text);
            return ;
        }


        $file = fopen($file, 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            //$line[0] = '1004000018' in first iteration
            print_r($line);
        }
        fclose($file);

        $output->writeln($text);
    }
}