## Interview Test Coding PHP Backend - Hary Susilo Pratama

### Soal 1: **Manajemen User**
Disini saya hanya menggunakan pemisahan role biasa yang dijadikan sebuah field di tabel `users`. Lalu untuk membuat identifikasinya ada di [`RoleFilter.php`](https://github.com/harysusilo50/interviewTest/blob/master/app/Filters/RoleFilter.php), mendeteksi apakah ia user atau admin. Untuk alternatif manajemen user sebenarnya bisa menggunakan library `Myth:Auth`, namun menurut saya untuk kasus aplikasi yang tidak kompleks cukup dilakukan seperti ini saja.

### Soal 2: **CRUD Operations (Menu Product)**
Seperti CRUD pada umumnya, saya tidak melakukan hal-hal yang fantastis, hanya menggunakan fungsi bawaan pada codeigniter 4 ini dalam melakukan operasi CRUD nya.

### Soal 3: **API Development**
Dalam pengembangan API, disini saya menggunakan library `firebase/php-jwt` untuk JWT nya. Sama seperti Soal nomor 2, tidak ada yang spesial disini, saya hanya menggunakan fungsi bawaan codeigniter 4 dan juga sedikit bereksperiman menggunakan `Resource Controller`, jadi saya tidak perlu menuliskan Route nya satu persatu, sudah lengkap dengan CRUD nya.
Untuk collection yang saya buat bisa diakses [disini](https://universal-flare-400662.postman.co/workspace/test-interview-ministry-finance~4a184985-b906-42da-9856-cfd2e8b13361/documentation/17690728-12303f8f-6e62-46b8-8a7f-9cce2be142e6) . Keamanan yang saya buat adalah mengenkripsi payload token sebelum digenerate menjadi JWT Token ketika berhasil login. Jadi ketika token tersebut didecode menggunakan tools seperti `Jwt.io`, yang dihasilkan adalah sebuah objek berisi data user namun sudah terenkripsi. Saya membuat fungsi enkripsi tersebut ada di [EncryptionHelper.php](https://github.com/harysusilo50/interviewTest/blob/master/app/Libraries/EncryptionHelper.php)

### Soal 4: **Penggunaan API**
Pengunaan API dan diolah menjadi datatable disini saya berniat untuk menggunakan cURL yang dieksekusi langsung di fungsi [`datatableServerSide()`](https://github.com/harysusilo50/interviewTest/blob/master/app/Controllers/ProductController.php#L65). Karena untuk beberapa kasus ketika consume API dari sisi client terkena CORS Policy. Namun untuk soal ini belum saya selesaikan dikarenakan waktu yang sudah melewati batas yang ditentukan.

#### Terima kasih atas kesempatan interview dan test yang diberikan. Ini adalah sebuah pengalaman dan evaluasi bagi saya untuk meningkatkan kemampuan saya dalam membuat sebuah sistem
