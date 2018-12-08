<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHTMLEmail()
    {
        $data = [
            'test' => 'test',
            'first_name' => 'General',
            'last_name' => 'Test',
            'candidates' => [
                'display_job_title' => 'Full Time Tester',
                ''
            ]
        ];
        
        $view = view('email/html/notifyClient', (array) $data)->render();

        file_put_contents(base_path().'/testEmail.html', $view);

        $this->assertTrue(true);
    }
}
