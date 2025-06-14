<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BeautyArticle;

class BeautyArticlesSeeder extends Seeder
{
    public function run()
    {
        $articles = [
            [
                'title' => '8 Rahasia Kecantikan ala Cewek Korea',
                'thumbnail_url' => 'https://cdn1-production-images-kly.akamaized.net/imhzMKwyVu_4fmx83CV4Yv40gf4=/45x90:640x425/640x360/filters:quality(75):strip_icc():format(webp)/kly-media-production/medias/4199650/original/013720200_1666374910-308700955_645134540478207_365860316243996292_n.jpg',
                'article_url' => 'https://www.liputan6.com/citizen6/read/5112501/mau-tahu-ini-8-rahasia-kecantikan-ala-cewek-korea?page=2'
            ],
            [
                'title' => 'Rekomendasi Buah yang Bagus untuk Kulit',
                'thumbnail_url' => 'https://www.eminacosmetics.com/cfind/source/thumb/images/new-folder/cover_w1920_h895_foto_artikel-rekomendasi-buah.jpeg',
                'article_url' => 'https://www.eminacosmetics.com/index.php/agar-sehat-dan-cantik-jangan-lupa-makan-rekomendasi-buah-yang-bagus-untuk-kulit'
            ],
            [
                'title' => 'Cantik Natural ala Iroha Illit: Skincare Rutin yang Wajib Kamu Coba',
                'thumbnail_url' => 'https://assets.pikiran-rakyat.com/crop/0x0:0x0/720x0/webp/photo/2024/12/01/1805364551.jpg',
                'article_url' => 'https://jurnalgaya.pikiran-rakyat.com/entertainment/pr-808832164/cantik-natural-ala-iroha-illit-skincare-rutin-yang-wajib-kamu-coba'
            ],
            [
                'title' => '8 Inspirasi Warna Rambut ala Member TWICE',
                'thumbnail_url' => 'https://akcdn.detik.net.id/visual/2021/12/04/twicefoto-instagramcomtwicetagram_169.jpeg?w=700&q=90',
                'article_url' => 'https://www.beautynesia.id/beauty/8-inspirasi-warna-rambut-ala-member-twice-salah-satunya-diprediksi-jadi-trend-di-2022/b-243074'
            ],
            [
                'title' => '18 Model Rambut Pria Korea Terlengkap',
                'thumbnail_url' => 'https://gatsby.co.id/_next/image?url=https%3A%2F%2Fbackendprod.gatsby.co.id%2Fstorage%2Farticle%2F18%20Model%20Rambut%20Pria%20Korea%20Terpopuler%20yang%20Bikin%20Lo%20Ganteng%20Maksimal.jpg&w=2048&q=100',
                'article_url' => 'https://gatsby.co.id/article/18-model-rambut-pria-korea-terlengkap-2021-wajib-lo-coba'
            ],
            [
                'title' => 'Inspirasi Makeup Nongkrong ala Greesella JKT48',
                'thumbnail_url' => 'https://image.idntimes.com/post/20240110/photogrid-plus-1704864419815-3f0d644dc0e42d40ccd4160f972c21ed-a19a0803e0ac4d373accfbb84db7b906.jpg?tr=w-1920,f-webp,q-75&width=1920&format=webp&quality=75',
                'article_url' => 'https://www.idntimes.com/life/women/inspirasi-makeup-nongkrong-ala-greesella-jkt-48-c1c2-01-fkmt4-rhhvq1'
            ]
        ];

        // Hapus data lama sebelum menambahkan yang baru
        BeautyArticle::truncate();
        
        foreach ($articles as $article) {
            BeautyArticle::create($article);
        }
    }
} 