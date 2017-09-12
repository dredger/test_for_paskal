Command interface 
========================
php app/console users:import /path/to/file.csv 
php app/console users:import /home/a.dulev/test_paskal/docs/users.csv
 


Doctrine 
========================

php app/console  doctrine:mapping:import --force AppBundle xml
php app/console  doctrine:mapping:convert annotation ./src

php app/console doctrine:generate:entities AppBundle
php app/console  orm:generate-entities --generate-annotations="true"  app/