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

            $nameNode = $node->filter('th')->first();
            $numberNode = $nameNode->filter('a')->last();

            if ($nameNode->count() && $numberNode->count()) {
                // Extract English name
                $nameParts = explode('<br>', $nameNode->html());
                $name = strip_tags($nameParts[0]);

                // Extract number and remove brackets
                $number = trim($numberNode->text(), '()');

                Pokemons::create([
                    'number' => $number,
                    'name' => $name,
                ]);
            }
        });

        $this->command->info('Pokemons table seeded!');
    }
}
