<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Pokemons;

class PokemonsTableSeeder extends Seeder
{
    public function run()
    {
        // Delete all existing data
        Pokemons::truncate();

        // Scrape data from Wikipedia
        $client = new Client();
        $response = $client->get('https://en.wikipedia.org/wiki/List_of_generation_I_Pok%C3%A9mon');
        $html = $response->getBody()->getContents();

        $crawler = new Crawler($html);

        $crawler->filter('.wikitable.sortable.plainrowheaders tr')->each(function (Crawler $node, $i) {
            if ($i == 0) return; // Skip the header row

            $id = $node->attr('id'); // Extract the name directly from the row's ID attribute
            $cells = $node->filter('td, th')->each(function (Crawler $cellNode) {
                return $cellNode->text();
            });

            if (!isset($id) || empty($id)) {
                return; // Skip rows without a proper ID
            }

            $name = ucfirst($id); // Capitalize the first letter to standardize the name format

            // Extract number from the first link in the row, if it exists
            $number = $node->filter('th a')->last()->text();
            $number = preg_replace('/[^0-9]/', '', $number); // Ensure it's only digits

            // Type might be in different cells depending on the table structure
            $type = isset($cells[2]) ? $cells[2] : 'Unknown';

            // Notes are typically in the last cell
            $notes = end($cells);

            // Save to the database
            Pokemons::create([
                'number' => $number,
                'name' => $name,
                'type' => $type,
                'notes' => $notes,
            ]);

         
        });

        $this->command->info('Pokemons table seeded!');
    }
}
