<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\Role;
use App\Models\ShortUrls;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShortUrlTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_create_short_url(): void
    {
        [$admin, $company] = $this->createUserWithRole('admin');

        $response = $this
            ->actingAs($admin)
            ->post(route('admin.short-url.store'), [
                'url' => 'https://example.com',
            ]);

        $response->assertRedirect(route('admin.dashboard'));

        $this->assertDatabaseHas('short_urls', [
            'company_id' => $company->id,
            'user_id' => $admin->id,
            'original_url' => 'https://example.com',
        ]);
    }

    public function test_member_can_create_short_url(): void
    {
        [$member, $company] = $this->createUserWithRole('member');

        $response = $this
            ->actingAs($member)
            ->post(route('shorturl.store'), [
                'url' => 'https://example.com',
            ]);

        $response->assertRedirect(route('member.dashboard'));

        $this->assertDatabaseHas('short_urls', [
            'company_id' => $company->id,
            'user_id' => $member->id,
            'original_url' => 'https://example.com',
        ]);
    }

    public function test_super_admin_cannot_create_short_url(): void
    {
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $superAdmin = User::factory()->create([
            'role_id' => $superAdminRole->id,
        ]);

        $response = $this
            ->actingAs($superAdmin)
            ->post(route('admin.short-url.store'), [
                'url' => 'https://example.com',
            ]);

        $response->assertForbidden();
        $this->assertDatabaseCount('short_urls', 0);
    }

    public function test_admin_sees_only_short_urls_from_their_company(): void
    {
        [$admin, $company] = $this->createUserWithRole('admin');
        [$otherAdmin, $otherCompany] = $this->createUserWithRole('admin', 'other-admin@example.com');

        ShortUrls::create([
            'company_id' => $company->id,
            'user_id' => $admin->id,
            'original_url' => 'https://my-company.com',
            'short_code' => 'company1',
        ]);
        ShortUrls::create([
            'company_id' => $otherCompany->id,
            'user_id' => $otherAdmin->id,
            'original_url' => 'https://other-company.com',
            'short_code' => 'company2',
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));

        $response->assertOk();
        $response->assertSee('https://my-company.com');
        $response->assertDontSee('https://other-company.com');
    }

    public function test_member_sees_only_short_urls_created_by_themselves(): void
    {
        [$member, $company] = $this->createUserWithRole('member');
        [$otherMember] = $this->createUserWithRole('member', 'other-member@example.com', $company);

        ShortUrls::create([
            'company_id' => $company->id,
            'user_id' => $member->id,
            'original_url' => 'https://my-url.com',
            'short_code' => 'member1',
        ]);
        ShortUrls::create([
            'company_id' => $company->id,
            'user_id' => $otherMember->id,
            'original_url' => 'https://other-member-url.com',
            'short_code' => 'member2',
        ]);

        $response = $this->actingAs($member)->get(route('member.dashboard'));

        $response->assertOk();
        $response->assertSee('https://my-url.com');
        $response->assertDontSee('https://other-member-url.com');
    }

    public function test_short_url_redirects_publicly_to_original_url(): void
    {
        $company = Company::create(['name' => 'Redirect Company']);
        $user = User::factory()->create();

        $shortUrl = ShortUrls::create([
            'company_id' => $company->id,
            'user_id' => $user->id,
            'original_url' => 'https://example.com/original',
            'short_code' => 'public1',
        ]);

        $response = $this->get('/' . $shortUrl->short_code);

        $response->assertRedirect('https://example.com/original');
    }

    private function createUserWithRole(string $roleName, ?string $email = null, ?Company $company = null): array
    {
        $role = Role::firstOrCreate(['name' => $roleName]);
        $company ??= Company::create(['name' => ucfirst($roleName) . ' Company ' . uniqid()]);
        $user = User::factory()->create(['email' => $email ?? $roleName . '@example.com']);

        CompanyUser::create([
            'company_id' => $company->id,
            'user_id' => $user->id,
            'role_id' => $role->id,
        ]);

        return [$user, $company];
    }
}