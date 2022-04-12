<?php

namespace Tests\Feature\Api;

use App\Models\Perjalanan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class PerjalananListingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_can_retrieve_perjalanan_list()
    {
        $perjalanan = factory(Perjalanan::class)->create();

        $this->json('GET',route('api.perjalanan.index'));

        $this->seeJsonContains([
            'features' => [
                [
                    'properties' => [
                        'tanggal'           => $perjalanan->tanggal,
                        'jam'               => $perjalanan->jam,
                        'latitude'          => (string) $perjalanan->latitude,
                        'longitude'         => (string) $perjalanan->longitude,
                        'created_at'        => $perjalanan->created_at,
                        'updated_at'        => $perjalanan->updated_at,
                    ]
                ],
            ],
        ]);
    }
}
