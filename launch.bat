START "rental-central" /D rental-central php artisan serve --host=192.168.1.2 --port 8080
START "rental-node-1" /D rental-node-1 php artisan serve --host=192.168.1.2 --port 8081
START "rental-node-2" /D rental-node-2 php artisan serve --host=192.168.1.2 --port 8082