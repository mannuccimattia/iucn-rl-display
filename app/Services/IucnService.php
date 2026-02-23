<?php

namespace App\Services;

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
            $response = Http::withToken($this->token)
                ->get("$this->baseUrl/systems");

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
            $response = Http::withToken($this->token)
                ->get("$this->baseUrl/countries");

            if ($response->successful()) {
                return $response->json()['countries'] ?? [];
            }

            return [];
        });
    }

    /**
     * Get the latest assessments for a given system or country.
     */
    public function getLatestAssessments(
        string $type,
        string $code,
        int $page = 1,
        int $perPage = 18,
        string|null $year,
        string|null $isExtinct,
        string|null $isExtinctWild
    ): array {
        $page = max(1, $page);
        $perPage = max(1, $perPage);

        $filters = collect([
            'year_published' => $year,
            'possibly_extinct' => $isExtinct,
            'possibly_extinct_in_the_wild' => $isExtinctWild,
        ])->filter(fn($value) => $value !== null && trim((string) $value) !== '')
            ->toArray();

        $query = array_merge(
            [
                'page' => $page,
                'per_page' => $perPage,
            ],
            $filters
        );

        $cacheName = 'iucn_latest_' . $type . '_' . $code . sha1(implode('_', $query));

        return Cache::remember($cacheName, 300, function () use ($type, $code, $query) {
            $response = Http::withToken($this->token)
                ->get("$this->baseUrl/$type/$code", $query);

            if ($response->successful()) {
                $currentPage = (int) ($response->header('current-page') ?? $query['page']);
                $pageItems = (int) ($response->header('page-items') ?? $query['per_page']);
                $totalPages = (int) ($response->header('total-pages') ?? 1);
                $totalCount = (int) ($response->header('total-count') ?? 0);

                return [
                    'data' => $response->json() ?? [],
                    'pagination' => [
                        'current_page' => max(1, $currentPage),
                        'page_items' => max(1, $pageItems),
                        'total_pages' => max(1, $totalPages),
                        'total_count' => max(0, $totalCount),
                        'has_prev' => $currentPage > 1,
                        'has_next' => $currentPage < $totalPages,
                    ],
                ];
            }

            return [
                'data' => [],
                'pagination' => [
                    'current_page' => 1,
                    'page_items' => $query['per_page'],
                    'total_pages' => 1,
                    'total_count' => 0,
                    'has_prev' => false,
                    'has_next' => false,
                ],
            ];
        });
    }

    /**
     * Get a collection of assessments for a given SIS id.
     */
    public function getAssessmentsBySisId(string $sis_id): array
    {
        $cacheName = 'iucn_assessments_for_sis_' . $sis_id;

        return Cache::remember($cacheName, 300, function () use ($sis_id) {
            $response = Http::withToken($this->token)
                ->get("$this->baseUrl/taxa/sis/$sis_id");

            if ($response->successful()) {
                return $response->json() ?? [];
            }

            return [];
        });
    }

    /**
     * Get assessment data for a supplied assessment_id.
     */
    public function getAssessment(string $assessment_id): array
    {
        $cacheName = 'iucn_assessment_' . $assessment_id;

        return Cache::remember($cacheName, 300, function () use ($assessment_id) {
            $response = Http::withToken($this->token)
                ->get("$this->baseUrl/assessment/$assessment_id");

            if ($response->successful()) {
                return $response->json() ?? [];
            }

            return [];
        });
    }

    /**
     * Map legacy conservation codes of supplied assessments.
     */
    public function mapLegacyCodes(array $assessments): array
    {
        // Map for legacy conservation codes.
        $legacyMap = [
            'LR/lc' => 'LC',
            'LR/nt' => 'NT',
            'LR/cd' => 'NT',
            'V' => 'VU',
            'I' => 'NE',
            'K' => 'DD',
        ];

        // Iterate mapping.
        foreach ($assessments as &$assessment) {
            $assessment['red_list_category_code'] = $legacyMap[$assessment['red_list_category_code']]
                ?? $assessment['red_list_category_code'];
        }

        unset($assessment);

        return $assessments;
    }

    /**
     * Get API version, Red List version and species count data for the footer.
     */
    public function getFooterData(): array
    {
        return Cache::remember('footer_data', 86400, function () {
            $apiVersion = Http::withToken($this->token)
                ->get("$this->baseUrl/information/api_version")
                ->json();

            usleep(300000); // Wait time as requested by responsible usage.

            $redListVersion = Http::withToken($this->token)
                ->get("$this->baseUrl/information/red_list_version")
                ->json();

            usleep(300000);

            $speciesCount = Http::withToken($this->token)
                ->get("$this->baseUrl/statistics/count")
                ->json();

            return array_merge($apiVersion, $redListVersion, $speciesCount);
        });
    }
}
