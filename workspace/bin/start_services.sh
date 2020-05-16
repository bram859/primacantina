sudo chown -R mysql:root /var/run/mysqld
sudo chown -R mysql:mysql /var/lib/mysql
sudo chown -R mysql:mysql /var/lib/mysql

sudo mysql-ctl start 2>&1 > /home/ubuntu/workspace/bin/log/start_services.log
sudo phpmyadmin-ctl install 2>&1 >> /home/ubuntu/workspace/bin/log/start_services.log
`dirname $0`/protect_folder.sh