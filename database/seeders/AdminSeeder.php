<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Course;
use App\Models\CourseClass;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@kampus.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Dosen
        User::create([
            'name' => 'Budi Dosen',
            'username' => 'dosen',
            'email' => 'dosen@kampus.com',
            'password' => Hash::make('password'),
            'role' => 'dosen',
        ]);

        // Mahasiswa
        User::create([
            'name' => 'Andi Mahasiswa',
            'username' => 'mahasiswa',
            'email' => 'mahasiswa@kampus.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa',
        ]);

        // Sample Course & Class
        $course = Course::create([
            'code' => 'IFB-101',
            'name' => 'Algoritma Pemrograman',
            'department' => 'Informatika'
        ]);

        CourseClass::create([
            'course_id' => $course->id,
            'name' => 'IF-A',
            'enrollment_key' => '12345',
            'academic_year' => '2025/2026'
        ]);
    }
}
