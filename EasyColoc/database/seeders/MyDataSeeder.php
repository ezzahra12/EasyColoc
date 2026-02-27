<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Colocation;
use App\Models\Expense;
use App\Models\Category;

class MyDataSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'blnfatima64@gmail.com'],
            ['name' => 'Fatima', 'password' => bcrypt('password')]
        );

        $colocs = Colocation::factory(3)->create([
    'name' => 'Carter Group',
    'owner_id' => $user->id
]);

        foreach ($colocs as $coloc) {
            $coloc->users()->attach($user->id, [
                'role' => 'owner',
                'joined_at' => now(),
            ]);

            $members = User::factory(rand(2,3))->create();
            foreach ($members as $member) {
                $coloc->users()->attach($member->id, [
                    'role' => 'member',
                    'joined_at' => now(),
                ]);
            }
         $categories = Category::factory(3)->create([
        'colocation_id' => $coloc->id
    ]);

            $allMembers = $coloc->users;
            foreach (range(1, rand(5,10)) as $i) {
                $payer = $allMembers->random();
                Expense::factory()->create([
                    'colocation_id' => $coloc->id,
                    'payer_id' => $payer->id,
                    'category_id' => $categories->random()->id,
                    'title' => 'Expense ' . ($i+1),
                    'amount' => rand(10, 500),
                    'date' => now(),
                ]);
            }
        }
    }
}
