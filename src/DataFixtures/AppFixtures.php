<?php

namespace App\DataFixtures;
ini_set('memory_limit', '8192M');

use App\Entity\Etablissement;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Validator\Constraints\Date;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $filename = 'src/DataFixtures/data2.csv';
        $donnees = [];
        if(($h= fopen((string)($filename), 'r')) !==FALSE){
            while(($data = fgetcsv($h, 100000, ",")) !=FALSE){
                $donnees[] = $data;
            }
            fclose($h);
        }

        $i = 0;
        foreach ($donnees as $donnee) {
            foreach ($donnee as $d) {
                $i++;
                $data = explode(";", $d);
                if ($i > 1) {

                    $date=''!==$data[33]?new \DateTime($data[33]):null;
                    $etablissement = new Etablissement();
                    $etablissement->setNomEtablissement($data[1]);
                    $etablissement->setNatureEtablissement($data[19]);
                    $etablissement->setAcademie($data[24]);
                    $etablissement->setRegion($data[27]);
                    $etablissement->setAdresse($data[5]);
                    $etablissement->setCommune((string)$data[10]);
                    $etablissement->setDateOuverture($date);
                    $etablissement->setDepartement($data[26]);
                    $etablissement->setLatitude($data[14]);
                    $etablissement->setLongitude($data[15]);
                    $etablissement->setSecteurEtablissement($data[4]);

                    $manager->persist($etablissement);
                }
            }

        }

        $manager->flush();


    }






}
