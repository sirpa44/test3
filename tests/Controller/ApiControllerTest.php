<?php declare(strict_types=1);

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiControllerTest extends WebTestCase
{

    public function testGetQuestionsWithCsv()
    {
        $response = '[{"question":"question 1","createdAt":"2019-06-01 00:00:00","choices":{"choice 1":"response 1","choice 2":"response 2","choice 3":"response 3"}},{"question":"question 2","createdAt":"2019-06-01 00:00:01","choices":{"choice 1":"response 1","choice 2":"response 2","choice 3":"response 3"}}]';
        $client = static::createClient();
        $client->request('GET', '/questions/en');
        $this->assertEquals($response, $client->getResponse()->getContent());
    }

}
