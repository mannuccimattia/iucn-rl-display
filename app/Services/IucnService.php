<?php

namespace App\Services;

use App\DTOs\TaxonDetailDTO;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class IucnService
{
    protected string $token;
    protected string $baseUrl;

    public function __construct()
    {
        $this->token = config('services.iucn.key');
        $this->baseUrl = config('services.iucn.base_url');
    }

    /**
     * Get the list of systems.
     */
    public function getSystems(): array
    {
        return Cache::remember('iucn_systems', 3600, function () {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->get("$this->baseUrl/systems");

            if ($response->successful()) {
                return $response->json()['systems'] ?? [];
            }

            return [];
        });
    }

    /**
     * Get the list of countries.
     */
    public function getCountries(): array
    {
        return Cache::remember('iucn_countries', 3600, function () {
            $response = Http::withHeaders([
                'Authorization' => $this->token,
            ])->get("$this->baseUrl/countries");

            if ($response->successful()) {
                return $response->json()['countries'] ?? [];
            }

            return [];
        });
    }

    /**
     * Get the latest assessments for a given system.
     */
    public function getLatestAssessments(string $type, string $code): array
    {
        $cacheName = 'iucn_latest_' . $type . '_' . $code;

        return Cache::remember($cacheName, 300, function () use ($type, $code) {
            $response = Http::withToken($this->token)
                ->get("$this->baseUrl/$type/$code");

            if ($response->successful()) {
                return $response->json() ?? [];
            }

            return [];
        });
    }

    /**
     * Get mockup taxa data.
     */
    private function getMockData(): array
    {
        return [
            3855 => [
                'scientific_name' => 'Carcharodon carcharias',
                'common_names' => [
                    ['name' => 'Squalo Bianco', 'main' => true],
                    ['name' => 'Great White Shark', 'main' => false],
                    ['name' => 'Lorem ipsum dolor', 'main' => false],
                ],
            ],
            18588 => [
                'scientific_name' => 'Balaenoptera musculus',
                'common_names' => [
                    ['name' => 'Balenottera Azzurra', 'main' => true],
                    ['name' => 'Nome comune 2', 'main' => false],
                ],
            ],
        ];
    }

    /**
     * Get mockup taxon detail.
     */
    public function getTaxonDetail(int $sis_taxon_id): TaxonDetailDTO
    {
        $allData = $this->getMockData();

        $species = $allData[$sis_taxon_id] ?? [
            'scientific_name' => "Specie Ignota #$sis_taxon_id",
            'common_names' => [['name' => 'N/A', 'main' => true]]
        ];

        $data = [
            'sis_taxon_id' => $sis_taxon_id,
            'scientific_name' => $species['scientific_name'],
            'common_names' => $species['common_names'],
            'assessments' => [
                ['assessment_id' => $sis_taxon_id . '01', 'category_code' => 'VU', 'published_year' => 2023],
                ['assessment_id' => $sis_taxon_id . '02', 'category_code' => 'NT', 'published_year' => 2018],
            ]
        ];

        return TaxonDetailDTO::fromArray($data);
    }


    /**
     * Get mockup assessments data.
     */
    public function getAssessments(string $type, string $id): array
    {
        $data = [
            'system' => [
                'marine' => [
                    ['taxon_id' => 3855, 'scientific_name' => 'Carcharodon carcharias', 'category_code' => 'VU', 'published_year' => 2019, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '1234567', 'iucn_url' => 'https://www.iucnredlist.org/species/3855/1234567'],
                    ['taxon_id' => null, 'scientific_name' => 'Pristis pristis', 'category_code' => 'CR', 'published_year' => 2020, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '141790786', 'iucn_url' => 'https://www.iucnredlist.org/species/136633/141790786'],
                    ['taxon_id' => 18588, 'scientific_name' => 'Balaenoptera musculus', 'category_code' => 'EN', 'published_year' => 2021, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '39252391', 'iucn_url' => 'https://www.iucnredlist.org/species/18588/39252391'],
                ],
                'terrestrial' => [
                    ['taxon_id' => null, 'scientific_name' => 'Gorilla beringei', 'category_code' => 'CR', 'published_year' => 2020, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '39252391', 'iucn_url' => 'https://www.iucnredlist.org/species/9449/39252391'],
                    ['taxon_id' => 15951, 'scientific_name' => 'Panthera uncia', 'category_code' => 'VU', 'published_year' => 2017, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '55443503', 'iucn_url' => 'https://www.iucnredlist.org/species/15951/55443503'],
                    ['taxon_id' => 22823, 'scientific_name' => 'Diceros bicornis', 'category_code' => 'CR', 'published_year' => 2020, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '6557', 'iucn_url' => 'https://www.iucnredlist.org/species/22823/6557'],
                ],
                'freshwater' => [
                    ['taxon_id' => 10102, 'scientific_name' => 'Hippopotamus amphibius', 'category_code' => 'VU', 'published_year' => 2017, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '185673647', 'iucn_url' => 'https://www.iucnredlist.org/species/10102/185673647'],
                    ['taxon_id' => 11624, 'scientific_name' => 'Inia geoffrensis', 'category_code' => 'EN', 'published_year' => 2018, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '10831', 'iucn_url' => 'https://www.iucnredlist.org/species/11624/10831'],
                    ['taxon_id' => null, 'scientific_name' => 'Lutra lutra', 'category_code' => 'NT', 'published_year' => 2021, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '12419', 'iucn_url' => 'https://www.iucnredlist.org/species/12727/12419'],
                ],
            ],
            'country' => [
                'IT' => [
                    ['taxon_id' => 3746, 'scientific_name' => 'Canis lupus', 'category_code' => 'LC', 'published_year' => 2018, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '55443503', 'iucn_url' => 'https://www.iucnredlist.org/species/3746/55443503'],
                    ['taxon_id' => 22732, 'scientific_name' => 'Ursus arctos', 'category_code' => 'LC', 'published_year' => 2017, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '41688', 'iucn_url' => 'https://www.iucnredlist.org/species/22732/41688'],
                ],
                'FR' => [
                    ['taxon_id' => 12519, 'scientific_name' => 'Lynx lynx', 'category_code' => 'LC', 'published_year' => 2015, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '12519', 'iucn_url' => 'https://www.iucnredlist.org/species/12519/12519'],
                    ['taxon_id' => 1653, 'scientific_name' => 'Anguilla anguilla', 'category_code' => 'CR', 'published_year' => 2020, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '1653', 'iucn_url' => 'https://www.iucnredlist.org/species/1653/1653'],
                ],
                'ES' => [
                    ['taxon_id' => 12520, 'scientific_name' => 'Lynx pardinus', 'category_code' => 'EN', 'published_year' => 2015, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '12520', 'iucn_url' => 'https://www.iucnredlist.org/species/12520/12520'],
                    ['taxon_id' => 13183, 'scientific_name' => 'Monachus monachus', 'category_code' => 'EN', 'published_year' => 2015, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '13183', 'iucn_url' => 'https://www.iucnredlist.org/species/13183/13183'],
                ],
                'US' => [
                    ['taxon_id' => 22697842, 'scientific_name' => 'Gymnogyps californianus', 'category_code' => 'CR', 'published_year' => 2020, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '22697842', 'iucn_url' => 'https://www.iucnredlist.org/species/22697842/22697842'],
                    ['taxon_id' => 22679946, 'scientific_name' => 'Meleagris gallopavo', 'category_code' => 'LC', 'published_year' => 2016, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '22679946', 'iucn_url' => 'https://www.iucnredlist.org/species/22679946/22679946'],
                ],
                'AU' => [
                    ['taxon_id' => 16295, 'scientific_name' => 'Ornithorhynchus anatinus', 'category_code' => 'NT', 'published_year' => 2016, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '16295', 'iucn_url' => 'https://www.iucnredlist.org/species/16295/16295'],
                    ['taxon_id' => 18562, 'scientific_name' => 'Sarcophilus harrisii', 'category_code' => 'EN', 'published_year' => 2008, 'is_possibly_extinct' => false, 'is_possibly_extinct_in_wild' => false, 'assessment_id' => '18562', 'iucn_url' => 'https://www.iucnredlist.org/species/18562/18562'],
                ],
            ]
        ];

        return $data[$type][$id] ?? [];
    }
}
