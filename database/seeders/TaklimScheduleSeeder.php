<?php

namespace Database\Seeders;

use App\Models\TaklimSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TaklimScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schedules = [
            [
                'title' => 'Kajian Tafsir Al-Quran',
                'description' => 'Kajian tafsir Al-Quran surat Al-Baqarah dengan pembahasan mendalam tentang hukum-hukum Islam.',
                'ustad_name' => 'Ustadz Abdullah Hakim',
                'mosque_name' => 'Masjid Al-Ikhlas',
                'mosque_address' => 'Jl. Raya Sudirman No. 123, Jakarta Pusat',
                'mosque_city' => 'Jakarta',
                'schedule_date' => Carbon::now()->addDays(2)->setTime(19, 0),
                'start_time' => '19:00:00',
                'end_time' => '20:30:00',
                'frequency' => 'weekly',
                'category' => 'Tafsir',
                'is_active' => true,
                'contact_person' => 'Pak Ahmad',
                'contact_number' => '081234567890',
            ],
            [
                'title' => 'Kajian Hadits Shahih Bukhari',
                'description' => 'Kajian kitab Shahih Bukhari dengan fokus pada hadits-hadits tentang akhlak.',
                'ustad_name' => 'Ustadz Muhammad Rizki',
                'mosque_name' => 'Masjid Nurul Huda',
                'mosque_address' => 'Jl. Merdeka No. 45, Bandung',
                'mosque_city' => 'Bandung',
                'schedule_date' => Carbon::now()->addDays(5)->setTime(20, 0),
                'start_time' => '20:00:00',
                'end_time' => '21:00:00',
                'frequency' => 'weekly',
                'category' => 'Hadits',
                'is_active' => true,
                'contact_person' => 'Pak Yusuf',
                'contact_number' => '082345678901',
            ],
            [
                'title' => 'Fiqih Ibadah Sehari-hari',
                'description' => 'Pembahasan fiqih praktis tentang thaharah, shalat, dan puasa.',
                'ustad_name' => 'Ustadz Ahmad Fauzi',
                'mosque_name' => 'Masjid Ar-Rahman',
                'mosque_address' => 'Jl. Gatot Subroto No. 67, Surabaya',
                'mosque_city' => 'Surabaya',
                'schedule_date' => Carbon::now()->addDays(1)->setTime(18, 30),
                'start_time' => '18:30:00',
                'end_time' => '19:30:00',
                'frequency' => 'weekly',
                'category' => 'Fiqih',
                'is_active' => true,
                'contact_person' => 'Bu Fatimah',
                'contact_number' => '083456789012',
            ],
            [
                'title' => 'Kajian Akhlak dan Tasawuf',
                'description' => 'Kajian tentang pembersihan hati dan akhlak mulia dalam Islam.',
                'ustad_name' => 'Ustadz Hassan Ibrahim',
                'mosque_name' => 'Masjid Al-Hidayah',
                'mosque_address' => 'Jl. Ahmad Yani No. 89, Yogyakarta',
                'mosque_city' => 'Yogyakarta',
                'schedule_date' => Carbon::now()->addDays(3)->setTime(19, 30),
                'start_time' => '19:30:00',
                'end_time' => '21:00:00',
                'frequency' => 'weekly',
                'category' => 'Akhlaq',
                'is_active' => true,
                'contact_person' => 'Pak Ibrahim',
                'contact_number' => '084567890123',
            ],
            [
                'title' => 'Sirah Nabawiyah',
                'description' => 'Kajian sejarah kehidupan Rasulullah SAW dan para sahabat.',
                'ustad_name' => 'Ustadz Khalid Rahman',
                'mosque_name' => 'Masjid Jami Al-Furqan',
                'mosque_address' => 'Jl. Diponegoro No. 12, Semarang',
                'mosque_city' => 'Semarang',
                'schedule_date' => Carbon::now()->addDays(7)->setTime(20, 0),
                'start_time' => '20:00:00',
                'end_time' => '21:30:00',
                'frequency' => 'monthly',
                'category' => 'Sirah',
                'is_active' => true,
                'contact_person' => 'Pak Usman',
                'contact_number' => '085678901234',
            ],
            [
                'title' => 'Kajian Aqidah Islam',
                'description' => 'Pembahasan tentang dasar-dasar aqidah Islam yang benar.',
                'ustad_name' => 'Ustadz Zainuddin Ali',
                'mosque_name' => 'Masjid Baiturrahman',
                'mosque_address' => 'Jl. Pahlawan No. 34, Medan',
                'mosque_city' => 'Medan',
                'schedule_date' => Carbon::now()->addDays(4)->setTime(19, 0),
                'start_time' => '19:00:00',
                'end_time' => '20:00:00',
                'frequency' => 'weekly',
                'category' => 'Aqidah',
                'is_active' => true,
                'contact_person' => 'Bu Aisyah',
                'contact_number' => '086789012345',
            ],
        ];

        foreach ($schedules as $schedule) {
            TaklimSchedule::create($schedule);
        }
    }
}
