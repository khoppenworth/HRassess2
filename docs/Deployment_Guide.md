# EPSS Deployment Guide (v1-structure)
Prereqs: PHP 8+, MySQL 8, Apache/Nginx, file uploads enabled.
Drop AdminLTE 3.2 into `/public/vendor/adminlte` (and FontAwesome into `/public/vendor/fontawesome`).
Import `sql/install.sql`. Update DB creds in `/config.php`. Default login: admin / admin123.
