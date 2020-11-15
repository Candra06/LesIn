Deskripsi Project:


Cara Install :
1. buka cmd/git bash
2. arahkan ke folder project masing-masing
3. jalankan command line di cmd 'git clone https://github.com/Candra06/LesIn.git'
4. Jalan xampp(apache+mysql)
5. Buka localhost/phpmyadmin
6. buat database baru dengan nama 'lesin'
7. ubah file .env.example menjadi .env
8. setting file .env 
9. Ubah DB_DATABASE = lesin
10. DB_USERNAME = root
11. isi DB_PASSWORD jika phpmyadmin memiliki password, jika tidak biarkan kosong
12. jalankan command 'php artisan key:generate'
13. jalankan command 'php artisan passport:install'
14. jalankan command 'php artisan migrate'
15. jalankan command 'php artisan serve'
16. Enjoy your problem
