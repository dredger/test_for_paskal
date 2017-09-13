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

        $em = $this->getContainer()->get('doctrine')->getEntityManager();
//        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        if(!file_exists($file)){
            $text = 'File has not been found by path: ' . $file;
            $output->writeln($text);
            return ;
        }

        $time  = time();
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

//            $u = $this->lineToEntity($line);
//            $em ->persist($u);


            $sql[] = $this->lineToInsert($line);




            if( $i % 100 == 0){
                $n = $n+1;

                $output->writeln("Start Saving operation number $n  ");
//                $em ->flush();
//                $em ->clear();

//                $stmt  =  $em->getConnection()->prepare(implode("; ", $sql));
//                $stmt->execute();
                $em->getConnection()->exec(implode("   ", $sql));
                $sql = array();
                $em ->clear();

//                unset($em);

//                $em = $this->getContainer()->get('doctrine')->getEntityManager();
                $output->writeln("Finish Saving operation number $n  ");
            }

        }
        $em ->flush();
        $em ->clear();
        fclose($file);

        $tt = time() - $time;
        $output->writeln("execution time  " . $tt);
        $output->writeln("lines number   " . $i);
    }


    /**
     * @param string $line
     * @return \AppBundle\Entity\Users
     */
    private function lineToInsert($line){
        $line[0] = addslashes($line[0]);
        $arr = explode(";", $line[0]);

        $date = date("d/m/Y", strtotime($arr[2]));


        $arr = explode(";", $line[0]);

        $ins = "INSERT INTO `users` 
          (`f_name`, `l_name`, `b_day`, `email`, `h_city`, `h_zip`, `h_address`, `phone`, `company`, `w_city`, `w_adress`, `position`, `cv`) 
      VALUES ('$arr[0]', '$arr[1]', '$arr[2]', '$arr[3]', '$arr[4]', 
      '$arr[5]', '$arr[6]', '$arr[7]', '$arr[8]', '$arr[9]', '$arr[10]', '$arr[11]', '$arr[12]') ; ";

        return $ins ;

    }

    /**
     * @param string $line
     * @return \AppBundle\Entity\Users
     */
    public function lineToEntity($line)
    {

        $line[0] = addslashes($line[0]);

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