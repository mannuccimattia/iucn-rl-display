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
     * Get the current version number of the IUCN Red List of Threatened Species API.
     */
    public function getFooterData(): array
    {
        return Cache::remember('footer_data', 86400, function () {
            $apiVersion = Http::withToken($this->token)
                ->get("$this->baseUrl/information/api_version")
                ->json();

            usleep(300000);

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
