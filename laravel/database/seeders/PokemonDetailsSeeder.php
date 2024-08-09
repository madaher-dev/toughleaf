<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Models\Pokemons;
use Illuminate\Support\Facades\DB;

class PokemonDetailsSeeder extends Seeder
{
    public function run()
    {
        // Set up an HTTP client to fetch the Pokémon list from Wikipedia.
        $client = new Client();
        $response = $client->get('https://en.wikipedia.org/wiki/List_of_generation_I_Pok%C3%A9mon');
        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);

        // Start a transaction to ensure data integrity.
        DB::beginTransaction();

        try {
            // Process each row in the Pokémon table, skipping the header.
            $crawler->filter('.wikitable.sortable.plainrowheaders tr')->each(function (Crawler $node, $i) use ($client) {
                if ($i == 0) return; // Skip the header row.

                $nameNode = $node->filter('th')->first();
                if ($nameNode->filter('a')->count() && str_contains($nameNode->filter('a')->attr('href'), '/wiki/')) {
                    $name = trim($nameNode->filter('a')->text());
                    $number = trim($nameNode->filter('a')->last()->text(), '()');
                    $detailsUrl = 'https://en.wikipedia.org' . $nameNode->filter('a')->attr('href');

                    // Fetch and parse the detailed Pokémon page.
                    $details = $this->scrapePokemonDetails($client, $detailsUrl);

                    // Find existing Pokémon entry by number.
                    $pokemon = Pokemons::where('number', $number)->first();
                    if ($pokemon) {
                        // Update Pokémon details if it already exists in the database.
                        $pokemon->update([
                            'image' => $details['image'],
                            'first_game' => $details['first_game'],
                            'designed_by' => $details['designed_by'],
                            'species' => $details['species'],
                    
                        ]);
                    }
                }
            });

            // Commit the transaction to save changes.
            DB::commit();
        } catch (\Exception $e) {
            // Roll back the transaction on any error to avoid partial updates.
            DB::rollBack();
            throw $e; // Optionally re-throw the exception to handle it elsewhere.
        }
    }

    private function scrapePokemonDetails($client, $url)
    {
        // Fetch the individual Pokémon page and parse needed details.
        $response = $client->get($url);
        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);

        return [
            'image' => $crawler->filter('.infobox .infobox-image img')->count() ? $crawler->filter('.infobox .infobox-image img')->attr('src') : null,
            'first_game' => $crawler->filter('.infobox .infobox-label:contains("First game") + .infobox-data')->count() ? $crawler->filter('.infobox .infobox-label:contains("First game") + .infobox-data')->text() : null,
            'designed_by' => $crawler->filter('.infobox .infobox-label:contains("Designed by") + .infobox-data')->count() ? $crawler->filter('.infobox .infobox-label:contains("Designed by") + .infobox-data')->text() : null,
            'species' => $crawler->filter('.infobox .infobox-label:contains("Species") + .infobox-data')->count() ? $crawler->filter('.infobox .infobox-label:contains("Species") + .infobox-data')->text() : null,
        ];
    }
}
