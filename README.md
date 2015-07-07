# test
1. link nginx conf:

    ln -s -t /etc/nginx/sites-enabled $(pwd)/install/ptest.conf
2. reload nginx
3. create database ptest;
4. install tables:

    mysql -uroot -p --database ptest < install/tables.sql

5. install other tables from  http://www2.informatik.uni-freiburg.de/~cziegler/BX/BX-SQL-Dump.zip
6. go to http://ptest/login
7. register new user or use `test@tess.tt : 123qwe` to login
8. use `test/apiA.php` and `test/apiTest.php` to see how it works
