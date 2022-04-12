<?php

namespace Tests\Unit\Models;

use App\Models\Perjalanan;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\BrowserKitTest as TestCase;

class PerjalananTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_perjalanan_has_belongs_to_user_relation()
    {
        $perjalanan = factory(Perjalanan::class)->make();

        $this->assertInstanceOf(User::class, $perjalanan->view_users);
        $this->assertEquals($perjalanan->users_id, $perjalanan->view_users->id);
    }

    /** @test */
    public function an_perjalanan_has_coordinate_attribute()
    {
        $perjalanan = factory(Perjalanan::class)->make(['latitude' => '-3.333333', 'longitude' => '114.583333']);
        $this->assertEquals($perjalanan->latitude . ', ' . $perjalanan->longitude, $perjalanan->coordinate);

        $perjalanan = factory(Perjalanan::class)->make(['latitude' => null, 'longitude' => null]);
        $this->assertNull($perjalanan->coordinate);

        $perjalanan = factory(Perjalanan::class)->make(['latitude' => null, 'longitude' => '114.583333']);
        $this->assertNull($perjalanan->coordinate);
    }

    /** @test */
    // public function an_outlet_has_map_popup_content_attribute()
    // {
    //     $outlet = factory(Outlet::class)->create(['latitude' => '-3.333333', 'longitude' => '114.583333']);

    //     $mapPopupContent = '';
    //     $mapPopupContent .= '<div class="my-2"><strong>' . __('outlet.name') . ':</strong><br>' . $outlet->name_link . '</div>';
    //     $mapPopupContent .= '<div class="my-2"><strong>' . __('outlet.coordinate') . ':</strong><br>' . $outlet->coordinate . '</div>';

    //     $this->assertEquals($mapPopupContent, $outlet->map_popup_content);
    // }
}
