Q07.Membuat web aplikasi sistem pemesanan makanan dengan framework Laravel/ Codeigniter. Ketentuan:

1. Baik Pelayan/Kasir harus login terlebih dahulu untuk bisa menggunakan aplikasinya dan direcord setiap aktifitasnya
    * Record using helper with Log Eloquent to connect to Log DB (for global logging and all stored in DB)
    * Login basic with CSRF but sometimes need to do php artisan cache:clear to prevent 419 page expired or bypass to home and you've been authenticated if the credentials you use (employeeID and password) is correct

2. Pelayan bertugas untuk membuat pesanan baru yang berisi data nomor meja pelanggan,makanan dan minuman yang tersedia dari daftar menu
    * with eloquent model Item to connect to database of item (food and beverage in one DB)
    * table number will be stored to database of Orders (with eloquent model Order)

3. Pelayan hanya bisa memasukan item di daftar menu yang statusnya “Ready” saja
    * filtered from DB so items with status != ready won't go into apps

4. Setiap pesanan mempunyai nomer pesanan dengan format: ABCTGLBLNTAHUN-NOMOR
    * formatted using jquery, sent to form input using jquery

5. Pelayan ataupun Kasir bisa melihat semua daftar pesanan yang masih aktif
    * all closed orders won't go into apps

6. Pelayan ataupun Kasir bisa menambah/mengurangi/mengubah pesanan yang masih aktif
    * quite ambigue but I choose the safe road, with validation in the blade I hide the button to waiter that is not taking the order, but cashier and the original order taker still can edit the active orders, this is to keep clean the responsibilities of each employee

7. Hanya Kasir yang bisa memproses pembayaran dan menutup pesanan yang masih aktif
    * protected with middleware('auth') basic from laravel but ensure that is_cashier (from DB) is true to show them the button of closing transaction

8. Pelayan hanya bisa melihat/mencetak aktifitas pesanan miliknya saja sebagai laporan ke manager
    * all users log is in /activities route

9. Web aplikasi user friendly digunakan menggunakan PC browser ataupun mobile browser
    * using tailwindCSS even though it is quite hard to make the table-like apps to be responsive, I have a greater idea for the responsive design but I choose to make the one that I have made first due to the time

10. Kirim file program beserta databasenya ke email hendra.dp.mri@gmail.com selambatnya pada 2x24 jam setelah Anda menyelesaikan tes online ini.
    * database will be in sql folder

11. Harap sertakan informasi user & password yang digunakan untuk login ke aplikasi di text file
    * user 1
        * credentials
            * employeeID: "JDO"
            * password: password
        * information
            * role: cashier
            * name: John Doe
    * user 2
        * credentials
            * employeeID: "MIC"
            * password: password
        * information
            * role: waiter
            * name:  Michael
    * user 3
        * credentials
            * employeeID: "EVA"
            * password: password
        * information
            * role: waiter
            * name:  Eva
