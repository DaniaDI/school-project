<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Grade;
use App\Models\Lecture;
use App\Models\Section;
use App\Models\Stage;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Stage::create([
        //    'name' =>'المرحلة الابتدائية',
        //    'tag' =>'p' ,
        // ]);
        // Stage::create([
        //     'name' =>'المرحلة الاعدادية',
        //     'tag' =>'m' ,
        //  ]);
        //  Stage::create([
        //     'name' =>'المرحلة الثانوية',
        //     'tag' =>'H' ,
        //  ]);

        //    $stagep = Stage::getIdByTag('H');
        //     Grade::create([
        //         'name' => 'الصف الثاني عشر' ,
        //          'tag' => '12' ,//tag grade = 1,2,3,4,5,6 for stage p
        //          'stage_id' => $stagep ,

        //    ]);

        // Section::create([
        //     'name' => '7',
        // ]);

        //   User::create([

        //    'email'=>'afnan2000@gmail.com',
        //     'password'=>Hash::make('0599668141'),

        //    ]);

        //         Teacher::create([

        //             'name' =>  'afnan',
        //             'phone' => '0599668141' ,
        //             'hire_date' => '2025-06-06',
        //             'date_of_birth' =>' 2002-01-18',
        //             'qualification' => 'Bachelors',
        //             'spec' =>' computer Engineering',
        //             'gender' => 'fm',
        // 'user_id'=>'12',

        //         ]);


        //
        // $user = User::where('email', 'admin@admin.com')->first();

        // if (!$user) {
        //     $user = User::create([
        //         'email' => 'admin@admin.com',
        //         'password' => Hash::make('admin12345'),
        //         'role' => 'admin',
        //     ]);
        // } else {
        //     $user->update(['role' => 'admin']); // تأكد أن له الصلاحية
        // }
        // $user = User::create([

        //     'email' => 'afnan@exxgmail.com',
        //     'password' => Hash::make('0599664441'),
        //     'role' => 'teacher',
        // ]);

        // $teacher = Teacher::create([
        //     'name' =>  'afnan',
        //     'phone' => '0599664441',
        //     'hire_date' => '2025-07-06',
        //     'date_of_birth' => ' 2002-03-18',
        //     'qualification' => 'Bachelors',
        //     'spec' => 'math',
        //     'gender' => 'fm',
        //     'user_id' => '17',
        // ]);

        // $subject = Subject::create([
        //     'title' => 'رياضيات',
        //     'book' => ' كتاب الرياضيات ',
        //     'teacher_id' => $teacher,
        //     'grade_id' => '4',

        // ]);



        // Lecture::create([
        //     'title' => 'first lect',
        //     'subject_id' => $subject,
        //     'teacher_id' => $teacher,
        //     'description' => 'helllllllooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooo',
        //     'link' => 'https://www.youtube.com/watch?v=wyNdsIatYZw',

        // ]);
    }
}
