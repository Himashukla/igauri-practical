<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Faker\Factory as FakerFactory;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productNames = [
            "iPhone 13 Pro",
            "Samsung Galaxy S21",
            "Sony 65-inch 4K OLED TV",
            "Apple MacBook Air",
            "Bose QuietComfort 45 Headphones",
            "Sony PlayStation 5",
            "Nikon D850 DSLR Camera",
            "Dyson V11 Absolute Vacuum Cleaner",
            "Cuisinart 14-Cup Coffee Maker",
            "KitchenAid Stand Mixer",
            "Fitbit Versa 3 Smartwatch",
            "Weber Genesis II E-310 Grill",
            "Samsonite Winfield 3 Luggage Set",
            "Dell XPS 13 Laptop",
            "iRobot Roomba 960 Robot Vacuum",
        ];
        $faker = FakerFactory::create();


        foreach($productNames as $name){
            $sku = $this->generateRandomSKU(11);

            Product::create([
                'SKU' => $sku,
                'image' => $faker->imageUrl(),
                'name' => $name,
                'description' => $faker->paragraph(3),
                'retail_price' => $faker->randomFloat(2, 450, 500),
                'our_price' => $faker->randomFloat(2, 400, 449),
            ]);
        }
    }

    /**
     * This function generates random SKU for a product.
     * 
     * @param int $length length of a SKU.
     * @return strings return randomly generated SKU
     */
    private function generateRandomSKU($length)
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $sku = '';

        for ($i = 0; $i < $length; $i++) {
            $randomChar = $characters[rand(0, strlen($characters) - 1)];
            $sku .= $randomChar;
        }

        //place - in the SKU string
        $sku = substr_replace($sku, '-', 5, 1);

        return $sku;
    }
}
