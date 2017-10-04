# Sample PSR-4 execution

This is a sample execution of a psr-4 project. this sample project was tested and run in a XAMPP environment. 

## Hosts
* 127.0.0.1       psr4.dev

## mySQL
* database: psr4test

##http vhosts
<VirtualHost *:80>
    ServerName psr4.dev
    ServerAlias psr4.dev
    DocumentRoot "/Applications/XAMPP/xamppfiles/htdocs/psr4.dev/public"
    <Directory "/Applications/XAMPP/xamppfiles/htdocs/psr4.dev/public" >
        AllowOverride All
    </Directory>
</VirtualHost>

## References
* psr-4: http://www.php-fig.org/psr/psr-4/
* composer: https://getcomposer.org/

## Notes
* on terminal, cd to project directory and run 'composer update' the 'composer dump-autoload'
