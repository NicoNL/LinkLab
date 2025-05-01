<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Subject;
use App\Models\Task;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class LmsSeeder extends Seeder
{

    public function run(): void
    {
        $teacher1 = User::create([
            'name' => 'Nagy Brandi',
            'email' => 'nagybrandi@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        $teacher2 = User::create([
            'name' => 'Teacher Sample',
            'email' => 'teacher@example.com',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        $subject1 = Subject::create([
            'name' => 'Programming',
            'description' => 'Learn the basics of programming',
            'code' => 'IK-AAA111',
            'credit' => 3,
            'teacher_id' => $teacher1->id,
        ]);

        $subject2 = Subject::create([
            'name' => 'Web Development',
            'description' => 'Learn how to build web applications',
            'code' => 'IK-BBB222',
            'credit' => 5,
            'teacher_id' => $teacher1->id,
        ]);

        $subject3 = Subject::create([
            'name' => 'Databases',
            'description' => 'Learn about databases',
            'code' => 'IK-CCC333',
            'credit' => 4,
            'teacher_id' => $teacher2->id,
        ]);

        Task::create([
            'name' => 'Hello World Program',
            'description' => 'Write a program that prints "Hello, World" to the console.',
            'points' => 5,
            'subject_id' => $subject1->id,
        ]);

        Task::create([
            'name' => 'Bomberman',
            'description' => 'Create a game like the classic bomberman using Java.',
            'points' => 10,
            'subject_id' => $subject1->id,
        ]);

        Task::create([
            'name' => 'Create a Book Store',
            'description' => 'Build a simple website using PHP',
            'points' => 8,
            'subject_id' => $subject2->id,
        ]);

        Task::create([
            'name' => 'SQL Query',
            'description' => 'Write SQL query to retrieve data from a database.',
            'points' => 12,
            'subject_id' => $subject3->id,
        ]);

        $student1 = User::create([
            'name' => 'Nicolas Nino',
            'email' => 'nicolas@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        $student2 = User::create([
            'name' => 'Student Sample',
            'email' => 'student@example.com',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);

        $student1->studentSubjects()->attach([$subject1->id, $subject2->id]);
        $student2->studentSubjects()->attach([$subject1->id, $subject3->id]);
    }
}
