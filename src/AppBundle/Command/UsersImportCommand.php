<?php
// src/AppBundle/Command/UsersImportCommand.php
namespace AppBundle\Command;

ini_set("memory_limit", "56M");

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
            $text = 'Start processing the File  '.$file;
        } else {
            $text = 'File name is Empty';
            $output->writeln($text);
            return;
        }

//        $entityManager = $this->getContainer()->get('doctrine')->getEntityManager();
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        if(!file_exists($file)){
            $text = 'File has not been found by path: ' . $file;
            $output->writeln($text);
            return ;
        }


        $file = fopen($file, 'r');
        $i= 0;
        $n = 0;
        while (($line = fgetcsv($file)) !== FALSE) {

//            print_r($line);
            if($i == 0){
                $i++;
                continue;
            }

            $i++;

            $u = $this->lineToEntity($line);
            $em ->persist($u);

            unset($u);


            if($i==200){
                $n = $n+1;
                $output->writeln("Start Saving operation number $n  ");
                $em ->flush();
                $em ->clear();
                $i = 1;
                $output->writeln("Finish Saving operation number $n  ");
            }

        }
        $em ->flush();
        $em ->clear();
        fclose($file);

        $output->writeln($text);
    }

    /**
     * @param string $line
     * @return \AppBundle\Entity\Users
     */
    public function lineToEntity($line)
    {
        $arr = explode(";", $line[0]);

//        var_dump($arr);

        $u = new \AppBundle\Entity\Users();
        $u->setFName($arr[0]);
        $u->setLName($arr[1]);
        $u->setBDay(new \DateTime($arr[2]));
        $u->setEmail($arr[3]);
        $u->setHCity($arr[4]);
        $u->setHZip($arr[5]);
        $u->setHAddress($arr[6]);
        $u->setPhone($arr[7]);
        $u->setCompany($arr[8]);
        $u->setWCity($arr[9]);
        $u->setWAdress($arr[10]);
        $u->setPosition($arr[11]);
        $u->setCv($arr[11]);

        return $u;
    }
}