# Laravel + Tailwindcss 
 A simple application using laravel + Tailwindcss


link : [http://154.254.91.100/](http://54.254.91.100/)

***Set Up The Server***

**Install NGINX**
    <br> - <code>sudo apt update</code>
    <br> - <code>sudo apt install nginx -y</code>
    
**Install PHP**
    <br> - <code>sudo apt install php-fpm php-url php-mbstring</code>
    
**Edit the server's default config file to support PHP in NGINX**
    <br> - <code>sudo vi /etct/nginx/sites-available/default</code>
    <br> - Add index.php to the index list
    <br> - Uncomment the PHP scripts to FastCGI entry block.
    <br> - Uncomment the line to include snippets/fastcgi-php.conf.
    <br> - Uncomment the line to enable the fastcgi_pass and the php-fpm. sock.
    <br> - Uncomment the section to deny all access to Apache .htaccess files.
    <code>
    
    server {
        listen 80;
    
        server_name DOMAIN_NAME_OR_IP;
    
        root /var/www/html/recipes/public;
    
        add_header X-Frame-Options "SAMEORIGIN";
        add_header X-Content-Type-Options "nosniff";
    
        index index.php index.html;
    
        charset utf-8;
    
        location / {
            try_files $uri $uri/ /index.php?$query_string;
        }
    
        location = /favicon.ico { access_log off; log_not_found off; }
        location = /robots.txt  { access_log off; log_not_found off; }
    
        error_page 404 /index.php;
    
         location ~ \.php$ {
                    include snippets/fastcgi-php.conf;
                    fastcgi_pass unix:/run/php/php8.3-fpm.sock;
                     fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
                    include fastcgi_params;
                    fastcgi_hide_header X-Powered-By;
          }
    
            location ~ /\.ht {
                    deny all;
            }
    }
   
**Validate an Nginx config file**
    <br> - <code>sudo nginx -t</code>
    <br>
    <code>nginx php config: the configuration file /etc/nginx/nginx.conf syntax is ok
    nginx php-fpm config: configuration file /etc/nginx/nginx.conf test is successful</code>

**Enable the PHP fastCGI setup**
<br> - <code>sudo systemctl restart nginx</code>

**Install Composer**
<br> - <code>cd ~</code>
<br> - <code>curl -sS https://getcomposer.org/installer -o /tmp/composer-setup.php</code>
<br> - <code>HASH=`curl -sS https://composer.github.io/installer.sig`</code>
<br> - <code>echo $HASH</code>
<br> - <code>php -r "if (hash_file('SHA384', '/tmp/composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"</code>
<br> - <code>sudo php /tmp/composer-setup.php --install-dir=/usr/local/bin --filename=composer</code>

**Download your github repo**
<br> - <code>cd /var/www/html/</code>
<br> - <code>git clone https://github.com/stiglobalres/recipes.git</code>

**Set Up existing Laravel Project**
<br> - <code>cd /var/www/html/[project folder]</code>
<br> - <code>composer update</code>
<br> - <code>sudo cp .env.example .env</code>
<br> - <code>php artisan key:generate</code>

**Start the Laravel Project**
<br> - <code>php artisan serve</code>
