<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class BirthdaysTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function contacts_with_birthdays_in_current_month_can_be_fetched(){
        $this->withExceptionHandling();
        $user = Sanctum::actingAs(User::factory()->create());

        $birthdayContact = Contact::factory()->create([
            'user_id' => $user->id,
            'birthday' => now()->subYear(),
        ]);

        $noBirthdayContact = Contact::factory()->create([
            'user_id' => $user->id,
            'birthday' => now()->subMonth(),
        ]);

        $this->get('/api/birthdays?api_token='. $user->api_token)
            ->assertJsonCount(1)
            ->assertJson([
                'data' => [
                    [
                        'data' => [
                            'contact_id' => $birthdayContact->id
                        ]
                    ]
                ]
            ]);
    }
}
