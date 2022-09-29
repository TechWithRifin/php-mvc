--Sejarah mvc

1. MVC adalah singkatan dari model view dan controller. MVC adalah salah satu software design pattern yang banyak digunakan ketika pengembangan aplikasi berbasis user interface (ada tampilannya)
2. Dulunya MVC ini banyak digunakan di aplikasi berbasis desktop, Namun sekarang MVC sudah banyak diadobsi di dunia web (banyak framework yang mengadopsi design pattern dari mvc)
3. Bahkan saat ini, design pattern MVC ini sudah banyak berkembang. Contohnya ada hierarchical model view controller (HMVC), ada model view adapter (MVA), ada model view presenter (MVP), ada model view viewmodel (MVVM), dan lain sebagainya

--Model View Controller

1. seperti singkatannya, MVC itu dibagi menjadi tiga bagian yaitu :
2. Model merupakan bagian yang merepresentasikan data (data itu disebut model). Seperti yang kita ketahui ada banyak sekali jenis data. Misalnya ada data request yang dikirim dari user, ada data response yang diterima oleh user, ada data yang berupa tabel (jika kita menggunakan database), dan lain-lain (pokoknya semua data dinamakan model). Sehingga karena jenis data itu banyak, kadang-kadang kita perlu memperkecil lagi scope dari model itu sendiri ketika kita membuat aplikasi. Maka dari itu, kita perlu memisahkan model berdasarkan jenis datanya. Misal kita memisahkan antara model representasi dari tabel dan model representasi dari response.
3. view merupakan bagian yang merepresentasikan tampilan atau ui (yang berhubungan dengan user interface). Misalnya halaman web, desktop, mobile dan lain sebagainya
4. controller merupakan bagian yang mengurus alur kerja dari menerima input data, memanipulasi data lalu kita masukkan kedalam model,kemudian kita tampilkan ke dalam view. Jadi semua logic dari aplikasi itu adanya didalam controller. anggap saja controller itu merupakan core logic dari aplikasi kita

--Alur kerja dari MVC

1. user mengirim request ke controller
2. kemudian controller melakukan logic
3. lalu controller mengolah data model
4. selanjutnya controller akan mengirimkan hasil data model yang sudah diolah ke view untuk dijadikan tampilan
5. kemudian tampilan dari view tersebut akan dirender oleh controller
6. kemudian hasil render dari tampilan view akan dibalikkan kepada user oleh controller dalam bentuk response

--MVC Pada Kenyataanya

1. walaupun sekilas alur kerja dari MVC sangat sederhana, Namun pada kenyataannya ketika kita membuat aplikasi yang sangat kompleks, kita biasanya tidak bisa memanfaatkan hanya sekedar MVC saja
2. Kadang-kadang kita butuh mengimplementasikan design pattern / software pattern yang lainnya. Misalnya mengimplemetasikan service pattern supaya controller tidak gemuk kita pisahkan logicnya ke bagian service. Kadang kadang diservice kita kebanyakan query database yang nantinya service kita gemuk juga kodenya karena kebanyakan query. Untuk itu kita bisa mengimplementasikan repository pattern supaya kita bisa menyimpan semua query ke database didalam repository. dan lain-lain
3. Jadi saat nanti kita membuat aplikasi yang kompleks, pada kenyataannya nanti kita akan melakukan improfisasi dan tidak hanya cuma mengandalkan MVC saja
4. oleh karena itu, jangan terlalu terpaku pada satu pattern saja. Jikalau kita bisa mengkombinasikan beberapa pattern agar kode aplikasi kita lebih rapi dan baik, maka disarankan untuk melakukan kombinasi

--Alur Kerja MVC Dengan Kombinasi Pattern Lain

1. user mengirim request ke controller
2. kemudian controller mengelola data web modelnya (contoh web model adalah request dan response)
3. lalu controller akan memanggil service (dimana pada service terdapat core bisnis logic kita)
4. lalu service memanggil repository
5. kemudian repository akan mengelola data entity (entity adalah model dalam MVC tapi tapi berbentuk representasi tabel didalam database)
6. selanjutnya dari entity kembali ke repository
7. dan repository akan kembali ke service
8. dan service akan kembali ke controller
9. lalu data nya dikirim ke view untuk dijadikan tampilan
10. kemudian controller akan merender tampilan dari view
11. kemudian hasil render akan dikirim ke user oleh controller dalam bentuk response

jadi pada kenyataanya alur kerja MVC mungkin bisa seperti diatas

--Public directory

1. Best practice ketika kita membuat web menggunakan php adalah kita tidak mengekspos seluruh kode PHP kita ke webnya karena berbahaya. Jadi yang bahaya itu misalnya kita membuat file home.php. Untuk menjalankanya pada web, kita biasanya akan me njalankan url localhost/home.php. Hal tersebut sangat tidak disarankan karena jika terjadi error pada kode php kita, maka kode kita akan terekspos keluar
2. maka dari itu framework php mvc bisanya membuat directory public dan hanya mengekspos directory tersebut ke web. Jadi ketika kita running webnya, kita akan merunning webnya itu didalam folder public.
3. Jadi folder app, test dan lain-lain itu tidak bisa diakses dari web dan cuma folder public aja yang bisa di akses dari web
4. Tehnik ini biasanya digunakan oleh framework-framework populer seperti codeigniter dan laravel
5. saat nanti kita menjalankan PHP Server, kita akan menjalankannya dari directory public dengan command cd public kemudian jalankan command php -S localhost:8080 didalam directory public, sehingga directory app tidak bisa diakses secara langsung melalu web browser

--PATH_INFO

1. PATH_INFO merupakan key yang terdapat di global variable $\_SERVER
2. PATH_INFO ini adalah informasi path yang terdapat pada URL ketika kita mengakses sebuah file php misalnya :
3. jika kita mengakses URL http://contoh.com/index.php maka tidak ada PATH_INFO
4. jika kita mengakses URL http://contoh.com/index.php/test maka PATH_INFO nya adalah /test
5. jika kita mengakses URL http://contoh.com/index.php/products/123 maka PATH_INFO nya adalah /products/123
6. jika kita mengakses URL http://contoh.com/index.php/category?id=123 maka PATH_INFO nya adalah /category
7. kita bisa mendapatkan PATH_INFO dari sebuah url dengan menulis kode $\_SERVER['PATH_INFO']; didalam sebuah file php

--Untuk Apa PATH_INFO

1. PATH_INFO ini banyak digunakan sebagai URL Routing
2. Artinya saat kita membuat aplikasi PHP, kebanyakan dari kita membuat 1 file untuk 1 URL misalnya contoh.com/index.php , contoh.com/home.php , contoh.com/login.php <- satu file yang dapat menampung 1 url saja (ini tidak wortid)
3. dengan PATH_INFO kita bisa membuat banyak URL hanya dengan 1 file php saja
4. Best practice dalam framework-framework MVC saat ini. biasanya hanya menggunakan 1 file php saja sebagai gerbang masuk kedalam aplikasi kita dan memanfaatkan PATH_INFO sebagai informasi file apa yang nantinya harus kita load

--Router Sederhana

1. apa itu routing? Routing adalah teknik melakukan penentuan rute dari sebuah URL ke file PHP mana yang akan dieksekusi (gampangnya kita harus menentukan kalau URL nya a maka harus mengeksekusi file yang mana, kalau URL nya b maka harus mengeksekusi file yang mana)
2. Secara default routing sebenarnya sudah disiapkan oleh web server, namun routing yang disiapkan oleh web server hanya bisa menggunakan 1 file untuk 1 url saja misal jika kita membuka /index.php maka web server akan mengakses file index.php, jika membuka /user/login.php maka web server akan mengakses file login.php yang ada didalam folder user (itu sudah default bawaan si web servernya)
3. Namun kita tidak akan melakukan hal tersebut karena kita sekarang sudah mengerti tentang PATH_INFO, maka kita akan memanfaatkan si PATH_INFO ini dan kita akan melakukan routing secara manual dari PATH_INFO yang kita dapatkan

--Router yang sebenarnya

1. setelah kita mengerti cara kerja Router, sekarang sudah saatnya kita membuat Router yang lebih kompleks
2. Router yang sudah kita buat sebelumnya sangat lah sederhana, hanya meneruskan PATH_INFO ke file php yang dituju, sedangkan di dalam MVC, tugas Router seharusnya meneruskan PATH_INFO menuju class Controller yang dituju
3. Jadi sekarang kita akan mencoa membuat class Router untuk melakukan management routing nya

--Controller

1. setelah kita selesai membuat Router dan sukses melakukan pemetaan (router mapping) antara path dan http method nya dan juga kita dapatkan controller dan functionnya nya, sekarang saatnya kita membuat class controllernya
2. class controller itu sangat sederhana, class ini merupakan class yang nanti akan digunakan sebagai class yang akan menerima request pertama kali
3. selanjutnya di class controller ini kita bisa melakukan pengolahan logic apapun (gampangnya semua bisnis logic silahkan di implementasikan di controller)

--Path variable

1. saat kita membuat URL, kadang-kadang kita ingin untuk menambahkan data didalam URL nya
2. data yang ditambahkan bukan dalam bentuk query parameter, tetapi langsung didalam URL nya
3. misalnya /product/1234 <- data 1234 ini bisa berubah tergantung id productnya misalnya
4. hal ini dinamakan path variable atau path parameter
5. sekarang pertanyaannya, bagaimana cara supaya router kita mendukung hal tersebut

--Regex

1. salah satu cara supaya bisa membuat path variable adalah menggunakan regex
2. pada path variable ini, kita membutuhkan regex supaya path pada router kita bisa mendukung path variable

--Model

1. Model itu adalah data
2. Saat kita membuat aplikasi, pada kenyataanya banyak sekali jenis data
3. Misalnya ada yang namanya data request (data yang dikirim oleh client), ada data response (data yang diberikan oleh server kepada client), ada data yang ada didalam database dan lain-lain. Jadi intinya model adalah data apapun itu
4. saat ini kita akan membuat data yang sederhana dulu. Tanpa menggunakan database (menggunakan data yang kita masukkan kedalam variable <-ini juga bisa disebut model)
5. Model ini biasanya akan digunakan oleh controller, untuk selanjutnya diberikan ke dalam view

--view

1. View adalah bagian yang berisikan kode untuk response yang kita berikan kepada client. Biasanya didalam view itu isinya hanya template dan tidak ada datanya karena datanya nanti kita isi menggunakan data model
2. kenapa kita tidak meletakkan semua kode user interface dicontroller ? Hal ini dikarenakan supaya controller bisa fokus pada kode logic aplikasi kita. Sedangkan jika kita ingin menampilkan response kita bisa menggunakan view
3. View biasanya tidak memiliki logic yang terlalu rumit, karena tugasnya hanya menampilkan data dari model yang sudah diberikan oleh controller

note : kita sangat tidak disarankan meletakkan logic yang kompleks didalam view seperti misalnya query ke database, logic bisnis, input validation dll (letakkan semua logic didalam controller)

--Middleware

1. Middleware merupakan fitur yang biasanya ada pada framework Web MVC
2. Middleware ini merupakan bagian kode yang dieksekusi sebelum cotroller di eksekusi . Middleware bisa melakukan rejection. jadi kalau misal menerut middlewarenya suatu request tidak valid maka middleware ini bisa menolak request nya sehingga tidak diteruskan ke controller
3. misalnya kita ingin melakukkan pengecekan apakah pengguna suda login atau belum. kalau kita tidak menggunakan middleware, kita harus melakukan pengecekan di semua controller yang sudah dibuat dan itu terlihat lumayan jelek.
4. Dibandingkan kita melakukan pengecekan disetiap controller, lebih baik kita gunakan middleware untuk melakukan hal tersebut
5. Namun sayangnya pada Router yang telah kita buat, masih belum mendukung fitur middleware, sehingga kita perlu untuk menambahkan fitur middleware ini.
