-- Generate DROP DATABASE statements for all databases
-- except system / protected ones

SELECT CONCAT('DROP DATABASE `', schema_name, '`;') AS drop_statement
FROM information_schema.schemata
WHERE schema_name NOT IN (
    'information_schema',
    'mysql',
    'performance_schema',
    'phpmyadmin'
);
