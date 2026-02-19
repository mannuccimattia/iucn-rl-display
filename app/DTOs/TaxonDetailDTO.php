<?php

namespace App\DTOs;

class TaxonDetailDTO
{
    public function __construct(public int $sis_taxon_id, public string $scientific_name, public array $common_names, public array $assessments)
    {
        //
    }

    public static function fromArray(array $data): self
    {
        return new self(
            sis_taxon_id: $data['sis_taxon_id'] ?? 0,
            scientific_name: $data['scientific_name'] ?? 'N/A',
            common_names: $data['common_names'] ?? [],
            assessments: $data['assessments'] ?? []
        );
    }
}
