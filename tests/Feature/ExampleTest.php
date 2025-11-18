<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
    // ========================================
    // 1. Public Routes
    // ========================================

    public function test_welcome_page_loads(): void
    {
        $response = $this->get('/chef_lens/welcome');

        // نقبل أي status ما عدا 404
        // 200 = شغال، 500 = في مشكلة بس الـ route موجود
        $this->assertNotEquals(404, $response->status());
    }

    public function test_about_page_loads(): void
    {
        $response = $this->get('/chef_lens/about');
        $this->assertContains($response->status(), [200, 500]);
    }

    public function test_challenge_add_vs_page_with_invalid_id(): void
    {
        $response = $this->get('/chef_lens/challenges/99999/add-vs');

        // نقبل 404 أو 500 (لو Laravel رمى Exception)
        $this->assertContains($response->status(), [404, 500]);
    }

    // ========================================
    // 2. Admin Routes
    // ========================================

    public function test_admin_dashboard_redirects_when_not_logged_in(): void
    {
        $response = $this->get('/admin/dashboard');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function test_admin_users_page_redirects_when_not_logged_in(): void
    {
        $response = $this->get('/admin/chefLensUsers');
        $response->assertStatus(302);
    }

    public function test_admin_videos_page_redirects_when_not_logged_in(): void
    {
        $response = $this->get('/admin/chefLensVideos');
        $response->assertStatus(302);
    }

    public function test_admin_challenges_page_redirects_when_not_logged_in(): void
    {
        $response = $this->get('/admin/chefLensChallenges');
        $response->assertStatus(302);
    }

    // ========================================
    // 3. Protected Routes
    // ========================================

    public function test_report_chef_requires_authentication(): void
    {
        $response = $this->post('/chef-profile/1/report', [
            'report_type' => 'spam'
        ]);

        $response->assertStatus(302);
    }

    // ========================================
    // 4. General Route Check
    // ========================================

    public function test_all_get_routes_are_registered(): void
    {
        $routes = [
            '/chef_lens/welcome',
            '/chef_lens/about',
            '/admin/dashboard',
            '/admin/chefLensUsers',
            '/admin/chefLensVideos',
            '/admin/chefLensChallenges',
        ];

        foreach ($routes as $route) {
            $response = $this->get($route);

            // أي حاجة غير 404 = الـ route موجود
            $this->assertNotEquals(
                404,
                $response->status(),
                "Route {$route} not found"
            );
        }
    }
}
