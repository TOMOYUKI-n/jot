<?php

namespace Tests\Feature;

use App\Models\Contact;
use App\Models\User;
use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactsTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /** @test */
    public function an_unauthenticated_user_should_redirected_to_login()
    {
        $response = $this->post('/api/contacts', $this->data());

        $response->assertRedirect('/login');
        $this->assertCount(0, Contact::all());
    }

    /** @test */
    public function an_authenticated_user_can_add_a_contact()
    {
        $this->withoutExceptionHandling();

        // dd($this->user->api_token);

        $this->post('/api/contacts', $this->data());

        $contact = Contact::first();

        $this->assertEquals('Test Name', $contact->name);
        $this->assertEquals('test@gmail.con', $contact->email);
        $this->assertEquals('05/28/1988', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('ABC String', $contact->company);
    }

    /** @test */
    public function fields_are_required()
    {
        collect(['name', 'email', 'birthday', 'company'])
            ->each(function($field) {
                // nameキーを削除するオーバーライドで、名前だけ無効化することがわかる!
                $response = $this->post('/api/contacts',
                    array_merge($this->data(), [$field => '']));

                $response->assertSessionHasErrors($field);
                $this->assertCount(0, Contact::all());
        });
    }

    /** @test */
    public function email_must_be_a_valid_email()
    {
        $response = $this->post('/api/contacts',
            array_merge($this->data(), ['email' => 'Not an Email']));

        $response->assertSessionHasErrors('email');
        $this->assertCount(0, Contact::all());
    }

    /** @test */
    public function birthday_are_property_stored()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/contacts',
            array_merge($this->data(), ['birthday' => 'May 28, 1988']));

        $this->assertCount(1, Contact::all());
        $this->assertInstanceOf(Carbon::class, Contact::first()->birthday);

        $this->assertEquals('05-28-1988', Contact::first()->birthday->format('m-d-Y'));
    }

    /** @test */
    public function a_contact_can_be_retrieved()
    {
        $contact = Contact::factory()->create();

        $response = $this->get('/api/contacts/' . $contact->id);
        $response->assertJson([
            'name' => $contact->name,
            'email' => $contact->email,
            'birthday' => '1988-05-28T00:00:00.000000Z',
            'company' => $contact->company,
        ]);
    }

    /** @test */
    public function a_contact_can_be_patched()
    {
        $this->withoutExceptionHandling();
        $contact = Contact::factory()->create();

        $response = $this->patch('/api/contacts/' . $contact->id, $this->data());

        $contact = $contact->fresh();

        $this->assertEquals('Test Name', $contact->name);
        $this->assertEquals('test@gmail.con', $contact->email);
        $this->assertEquals('05/28/1988', $contact->birthday->format('m/d/Y'));
        $this->assertEquals('ABC String', $contact->company);
    }

    /** @test */
    public function a_contact_can_be_deleted()
    {
        $contact = Contact::factory()->create();

        $response = $this->delete('api/contacts/' . $contact->id);

        $this->assertCount(0, Contact::all());
    }

    private function data()
    {
        return [
            'name' => 'Test Name',
            'email' => 'test@gmail.con',
            'birthday' => '05/28/1988',
            'company' => 'ABC String',
            'api_token' => $this->user->api_token
        ];
    }
}
