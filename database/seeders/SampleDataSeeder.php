<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SampleDataSeeder extends Seeder {
    public function run(){
        // create admin user (password: password)
        if(!User::where('email','admin@example.com')->exists()){
            User::create([
                'name'=>'Admin',
                'email'=>'admin@example.com',
                'password'=>Hash::make('password'),
                'role'=>'admin'
            ]);
        }

        Product::create([
            'name'=>'Sample Product 1',
            'description'=>'A sample product',
            'price'=>99.99,
            'stock_quantity'=>10,
        ]);
        Product::create([
            'name'=>'Sample Product 2',
            'description'=>'Another sample product',
            'price'=>49.50,
            'stock_quantity'=>5,
        ]);
    }
}
