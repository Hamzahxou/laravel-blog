<?php

namespace Database\Seeders;

use App\Models\Resep;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ResepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user_1 = User::create([
            'username' => 'hamzahxou',
            'name' => 'Hamzah',
            'email' => 'hamzahxou@gmail.com',
            'password' => 'hamzahxou',
        ]);

        Resep::create([
            'nama_resep' => 'nasi goreng rendang pedas',
            'deskripsi' => 'nasi goreng rendang pedas mudah dan praktis dibuat dengan resep yang mudah dibuat dan bersih. Semua resep ini bisa dibuat dengan bahan-bahan yang ada di dalam resep ini. Resep ini bisa dibuat dengan bahan-bahan yang ada di dalam resep ini.',
            'gambar' => '1727498806_nasi-goreng.jpg',
            'content' => '<div><strong>Bahan-bahan:</strong></div><ul><li>100 gr daging ayam, dipotong dadu</li><li>100 gr udang, dikupas dari kulitnya</li><li>100 gr mi kuning</li><li>100 gr tauge</li><li>3 porsi nasi putih</li><li>3 butir telur ayam, dikocok lepas</li><li>3 siung bawang merah, dicincang halus</li><li>3 siung bawang putih, dicincang halus</li><li>3 sdm kecap manis</li><li>2 sdm saus tiram</li><li>1 sdm kecap asin</li><li>1 sdm saus cabai</li><li>1/2 sdt merica bubuk</li><li>1/2 bagian kol, diiris tipis</li><li>1 buah wortel ukuran sedang, dipotong dadu</li><li>garam secukupnya minyak goreng secukupnya</li></ul><div><strong>Cara membuat:</strong></div><ol><li>Panaskan wajan dan tuang</li><li>minyak goreng secukupnya.</li><li>Tumis bawang putih dan bawang merah yang telah dicincang hingga harum.</li><li>Masukkan daging ayam yang sudah dipotong-potong dan udang, lalu tumis hingga matang.</li><li>Tambahkan potongan wortel dan irisan kol ke dalam wajan, tumis hingga layu.</li><li>Kemudian, masukkan tauge bersama mi kuning dan aduk hingga semuanya tercampur merata.</li><li>Selanjutnya, tambahkan kecap manis, saus tiram, saus cabai, merica bubuk, garam, dan kecap asin ke dalam tumisan.</li><li>Masukkan nasi dan aduk semuanya hingga merata dengan bahan-bahan lainnya hingga matang.</li><li>Angkat nasi goreng dari wajan dan sajikan bersama taburang bawang goreng.</li></ol>',
            'status' => 'publish',
            'user_id' => $user_1->id,
        ]);
        $user_2 = User::create([
            'username' => 'Yusuf',
            'name' => 'Yusuf',
            'email' => 'yusuf@gmail.com',
            'password' => 'yusuf',
        ]);

        Resep::create([
            'nama_resep' => 'Tumis Tempe',
            'deskripsi' => 'Untuk hidangan praktis dan ekonomis, coba resep tumis tempe kecap sederhana ala rumahan ini. Dengan rasa yang lezat dan mudah dibuat, tumis tempe ini bisa jadi andalan di setiap menu.
Nikmati tempe yang kaya rasa ini sebagai lauk pendamping yang sempurna, cocok dipadukan dengan sup atau sayuran tumis.',
            'gambar' => '1727586358_tumis-tempe-kecap-manis-1-510x306.jpg',
            'content' => '<div><strong>Bahan</strong></div><div><br></div><ul><li>300g tempe, potong dadu 2 cm</li><li>6 butir bawang merah, iris tipis</li><li>3 siung bawang putih, iris tipis</li><li>2 buah cabai merah, potong serong</li><li>2 buah cabai hijau, potong serong</li><li>2 cm lengkuas, memarkan</li><li>1 lembar daun salam</li><li>1 sdt <a href="https://www.masakapahariini.com/produk/royco-kaldu-ayam/">Royco Kaldu Ayam</a></li><li>2 sdm <a href="https://www.masakapahariini.com/produk/kecap-bango-manis/">Bango Kecap Manis</a></li><li>4 sdt merica putih bubuk</li><li>100 ml air</li><li>4 minyak, untuk menggoreng</li></ul><div><br><strong>Cara membuat</strong></div><div><br>1 Panaskan minyak, goreng tempe hingga setengah matang. Angkat dan tiriskan, sisihkan.</div><div><br>2 Panaskan 2 sdm minyak, tumis bawang merah dan bawang putih hingga harum. Masukkan cabai merah, cabai hijau, lengkuas, dan daun salam. Tumis hingga matang.</div><div><br>3 Masukkan tempe, air, <a href="https://www.masakapahariini.com/produk/royco-kaldu-ayam/"><strong>Royco Kaldu Ayam</strong></a><strong>,</strong> dan <a href="https://www.masakapahariini.com/produk/kecap-bango-manis/"><strong>Bango Kecap Manis</strong></a>.</div><div><br>4 Tuang air, aduk rata. Masak hingga meresap. Angkat, sajikan.</div>',
            'status' => 'publish',
            'user_id' => $user_2->id,
        ]);
    }
}
