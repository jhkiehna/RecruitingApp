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
        $candidates = [
            (object) [
                    'walterId' => rand(10001, 99999),
                    'jobTitle' => 'Senior Testing Engineer',
                    'industry' => 'Testing',
                    'city' => 'Testville',
                    'state' => 'TE',
                    'summary' => 'Is really good at being test data. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Willing to relocate. Open to travel.',
                ],
            (object) [
                    'walterId' => rand(10001, 99999),
                    'jobTitle' => 'Junior Test Representative',
                    'industry' => 'Testing',
                    'city' => 'Test County',
                    'state' => 'TE',
                    'summary' => 'Top of his field at being in tests. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Prefers the Testville area.',
                ],
            (object) [
                    'walterId' => rand(10001, 99999),
                    'jobTitle' => 'Test Manager',
                    'industry' => 'Testing',
                    'city' => 'Test City',
                    'state' => 'TE',
                    'summary' => 'Really, really, really, really, really likes being a test. Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Willing to relocate.',
                ],
            ];

        $data = [
            'test' => 'Client',
            'first_name' => 'Richard',
            'last_name' => 'Test',
            'candidates' => $candidates,
            'industry' => 'Testing',
            'contactLink' => "tel:&#43;18282519900",
            'emailLink' => "mailto:constnews@kimmel.com",
            'unsubscribeLink' => null
        ];
        
        $view = view('email/html/clientHotsheet', (array) $data)->render();

        file_put_contents(base_path().'/testEmail.html', $view);

        $this->assertTrue(true);
    }
}
